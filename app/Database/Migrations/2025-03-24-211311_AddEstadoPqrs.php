<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEstadoPqrs extends Migration
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
                'constraint' => 25,
                'null'       => false,
            ],
        ]);
        
        $this->forge->addKey('id', true); // Clave primaria
        $this->forge->createTable('estado_pqrs', true);
    }

    public function down()
    {
        $this->forge->dropTable('estado_pqrs', true);
    }
}
