<?php

namespace App\Controllers;

use App\Models\OperacionModel;
use App\Models\VentaModel;

class Venta extends BaseController
{
	public function index()
	{
		$data['vista'] = 'venta';
		return view('Venta/venta', $data);
	}

	public function detalle()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$ventaModel = new VentaModel();
			$opereacionModel = new OperacionModel();
			$data['venta'] = $ventaModel->select('venta.*, usuario.username')
				->join('usuario', 'usuario.id = venta.usuario_id', 'left')
				->find($id);
			$data['operaciones'] = $opereacionModel->select('operacion.*, producto.nombre_producto, producto.precio_out')
				->join('producto', 'operacion.producto_id = producto.id')
				->where('venta_id', $id)
				->findAll();
			$msg['success'] = view("Venta/detalle", $data);
			return json_encode($msg);
		}
	}

	public function obtenerData()
	{
		if ($this->request->isAJAX()) {
			$ventaModel = new VentaModel();
			$data['data'] = $ventaModel->select('venta.*, usuario.username')
				->join('usuario', 'usuario.id = venta.usuario_id', 'left')
				->withDeleted()
				->findAll();
			foreach ($data['data'] as $i => $row) {
				$btnDetalle = '<button type="button" class="btn btn-info" onclick="detalle(\''.$row['id'].'\')" data-toggle="tooltip" title="Some tooltip text!"><i class="fas fa-clipboard-list"></i></button>';
				$data['data'][$i]['created_at'] = date('d/m/Y H:i:s', strtotime($data['data'][$i]['created_at']));
				$data['data'][$i]['opciones'] = $btnDetalle;
			}
			return json_encode($data);
		}
	}
}
