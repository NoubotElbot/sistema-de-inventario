<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeed extends Seeder
{
	public function run()
	{
		//Primer usuario Administrador
		$data = [
			'username' 	=> 'admin', //Recuerde cambiar
			'nombre'    => '',
			'apellido' 	=> '',
			'admin'		=> 1, //Administrador se indentifica con un 1
			'password'  => password_hash('1234', PASSWORD_DEFAULT), //Contraseña por defecto 1234 RECUERDE CAMBIAR
			'created_at' => date("Y-m-d H:i:s")
		];
		$this->db->table('usuario')->insert($data);
		//Como minimo debe haber una Caja en la cual se hacen las transacciones
		$this->db->table('caja')->insert(['id' => 1, 'created_at' => date("Y-m-d H:i:s")]);
		//Tipos de operaciones
		$this->db->table('tipo_operacion')->insert([
			'id'		=> 1,
			'nombre' 	=> 'Entrada',
			'created_at' => date("Y-m-d H:i:s")
		]);
		$this->db->table('tipo_operacion')->insert([
			'id'		=> 2,
			'nombre' 	=> 'Salida',
			'created_at' => date("Y-m-d H:i:s")
		]);
		//El primer registro hace referencia a un abastecimiento y el segundo a una venta
	}
}
