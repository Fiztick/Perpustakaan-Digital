<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BookCopies extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'BIGINT',
                'constraint' => '5',
                'unsigned'       => 'true',
                'auto_increment' => 'true',
            ],
            'book_id' => [
                'type'       => 'BIGINT',
                'constraint' => '5',
            ],
            'quantity' => [
                'type'       => 'INT',
                'constrint'  => '5'
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('book_id', 'books', 'id', 'CASCADE', 'CASCADE', 'book_id_fk_books');
        $this->forge->createTable('book_copies');
    }

    public function down()
    {
        $this->forge->dropTable('book_copies');
    }
}
