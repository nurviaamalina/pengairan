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

            'id_korsda' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'nama_lokasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'latitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,8',
            ],

            'longitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '11,8',
            ],

            'zoom' => [
                'type'       => 'INT',
                'constraint' => 2,
                'default'    => 15,
            ],

            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'created_at DATETIME NULL',
            'updated_at DATETIME NULL',
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

        $this->forge->createTable('wilayah_kerja');
    }

    public function down()
    {
        $this->forge->dropTable('wilayah_kerja');
    }
}