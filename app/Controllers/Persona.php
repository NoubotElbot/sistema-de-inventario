<?php

namespace App\Controllers;

use App\Models\PersonaModel;

class Persona extends BaseController
{
	public function index()
	{
		$data['vista'] = 'persona';
		return view('Persona/persona', $data);
	}

	public function obtenerData()
	{
		if ($this->request->isAJAX()) {
			$personaModel = new PersonaModel();
			$data['data'] = $personaModel->findAll();
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
                $data['data'][$i]['tipo'] = $data['data'][$i]['tipo'] == 1 ? 'Cliente' : 'Provedor';
				$data['data'][$i]['create_at'] = date('d/m/Y H:i:s',strtotime($data['data'][$i]['create_at']));
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
			];
			$messages = [
				'nombre' => [
					'required' => 'Debe ingresar el nombre'
				],
			];
			if (!$this->validate($rules, $messages)) {
				$msg['error'] = [
					'nombre' => $this->validator->getError('nombre'),
				];
			} else {
				$personaModel = new PersonaModel();
				$datos = [
					'nombre' => $this->request->getPost('nombre'),
					'create_at' => date('Y-m-d H:i:s')
				];
				$personaModel->save($datos);
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
			$personaModel = new PersonaModel;

			$data = $personaModel->find($id);
			$msg['success'] = view("Persona/persona_editar", $data);
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
				$personaModel = new PersonaModel();
				$datos = [
					'nombre' => $this->request->getPost('nombre'),
					'descripcion' => $this->request->getPost('descripcion'),
					'create_at' => date('Y-m-d H:i:s')
				];
				$id = $this->request->getPost('id');
				$personaModel->update($id, $datos);
				$msg['success'] = "Persona #{$id} modificada exitosamente";
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
			$personaModel = new PersonaModel;

			$data = $personaModel->find($id);
			$msg['success'] = view("Persona/persona_borrar", $data);
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	public function delete()
	{
		if ($this->request->isAjax()) {
			$personaModel = new PersonaModel();
			$id = $this->request->getVar('id');
			$persona = $personaModel->find($id);
			if ($persona) {
				if ($persona['activo'] == 1) {
					$personaModel->update($id, ['activo' => 0]);
					$msg['success'] = "Persona #{$id} desactivada";
				} else {
					$personaModel->update($id, ['activo' => 1]);
					$msg['success'] = "Persona #{$id} activada";
				}
			} else {
				$msg['error'] = "Error al intentar modificar persona #{$id}";
			}
			return json_encode($msg);
		} else {
			exit('Nope');
		}
	}

	//--------------------------------------------------------------------

}
