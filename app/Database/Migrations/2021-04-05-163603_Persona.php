<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Persona extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
				'null'			 => false
			],
			'nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'apellido' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'empresa' => [
				'type'		 => 'VARCHAR',
				'constraint' => '200',
				'null'		 => true
			],
			'direccion' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null' 		 => true
			],
			'telefono' => [
				'type'       => 'VARCHAR',
				'constraint' => '15',
			],
			'email' => [
				'type'       => 'VARCHAR',
				'constraint' => '200',
			],
			'tipo' => [ //cliente(0), provedor(1)
				'type'       => 'TINYINT',
				'constraint' => '1',
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => false
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => true
			],
			'deleted_at' => [
				'type' => 'DATETIME',
				'null' => true
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('persona');
	}

	public function down()
	{
		$this->forge->dropTable('persona');
	}
}
