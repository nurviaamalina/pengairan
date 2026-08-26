<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToUsers extends Migration
{
    public function up()
    {
        // role sudah dibuat di CreateUsersTable
    }

    public function down()
    {
        // role tidak dihapus di sini
    }
}