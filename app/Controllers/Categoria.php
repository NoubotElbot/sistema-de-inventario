<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{
	public function index()
	{
		$data['vista'] = 'categoria-lista';
		// $categoriaModel = new CategoriaModel();
		// $data['categorias'] = $categoriaModel->findAll();

		return view('Categoria/categoria', $data);
	}

	public function obtenerData()
	{
		if ($this->request->isAJAX()) {
			$categoriaModel = new CategoriaModel();
			$data['categorias'] = $categoriaModel->findAll();
			$msg['data'] = view('Categoria/categoria_lista', $data);
			return json_encode($msg);
		} else {
			exit('error');
		}
	}


	public function agregar()
	{
		if ($this->request->isAJAX()) {
			$rules = [
				'nombre' => 'required',
				'descripcion' => 'max_length[255]'
			];
			$messages = [
				'nombre' => [
					'required' => 'Debe ingresar el nombre'
				],
				'descripcion' => [
					'max_length' => 'Descripcion excede el largo de 255 caracteres'
				]
			];
			if (!$this->validate($rules, $messages)) {
				$msg['error'] = [
					'nombre' => $this->validator->getError('nombre'),
					'descripcion' => $this->validator->getError('descripcion'),
				];
			} else {
				$categoriaModel = new CategoriaModel();
				$datos = [
					'nombre' => $this->request->getPost('nombre'),
					'descripcion' => $this->request->getPost('descripcion'),
					'create_at' => date('Y-m-d H:i:s')
				];
				$categoriaModel->save($datos);
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
			$categoriaModel = new CategoriaModel;

			$data = $categoriaModel->find($id);
			$msg['success'] = view("Categoria/categoria_editar", $data);
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	public function update()
	{
		if ($this->request->isAJAX()) {
			$rules = [
				'nombre' => 'required',
				'descripcion' => 'max_length[255]'
			];
			$messages = [
				'nombre' => [
					'required' => 'Debe ingresar el nombre'
				],
				'descripcion' => [
					'max_length' => 'Descripcion excede el largo de 255 caracteres'
				]
			];
			if (!$this->validate($rules, $messages)) {
				$msg['error'] = [
					'nombre' => $this->validator->getError('nombre'),
					'descripcion' => $this->validator->getError('descripcion'),
				];
			} else {
				$categoriaModel = new CategoriaModel();
				$datos = [
					'nombre' => $this->request->getPost('nombre'),
					'descripcion' => $this->request->getPost('descripcion'),
					'create_at' => date('Y-m-d H:i:s')
				];
				$id = $this->request->getPost('id');
				$categoriaModel->update($id, $datos);
				$msg['success'] = "Categoria #{$id} modificada exitosamente";
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
			$categoriaModel = new CategoriaModel;

			$data = $categoriaModel->find($id);
			$msg['success'] = view("Categoria/categoria_borrar", $data);
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	public function delete()
	{
		if ($this->request->isAjax()) {
			$categoriaModel = new CategoriaModel();
			$id = $this->request->getVar('id');
			$categoria = $categoriaModel->find($id);
			if ($categoria) {
				if ($categoria['activo'] == 1) {
					$categoriaModel->update($id, ['activo' => 0]);
					$msg['success'] = "Categoria #{$id} desactivada";
				} else {
					$categoriaModel->update($id, ['activo' => 1]);
					$msg['success'] = "Categoria #{$id} activada";
				}
				
			}else{
				$msg['error'] = "Error al intentar modificar categoria #{$id}";
			}
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	//--------------------------------------------------------------------

}
