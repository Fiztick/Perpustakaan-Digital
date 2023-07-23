<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FkSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'role_id' => '1',
                'role_name' => 'admin',
            ],
            [
                'role_id' => '2',
                'role_name' => 'user',
            ]
        ];

        $categories = [
            [
                'category_id' => '1',
                'category_name' => 'Novel',
            ],
            [
                'category_id' => '2',
                'category_name' => 'Majalah',
            ],
            [
                'category_id' => '3',
                'category_name' => 'Kamus',
            ],
            [
                'category_id' => '4',
                'category_name' => 'Komik',
            ],
            [
                'category_id' => '5',
                'category_name' => 'Manga',
            ],
            [
                'category_id' => '6',
                'category_name' => 'Ensiklopedia',
            ],
            [
                'category_id'=> '7',
                'category_name' => 'Biografi',
            ],
            [
                'category_id' => '8',
                'category_name' => 'Naskah',
            ],
        ];

        $this->db->table('roles')->insertBatch($roles);
        $this->db->table('categories')->insertBatch($categories);
    }
}
