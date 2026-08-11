<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WilayahKerja extends Migration
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

            'nama_wilayah' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'file_peta' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'file_geojson' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'file_peta',
            ],

            'keterangan' => [
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
        $this->forge->addKey('korsda_id');

        $this->forge->addForeignKey(
            'korsda_id',
            'korsda',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('wilayah');
    }

    public function down()
    {
        $this->forge->dropTable('wilayah');
    }
}