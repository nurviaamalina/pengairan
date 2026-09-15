<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordTokensToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [

            'remember_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
            ],

            'reset_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
            ],

            'reset_expires' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'remember_token',
            'reset_token',
            'reset_expires'
        ]);
    }
}