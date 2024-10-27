<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class RegisterController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $title = 'Register';
        return view('auth/register', compact('title'));
    }

    public function registerUser()
    {
        $data = $this->request->getPost(['name', 'username', 'password']);
        $data['role'] = 'user';

        if (! $this->validateData($data, $this->model->validationRules)) {
            return $this->index();
        }

        $user = $this->validator->getValidated();

        $save = $this->model->save($user);

        if ($save) {
            session()->setFlashdata('success', 'Register Berhasil!');
            return redirect()->to(base_url('auth/login'));
        } else {
            session()->setFlashdata('error', $this->model->errors());
            return redirect()->back();
        }
    }
}
