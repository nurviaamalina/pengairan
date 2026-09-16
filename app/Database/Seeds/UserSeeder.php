<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'   => 'admin',
                'email'      => 'admin@gmail.com',
                'password'   => 'admin123',
                'role'       => 'admin',
                'active'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'username'   => 'user',
                'email'      => 'user@gmail.com',
                'password'   => 'user123',
                'role'       => 'user',
                'active'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'username'   => 'superadmin',
                'email'      => 'superadmin@gmail.com',
                'password'   => 'Password123',
                'role'       => 'superadmin',
                'active'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}