<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categoria extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
				'null'			 => false
			],
			'nombre'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'descripcion' => [
				'type' => 'TEXT',
				'null' => true,
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
		$this->forge->createTable('categoria');
	}

	public function down()
	{
		$this->forge->dropTable('categoria');
	}
}
