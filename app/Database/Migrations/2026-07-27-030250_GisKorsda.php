<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GisKorsda extends Migration
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
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'latitude' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'longitude' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'geojson' => [
                'type' => 'LONGTEXT',
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
        $this->forge->createTable('gis_korsda');
    }

    public function down()
    {
        $this->forge->dropTable('gis_korsda');
    }
}