<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Books extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => '5',
                'unsigned'       => 'true',
                'auto_increment' => 'true',
            ],
            'title' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'category_id' => [
                'type'           => 'BIGINT',
                'constraint'     => '5',
            ],
            'description' => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'cover' => [
                'type'           => 'VARCHAR',
                'constraint'           => '255',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE', 'category_id_fk_categories');
        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}
