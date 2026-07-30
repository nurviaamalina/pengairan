<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProfilDinasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'sejarah' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'visi' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'misi' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'deskripsi_struktur' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'struktur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('profil_dinas');
    }

    public function down()
    {
        $this->forge->dropTable('profil_dinas');
    }
}