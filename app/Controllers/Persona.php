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
			$data['data'] = $personaModel->withDeleted()->findAll();
			foreach ($data['data'] as $i => $row) {
				$btnEditar = "";
				$btnBorrar = "";
				if (session()->get('admin') == 1) {
					$btnEditar = '<button type="button" class="btn-shadow btn btn-primary" onclick="edit(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></button>';
					if ($row['deleted_at'] == null) {
						$btnBorrar = '<button type="button" class="btn btn-danger" onclick="activar_desactivar(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fas fa-trash-alt"></i></button>';
					} else {
						$btnBorrar = '<button type="button" class="btn btn-warning" onclick="activar_desactivar(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-recycle"></i></button>';
					}
				}
				$data['data'][$i]['tipo'] = $data['data'][$i]['tipo'] == 1 ? 'Cliente' : 'Provedor';
				$data['data'][$i]['empresa'] = $data['data'][$i]['empresa'] != null ? $data['data'][$i]['empresa'] : 'N/A';
				$data['data'][$i]['opciones'] = '<div class="btn-group">' . $btnEditar . $btnBorrar . '</div>';
			}
			return json_encode($data);
		}
	}

	public function new()
	{
		if ($this->request->isAJAX()) {
			$msg['success'] = view("Persona/persona_agregar");
			return json_encode($msg);
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
					'empresa' => $this->request->getPost('tipo') == 0 ? $this->request->getPost('company') : null,
					'email' => $this->request->getPost('email'),
					'direccion' => $this->request->getPost('direccion'),
				];
				$personaModel->save($datos);
				$msg['success'] = 'Datos Ingresados correctamente';
			}
			return json_encode($msg);
		}
	}

	public function editar()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$personaModel = new PersonaModel;

			$data = $personaModel->withDeleted()->find($id);
			$msg['success'] = view("Persona/persona_editar", $data);
			return json_encode($msg);
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
					'empresa' => $this->request->getPost('tipo') == 0 ? $this->request->getPost('company') : '',
					'email' => $this->request->getPost('email'),
					'direccion' => $this->request->getPost('direccion'),
				];
				$personaModel->update($id, $datos);
				$msg['success'] = "Registro #$id actualizado correctamnete";
			}
			return json_encode($msg);
		}
	}

	public function borrar()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$personaModel = new PersonaModel;

			$data = $personaModel->withDeleted()->find($id);
			$msg['success'] = view("Persona/persona_borrar", $data);
			return json_encode($msg);
		}
	}

	public function delete()
	{
		if ($this->request->isAjax()) {
			$personaModel = new PersonaModel();
			$id = $this->request->getVar('id');
			$persona = $personaModel->withDeleted()->find($id);
			if ($persona) {
				if ($persona['deleted_at'] == null) {
					$personaModel->delete($id);
					$msg['success'] = "Persona #{$id} desactivada";
				} else {
					$personaModel->update($id, ['deleted_at' => null]);
					$msg['success'] = "Persona #{$id} activada";
				}
			} else {
				$msg['error'] = "Error al intentar modificar persona #{$id}";
			}
			return json_encode($msg);
		}
	}

	//--------------------------------------------------------------------

}
