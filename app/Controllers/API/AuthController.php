<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Libraries\EncryptionHelper;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends BaseController
{
    use ResponseTrait;

    public function login()
    {
        $key = $this->request->getVar('JWT_SECRET');

        if (empty($key) || $key != getenv('JWT_SECRET')) {
            return $this->respond(['error' => 'Invalid secret key'], 401);
        }
        $userModel = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $userModel->where('username', $username)->first();

        if (is_null($user)) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }

        $pwd_verify = password_verify($password, $user['password']);

        if (!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
        $encryptionHelper = new EncryptionHelper();

        $iat = time();
        $exp = $iat + 3600;

        $payload = [
            'iat' => $iat,
            'exp' => $exp,
            'id' => $encryptionHelper->encrypt($user['id']),
            'username' => $encryptionHelper->encrypt($user['username']),
            'name' => $encryptionHelper->encrypt($user['name']),
            'role' => $encryptionHelper->encrypt($user['role']),
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'message' => 'Login Succesful',
            'token' => $token,
        ];

        return $this->respond($response, 200);
    }

    public function getProfile()
    {
        $key = getenv('JWT_SECRET');

        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if (!$header) {
            return $this->failUnauthorized('Token Required');
        }
        $token = explode(' ', $header)[1];

        $encryptionHelper = new EncryptionHelper();

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $response = [
                'id' => $encryptionHelper->decrypt($decoded->id),
                'username' => $encryptionHelper->decrypt($decoded->username),
                'name' => $encryptionHelper->decrypt($decoded->name),
                'role' => $encryptionHelper->decrypt($decoded->role),
            ];
            return $this->respond($response);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
