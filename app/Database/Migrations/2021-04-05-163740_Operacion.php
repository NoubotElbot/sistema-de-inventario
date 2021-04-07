<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Operacion extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'producto_id'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'null'	=> true
			],
			'cantidad' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'venta_id'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'null'	=> false
			],
			'tipo_operacion_id'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'null'	=> true
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
		$this->forge->addForeignKey('producto_id','producto','id','CASCADE','SET NULL');
		$this->forge->addForeignKey('venta_id','venta','id','CASCADE','CASCADE');
		$this->forge->addForeignKey('tipo_operacion_id','tipo_operacion','id','CASCADE','SET NULL');
		$this->forge->createTable('operacion');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('operacion');
	}
}
