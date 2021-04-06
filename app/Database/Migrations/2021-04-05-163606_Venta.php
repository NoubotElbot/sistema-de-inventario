<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Venta extends Migration
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
			'caja_id'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'null'	=> true
			],
			'usuario_id'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'null'	=> true
			],
			'persona_id'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'null'	=> true
			],
			'tipo_operacion_id'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'null'	=> true
			],
			'total'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'cash'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'descuento'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
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
		$this->forge->addForeignKey('caja_id','caja','id','CASCADE','SET NULL');
		$this->forge->addForeignKey('usuario_id','usuario','id','CASCADE','SET NULL');
		$this->forge->addForeignKey('persona_id','persona','id','CASCADE','SET NULL');
		$this->forge->addForeignKey('tipo_operacion_id','tipo_operacion','id','CASCADE','SET NULL');
		$this->forge->createTable('venta');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('venta');
	}
}
