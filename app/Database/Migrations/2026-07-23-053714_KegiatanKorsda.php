<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KegiatanKorsda extends Migration
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

            'id_korsda' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'tanggal' => [
                'type' => 'DATE',
            ],

            'isi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('kegiatankorsda');
    }

    public function down()
    {
        $this->forge->dropTable('kegiatankorsda',true);
    }
}