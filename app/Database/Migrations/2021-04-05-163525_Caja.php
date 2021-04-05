<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Caja extends Migration
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
			'created_at'       => [
				'type'       => 'DATETIME',
				'null'		 => false
			],
			'updated_at'       => [
				'type'       => 'DATETIME',
				'null'		 => true
			],
			'deteled_at'       => [
				'type'       => 'DATETIME',
				'null'		 => true
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('caja');
	}

	public function down()
	{
		$this->forge->dropTable('caja');
	}
}
