<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Books extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'book_id' => [
                'type'           => 'BIGINT',
                'constraint'     => '5',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'description' => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'cover_file' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'book_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'           => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => '5',
                'default'    => '0',
            ],
            'category_id' => [
                'type'           => 'BIGINT',
                'constraint'     => '5',
                'unsigned'       => true,
            ],
            'user_id' => [
                'type'       => 'BIGINT',
                'constraint' => '5',
                'unsigned'       => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('book_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE', 'user_id_fk_users');
        $this->forge->addForeignKey('category_id', 'categories', 'category_id', 'CASCADE', 'CASCADE', 'category_id_fk_categories');
        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}
