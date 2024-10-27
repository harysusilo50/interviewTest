<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $data = [
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'admin123',
            'role' => 'admin',
        ];
        $userModel->insert($data);
    }
}
