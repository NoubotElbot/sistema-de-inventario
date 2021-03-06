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
					$btnEditar = '<button type="button" class="btn-shadow btn btn-primary" onclick="edit(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></button>';
					if ($row['activo'] == 1) {
						$btnBorrar = '<button type="button" class="btn btn-danger" onclick="activar_desactivar(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fas fa-trash-alt"></i></button>';
					} else {
						$btnBorrar = '<button type="button" class="btn btn-warning" onclick="activar_desactivar(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-recycle"></i></button>';
					}
				}
				$data['data'][$i]['tipo'] = $data['data'][$i]['tipo'] == 1 ? 'Cliente' : 'Provedor';
				$data['data'][$i]['company'] = $data['data'][$i]['company'] != null ? $data['data'][$i]['company'] : 'N/A';
				$data['data'][$i]['create_at'] = date('d/m/Y H:i:s', strtotime($data['data'][$i]['create_at']));
				$data['data'][$i]['activo'] = $data['data'][$i]['activo'] == 1 ? 'Activo' : 'Desactivado';
				$data['data'][$i]['opciones'] = '<div class="btn-group">' . $btnEditar . $btnBorrar . '</div>';
				$i++;
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
				'nombre' => 'required|max_length[50]',
				'apellido' => 'required|max_length[50]',
				'tipo' => 'required',
				'telefono' => 'required',
				'email' => 'required|valid_email|is_unique[persona.email]',

			];

			$messages = [
				'nombre' => [
					'required' => 'Debe ingresar el nombre',
					'max_length' => 'Excede los 50 caracteres permitidos para Nombre'
				],
				'apellido' => [
					'required' => 'Debe ingresar el apellido',
					'max_length' => 'Excede los 50 caracteres permitidos para Apellido'
				],
				'tipo' => [
					'required' => 'Debe seleccionar el tipo'
				],
				'email' => [
					'required' => 'Debe ingresar un email',
					'valid_email' => 'Debe ingresar un email valido',
					'is_unique' => 'El email ingresado ya esta en uso'
				],
				'telefono' => [
					'required' => 'Debe ingresar el teléfono'
				],
			];
			if ($this->request->getPost('tipo') == 0) {
				$rules['company'] = 'required';
				$messages['company'] =  [
					'required' => 'Debe ingresar el nombre de la compañia u empresa del provedor'
				];
			}
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
				$personaModel = new PersonaModel();
				$datos = [
					'nombre' => $this->request->getPost('nombre'),
					'apellido' => $this->request->getPost('apellido'),
					'tipo' => $this->request->getPost('tipo'),
					'telefono' => $this->request->getPost('telefono'),
					'company' => $this->request->getPost('tipo') == 0 ? $this->request->getPost('company') : '',
					'email' => $this->request->getPost('email'),
					'direccion' => $this->request->getPost('direccion'),
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
			$id = $this->request->getVar('id');
			$rules = [
				'nombre' => 'required|max_length[50]',
				'apellido' => 'required|max_length[50]',
				'tipo' => 'required',
				'telefono' => 'required',
				'email' => "required|valid_email|is_unique[persona.email,id,$id]",

			];

			$messages = [
				'nombre' => [
					'required' => 'Debe ingresar el nombre',
					'max_length' => 'Excede los 50 caracteres permitidos para Nombre'
				],
				'apellido' => [
					'required' => 'Debe ingresar el apellido',
					'max_length' => 'Excede los 50 caracteres permitidos para Apellido'
				],
				'tipo' => [
					'required' => 'Debe seleccionar el tipo'
				],
				'email' => [
					'required' => 'Debe ingresar un email',
					'valid_email' => 'Debe ingresar un email valido',
					'is_unique' => 'El email ingresado ya esta en uso'
				],
				'telefono' => [
					'required' => 'Debe ingresar el teléfono'
				],
			];
			if ($this->request->getPost('tipo') == 0) {
				$rules['company'] = 'required';
				$messages['company'] =  [
					'required' => 'Debe ingresar el nombre de la compañia u empresa del provedor'
				];
			}
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
				$personaModel = new PersonaModel();
				$datos = [
					'nombre' => $this->request->getPost('nombre'),
					'apellido' => $this->request->getPost('apellido'),
					'tipo' => $this->request->getPost('tipo'),
					'telefono' => $this->request->getPost('telefono'),
					'company' => $this->request->getPost('tipo') == 0 ? $this->request->getPost('company') : '',
					'email' => $this->request->getPost('email'),
					'direccion' => $this->request->getPost('direccion'),
					'create_at' => date('Y-m-d H:i:s')
				];
				$personaModel->update($id, $datos);
				$msg['success'] = 'Registro actualizado correctamnete';
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
