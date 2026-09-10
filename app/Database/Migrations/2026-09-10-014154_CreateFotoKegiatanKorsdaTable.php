<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFotoKegiatanKorsdaTable extends Migration
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

            'kegiatan_korsda_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Primary Key
        $this->forge->addKey('id', true);

        // Index untuk kegiatan_korsda_id
        $this->forge->addKey('kegiatan_korsda_id');

        // Foreign Key
        $this->forge->addForeignKey(
            'kegiatan_korsda_id',
            'kegiatankorsda',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Buat tabel
        $this->forge->createTable('foto_kegiatan_korsda');
    }

    public function down()
    {
        // Hapus tabel jika migration di-rollback
        $this->forge->dropTable('foto_kegiatan_korsda', true);
    }
}