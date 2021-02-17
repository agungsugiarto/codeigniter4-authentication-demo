<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersTables extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'provider'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'provider_id' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['provider', 'provider_id']);
    }
}
