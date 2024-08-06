<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users'; // Sesuaikan dengan nama tabel pengguna

    public function checkCredentials($username, $password)
    {
        $user = $this->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }
}
