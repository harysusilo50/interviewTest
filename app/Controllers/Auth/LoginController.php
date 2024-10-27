<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;

class LoginController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->helpers = ['form', 'url'];
    }
    
    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to(base_url('home'));
        }

        $title = 'Login';
        return view('auth/login', compact('title'));
    }

    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }

    public function loginAction(){
        $data = $this->request->getPost(['username', 'password']);

        if (! $this->validateData($data, [
            'username' => 'required',
            'password' => 'required'
        ])) {
            return $this->index();
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $credentials = ['username' => $username];

        $user = $this->model->where($credentials)
            ->first();

        if (!$user) {
            session()->setFlashdata('error', 'username anda salah.');
            return redirect()->back();
        }

        $passwordCheck = password_verify($password, $user['password']);

        if (!$passwordCheck) {
            session()->setFlashdata('error', 'password anda salah.');
            return redirect()->back();
        }

        $iat = time();
        $exp = $iat + 3600;

        $payload = [
            'iat' => $iat,
            'exp' => $exp,
            'id' => $user['id'],
            'name' => $user['name'],
            'username' => $user['username'],
            'role' => $user['role'],
        ];

        $token = JWT::encode($payload, getenv('JWT_SECRET'), 'HS256');

        $userData = [
            'name' => $user['name'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => TRUE,
            'token'=>$token 
        ];

        session()->set($userData);
        return redirect()->to(base_url('home'));
    }
}
