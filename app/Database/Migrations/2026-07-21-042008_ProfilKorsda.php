<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfilKorsda extends Migration
{
     public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'id_korsda' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'visi' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'misi' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'tugas' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'struktur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addKey('id_korsda');

        $this->forge->addForeignKey(
            'id_korsda',
            'korsda',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('profil_korsda');
    }

    public function down()
    {
        $this->forge->dropTable('profil_korsda');
    }
}