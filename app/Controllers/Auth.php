<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\models\UserModel;

class Auth extends BaseController
{
    public function showLogin()
    {
        return view('auth/login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $authModel = new AuthModel();
        $user = $authModel->checkCredentials($username, $password);

        if ($user) {
            $session = session();
            $session->set([
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ]);

            if ($user['role'] == 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/anggota/dashboard');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Username atau Password salah');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }


    public function showRegister()
    {
        return view('auth/register');
    }


    public function processRegister()
    {
        $validation = \Config\Services::validation(); 

        $validationRules = [
            'username' => 'required|alpha_numeric|min_length[3]|max_length[20]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'matches[password]',
            'role' => 'permit_empty|alpha_numeric|max_length[20]', 
        ];

        $errors = [
            'confirm_password' => [
                'matches' => 'Konfirmasi password harus sama dengan password.',
            ],
        ];

        if (!$this->validate($validationRules, $errors)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        

      
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role'); 


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $fix_role = 'anggota';
        $userData = [
            'username' => $username,
            'password' => $hashedPassword,
            'role' => $fix_role,
        ];

        $userModel = new UserModel();
        $userModel->insert($userData);

        // Setelah proses pendaftaran berhasil, kembalikan ke halaman login dengan pesan sukses
        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
} 
