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

	public function editar($id)
	{
		$data = [];
		$data['vista'] = 'categoria-editar';
		$categoriaModel = new CategoriaModel();
		helper(['form']);
		if ($this->request->getMethod() === 'put') {
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
			if ($this->validate($rules, $messages)) {

				$datos = [
					'nombre' => $this->request->getPost('nombre'),
					'descripcion' => $this->request->getPost('descripcion'),
					'create_at' => date('Y-m-d H:i:s')
				];
				$categoriaModel->update($id, $datos);
				return redirect()->to("/categoria");
			}
		}
		$data['categoria'] = $categoriaModel->find($id);
		return view('Categoria/categoria_editar', $data);
	}

	public function desactivar($id)
	{
		$categoriaModel = new CategoriaModel();
		if ($this->request->getMethod() === 'delete') {
			$categoriaModel->update($id, ['activo' => 0]);
		}
		if ($this->request->getMethod() === 'put') {
			$categoriaModel->update($id, ['activo' => 1]);
		}
		return redirect()->to('/categoria');
	}

	//--------------------------------------------------------------------

}
