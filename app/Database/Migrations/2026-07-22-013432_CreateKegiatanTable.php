<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKegiatanTable extends Migration
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

            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'deskripsi' => [
                'type' => 'TEXT',
            ],

            'thumbnail' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'tanggal' => [
                'type' => 'DATE',
            ],

            'tahun' => [
                'type'       => 'YEAR',
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

        $this->forge->createTable('kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('kegiatan');
    }
}