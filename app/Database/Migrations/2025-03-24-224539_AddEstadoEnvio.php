<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEstadoEnvio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'TINYINT',
                'constraint'     => 3,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('estado_envio', true);
    }

    public function down()
    {
        $this->forge->dropTable('estado_envio', true);
    }
}
