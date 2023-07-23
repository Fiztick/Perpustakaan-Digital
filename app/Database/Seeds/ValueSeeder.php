<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ValueSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'user_id' => '1',
                'email' => 'admin@admin.com',
                'password' => password_hash(1, PASSWORD_BCRYPT),
                'user_name' => 'Admin',
                'role_id' => '1',
            ],
            [
                'user_id' => '2',
                'email' => 'hafiz@user.com',
                'password' => password_hash('hafiz123', PASSWORD_BCRYPT),
                'user_name' => 'Hafiz Juansyah Putra',
                'role_id' => '2',
            ],
        ];


        $books = [
            [
                'book_id' => '1',
                'title' => 'test1',
                'category_id' => '1',
                'description' => 'description',
                'user_id' => '1',
            ],
            [
                'book_id' => '2',
                'title' => 'test2',
                'category_id' => '2',
                'description' => 'description',
                'user_id' => '2',
            ],
            [
                'book_id' => '3',
                'title' => 'test3',
                'category_id' => '3',
                'description' => 'description',
                'user_id' => '1',
            ],
        ];

        $this->db->table('users')->insertBatch($users);
        $this->db->table('books')->insertBatch($books);
    }
}
