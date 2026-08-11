<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfilKorsda extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'korsda_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
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

            'fungsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'struktur_organisasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'deskripsi' => [
                'type' => 'TEXT',
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

            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        // Agar satu KORSDA hanya memiliki satu profil
        $this->forge->addUniqueKey('korsda_id');

        $this->forge->addForeignKey(
            'korsda_id',
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