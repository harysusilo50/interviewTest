<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LogoutController extends BaseController
{
    public function __construct()
    {
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $userData = [
            'name',
            'email',
            'logged_in',
            'role',
            'token'
        ];

        session()->remove($userData);

        return redirect()->to(base_url('auth/login'));
    }
}
