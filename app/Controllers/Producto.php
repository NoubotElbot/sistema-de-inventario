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
				$data['data'][$i]['stock'] = $data['data'][$i]['stock'] <= $data['data'][$i]['stock_critico'] ? '<span class="text-danger">' . $data['data'][$i]['stock'] .' <i class="fas fa-exclamation-triangle"></i>'. '</span>' : $data['data'][$i]['stock'];
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
				'nombre_producto' => 'required',
				'categoria' => 'required|is_not_unique[categoria.id]',
				'precio' => 'required|numeric|greater_than_equal_to[1]',
				'stock' => 'required|numeric|greater_than_equal_to[0]',
				'stock_critico' => 'required|numeric|greater_than_equal_to[0]',
			];

			$messages = [
				'nombre_producto' => [
					'required' => 'Debe ingresar el nombre del producto'
				],
				'categoria' => [
					'required' => 'Debe seleccionar una categoría',
					'is_not_unique' => 'Error categoría no existe'
				],
				'precio' => [
					'required' => 'Debe ingresar el precio',
					'numeric' => 'Precio debe ser un número',
					'greater_than_equal_to' => 'El precio de ser igual o mayor a 1'
				],
				'stock' => [
					'required' => 'Debe ingresar el stock actual del producto',
					'numeric' => 'Stock debe ser un numero',
					'greater_than_equal_to' => 'El stock de ser igual o mayor a 0'
				],
				'stock_critico' => [
					'required' => 'Debe ingresar el stock critico del producto',
					'numeric' => 'Stock Critico debe ser un numero',
					'greater_than_equal_to' => 'El stock critico de ser igual o mayor a 0'
				]
			];
			if (!$this->validate($rules, $messages)) {
				$msg['error'] = [
					'nombre_producto' => $this->validator->getError('nombre_producto'),
					'categoria' => $this->validator->getError('categoria'),
					'precio' => $this->validator->getError('precio'),
					'stock' => $this->validator->getError('stock'),
					'stock_critico' => $this->validator->getError('stock_critico'),
				];
			} else {
				$productoModel = new ProductoModel();
				$datos = [
					'nombre_producto' => $this->request->getPost('nombre_producto'),
					'categoria_id' => $this->request->getPost('categoria'),
					'precio' => $this->request->getPost('precio'),
					'stock' => $this->request->getPost('stock'),
					'stock_critico' => $this->request->getPost('stock_critico'),
					'usuario_id' => session('id'),
				];
				$productoModel->save($datos);
				$msg['success'] = 'Datos Ingresados correctamente';
			}
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	public function editar()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$categoriaModel = new CategoriaModel();
			$productoModel = new ProductoModel();
			$data['categorias'] = $categoriaModel->findAll();
			$data['producto'] = $productoModel->find($id);
			$msg['success'] = view("Producto/producto_editar", $data);
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	public function update()
	{
		if ($this->request->isAJAX()) {
			$rules = [
				'nombre_producto' => 'required',
				'categoria' => 'required|is_not_unique[categoria.id]',
				'precio' => 'required|numeric|greater_than_equal_to[1]',
				'stock' => 'required|numeric|greater_than_equal_to[0]',
				'stock_critico' => 'required|numeric|greater_than_equal_to[0]',
			];

			$messages = [
				'nombre_producto' => [
					'required' => 'Debe ingresar el nombre del producto'
				],
				'categoria' => [
					'required' => 'Debe seleccionar una categoría',
					'is_not_unique' => 'Error categoría no existe'
				],
				'precio' => [
					'required' => 'Debe ingresar el precio',
					'numeric' => 'Precio debe ser un número',
					'greater_than_equal_to' => 'El precio de ser igual o mayor a 1'
				],
				'stock' => [
					'required' => 'Debe ingresar el stock actual del producto',
					'numeric' => 'Stock debe ser un numero',
					'greater_than_equal_to' => 'El stock de ser igual o mayor a 0'
				],
				'stock_critico' => [
					'required' => 'Debe ingresar el stock critico del producto',
					'numeric' => 'Stock Critico debe ser un numero',
					'greater_than_equal_to' => 'El stock critico de ser igual o mayor a 0'
				]
			];
			if (!$this->validate($rules, $messages)) {
				$msg['error'] = [
					'nombre_producto' => $this->validator->getError('nombre_producto'),
					'categoria' => $this->validator->getError('categoria'),
					'precio' => $this->validator->getError('precio'),
					'stock' => $this->validator->getError('stock'),
					'stock_critico' => $this->validator->getError('stock_critico'),
				];
			} else {
				$productoModel = new ProductoModel();
				$datos = [
					'nombre_producto' => $this->request->getPost('nombre_producto'),
					'categoria_id' => $this->request->getPost('categoria'),
					'descripcion' => $this->request->getPost('descripcion'),
					'precio' => $this->request->getPost('precio'),
					'stock' => $this->request->getPost('stock'),
					'stock_critico' => $this->request->getPost('stock_critico'),
					'usuario_id' => session('id'),
				];
				$id = $this->request->getPost('id');
				$productoModel->update($id, $datos);
				$msg['success'] = 'Datos Ingresados correctamente';
			}
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}
	public function borrar()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$productoModel = new ProductoModel();
			$data = $productoModel->find($id);
			$msg['success'] = view("Producto/producto_borrar", $data);
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	public function delete()
	{
		if ($this->request->isAjax()) {
			$productoModel = new ProductoModel();
			$id = $this->request->getVar('id');
			$producto = $productoModel->find($id);
			if ($producto) {
				if ($producto['activo'] == 1) {
					$productoModel->update($id, ['activo' => 0]);
					$msg['success'] = "Producto #{$id} desactivado";
				} else {
					$productoModel->update($id, ['activo' => 1]);
					$msg['success'] = "Producto #{$id} activado";
				}
			} else {
				$msg['error'] = "Error al intentar modificar Producto #{$id}";
			}
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}
	//--------------------------------------------------------------------

}
