<?php

namespace App\Controllers;

use App\Models\OperacionModel;
use App\Models\PersonaModel;
use App\Models\ProductoModel;
use App\Models\VentaModel;

class Home extends BaseController
{
	public function index()
	{
		$data['vista'] = 'home';
		return view('home', $data);
	}

	public function datosHome()
	{
		if ($this->request->isAJAX()) {
			$productoModel = new ProductoModel();
			$personaModel = new PersonaModel();
			$ventasModel = new VentaModel();
			$data['productos'] = $productoModel->select('id, nombre_producto, stock, stock_critico')->findAll();
			$data['clientes'] = count($personaModel->where('tipo', 1)->findAll());
			$data['provedores'] = count($personaModel->where('tipo', 0)->findAll());
			$data['operaciones'] = $ventasModel->selectSum('total', 'ventas')->where('tipo_operacion_id', 2)->where("created_at >= '".$this->inicioMesActual()."'")->first();
			$data['operaciones'] += $ventasModel->selectSum('total', 'gastos')->where('tipo_operacion_id', 1)->where("created_at >= '".$this->inicioMesActual()."'")->first();
			return json_encode($data);
		}
	}

	private function inicioMesActual()
	{
		$data = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), 1, date("Y")));
		return $data;
	}

	//--------------------------------------------------------------------

}
