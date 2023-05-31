<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TRoles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rol' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nombre_rol' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]
        ]);
        $this->forge->addKey('id_rol', true);
        $this->forge->createTable('t_roles');
    }

    public function down()
    {
        $this->forge->dropTable('t_roles');
    }
}
