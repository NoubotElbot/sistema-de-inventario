<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\CategoriaModel;

class Producto extends BaseController
{
	public function index()
	{
		$data['vista'] = 'producto';
		return view('Producto/producto', $data);
	}

	public function obtenerData()
	{
		if ($this->request->isAJAX()) {
			$productoModel = new ProductoModel();
			$data['data'] = $productoModel->select('producto.*, categoria.nombre as categoria, usuario.username')
				->join('categoria', 'categoria.id = producto.categoria_id', 'left')
				->join('usuario', 'usuario.id = producto.usuario_id', 'left')
				->findAll();
			$i = 0;
			foreach ($data['data'] as $row) {
				$btnEditar = "";
				$btnBorrar = "";
				if (session()->get('admin') == 1) {
					
					$paraEdit = $row['id'] . ",'" . base_url('producto/editar') . "','" . csrf_hash()."'";
					$btnEditar = '<button type="button" class="btn-shadow btn btn-primary" onclick="edit(' . $paraEdit .')" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></button>';
					$paraBorrar = $row['id'] . ",'" . base_url('producto/borrar') . "','" . csrf_hash()."'";
					if ($row['activo'] == 1) {
						$btnBorrar = '<button type="button" class="btn btn-danger" onclick="activar_desactivar(' . $paraBorrar . ')" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fas fa-trash-alt"></i></button>';
					} else {
						$btnBorrar = '<button type="button" class="btn btn-warning" onclick="activar_desactivar(' . $paraBorrar . ')" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-recycle"></i></button>';
					}
				}
				// $data['data'][$i]['create_at'] = date('d/m/Y H:i:s', strtotime($data['data'][$i]['create_at']));
				$data['data'][$i]['stock'] = $data['data'][$i]['stock'] <= $data['data'][$i]['stock_critico'] ? '<span class="text-danger">' . $data['data'][$i]['stock'] . '</span>' : $data['data'][$i]['stock'];
				$data['data'][$i]['activo'] = $data['data'][$i]['activo'] == 1 ? 'Activo' : 'Desactivado';
				$data['data'][$i]['opciones'] = '<div class="btn-group">' . $btnEditar . $btnBorrar . '</div>';
				$i++;
			}

			return json_encode($data);
		} else {
			exit();
		}
	}

	public function new()
	{
		if ($this->request->isAJAX()) {
			$categoriaModel = new CategoriaModel();
			$data['categorias'] = $categoriaModel->findAll();
			$msg['success'] = view("Producto/producto_agregar", $data);
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	public function agregar()
	{
		if ($this->request->isAJAX()) {
			$rules = [

			];

			$messages = [
			];
			if (!$this->validate($rules, $messages)) {
				$msg['error'] = [
					'nombre' => $this->validator->getError('nombre'),
					'apellido' => $this->validator->getError('apellido'),
					'tipo' => $this->validator->getError('tipo'),
					'telefono' => $this->validator->getError('telefono'),
					'email' => $this->validator->getError('email'),
					'direccion' => $this->validator->getError('direccion'),
					'company' => $this->validator->getError('company'),
				];
			} else {
				$productoModel = new ProductoModel();
				$datos = [
					'create_at' => date('Y-m-d H:i:s')
				];
				$productoModel->save($datos);
				$msg['success'] = 'Datos Ingresados correctamente';
			}
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}
	//--------------------------------------------------------------------

}
