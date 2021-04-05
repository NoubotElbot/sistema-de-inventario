<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuario extends Migration
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
			'username'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'		 => false
			],
			'nombre'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'		 => false
			],
			'apellido'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'		 => false
			],
			'email'       => [
				'type'       => 'VARCHAR',
				'constraint' => '200',
				'null'		 => true
			],
			'admin'       => [
				'type'       => 'TINYINT',
				'constraint' => 1,
				'unsigned'   => true,
			],
			'password'       => [
				'type'       => 'VARCHAR',
				'constraint' => '300',
				'null'		 => false
			],
			'created_at'       => [
				'type'       => 'DATETIME',
				'null'		 => false
			],
			'updated_at'       => [
				'type'       => 'DATETIME',
				'null'		 => true
			],
			'deleted_at'       => [
				'type'       => 'DATETIME',
				'null'		 => true
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('usuario');
	}

	public function down()
	{
		$this->forge->dropTable('usuario');
	}
}
