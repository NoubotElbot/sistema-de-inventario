<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{
	public function index()
	{
		$data['vista'] = 'categoria';
		return view('Categoria/categoria', $data);
	}

	public function obtenerData()
	{
		if ($this->request->isAJAX()) {
			$categoriaModel = new CategoriaModel();
			$data['data'] = $categoriaModel->findAll();
			$i = 0;
			foreach ($data['data'] as $row) {
				$btnEditar = "";
				$btnBorrar = "";
				if (session()->get('admin') == 1) {
					$btnEditar = '<button type="button" class="btn-shadow btn btn-primary" onclick="edit('.$row['id'].')" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></button>';
					if ($row['activo'] == 1) {
						$btnBorrar = '<button type="button" class="btn btn-danger" onclick="activar_desactivar('.$row['id'].')" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fas fa-trash-alt"></i></button>';
					} else {
						$btnBorrar = '<button type="button" class="btn btn-warning" onclick="activar_desactivar('.$row['id'].')" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-recycle"></i></button>';
					}
				}
				$data['data'][$i]['created_at'] = date('d/m/Y H:i:s',strtotime($data['data'][$i]['created_at']));
				$data['data'][$i]['activo'] = $data['data'][$i]['activo'] == 1 ? 'Activo':'Desactivado';
				$data['data'][$i]['opciones'] = '<div class="btn-group">'.$btnEditar.$btnBorrar.'</div>';
				$i ++;
			}

			return json_encode($data);
		} else {
			exit();
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
			} else {
				$msg['error'] = "Error al intentar modificar categoria #{$id}";
			}
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	//--------------------------------------------------------------------

}
