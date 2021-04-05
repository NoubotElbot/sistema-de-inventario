<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Producto extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		// Migration rules would go here..
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
				'null'			 => false
			],
			'nombre_producto'       => [
				'type'       => 'VARCHAR',
				'constraint' => '200',
				'null'		 => false
			],
			'descripcion' => [
				'type' => 'TEXT',
				'null' => true,
			],
			'precio_in' => [
				'type' => 'INT',
				'contraint' => 11,
				'unsigned' => true,
			],
			'precio_out' => [
				'type' => 'INT',
				'contraint' => 11,
				'unsigned' => true,
			],
			'stock' => [
				'type' => 'INT',
				'contraint' => 11,
				'unsigned' => true,
			],
			'stock_critico' => [
				'type' => 'INT',
				'contraint' => 11,
				'unsigned' => true,
			],
			'usuario_id' => [
				'type' => 'INT',
				'contraint' => 5,
				'unsigned' => true,
				'null'	=> true
			],
			'categoria_id' => [
				'type' => 'INT',
				'contraint' => 5,
				'unsigned' => true,
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
		$this->forge->addForeignKey('usuario_id', 'usuario', 'id', 'CASCADE', 'SET NULL');
		$this->forge->addForeignKey('categoria_id', 'categoria', 'id', 'CASCADE', 'SET NULL');
		$this->forge->createTable('producto');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('producto');
	}
}
