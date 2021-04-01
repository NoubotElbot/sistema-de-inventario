<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\VentaModel;

class Venta extends BaseController
{
	public function index()
	{
		$data['vista'] = 'venta';
		return view('Venta/venta', $data);
	}

	public function obtenerData()
	{
		if ($this->request->isAJAX()) {
			$ventaModel = new VentaModel();
			$data['data'] = $ventaModel->select('venta.*, usuario.username')
				->join('usuario', 'usuario.id = venta.usuario_id', 'left')
				->findAll();
			$i = 0;
			foreach ($data['data'] as $row) {
				$btnDetalle = '<a class="btn btn-info" href="#"><i class="fas fa-clipboard-list"></i></a>';
				$data['data'][$i]['created_at'] = date('d/m/Y H:i:s', strtotime($data['data'][$i]['created_at']));
				$data['data'][$i]['opciones'] = $btnDetalle;
				$i++;
			}
			return json_encode($data);
		} else {
			exit();
		}
	}

	public function create()
	{
	
		$data['vista'] = 'venta';
		return view('Venta/vender', $data);
	}
}
