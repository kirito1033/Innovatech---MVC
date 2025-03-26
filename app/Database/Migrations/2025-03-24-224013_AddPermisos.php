<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPermisos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => false,
                'unique'     => true,
            ],
            'descripción' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        
        $this->forge->addKey('id', true); // Clave primaria
        $this->forge->createTable('permisos', true);
    }

    public function down()
    {
        $this->forge->dropTable('permisos', true);
    }
}