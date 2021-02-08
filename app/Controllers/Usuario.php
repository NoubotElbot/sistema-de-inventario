<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController
{

    public function index()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            //let's do the validation here
            $rules = [
                'username' => 'required',
                'password' => 'required|validateUser[username,password]',
            ];
            $messages = [
                'password' => [
                    'validateUser' => 'Credenciales incorrectas, intentelo nuevamente',
                    'required' => 'Ingrese la contraseña'
                ],
                'username' => [
                    'required' => 'Ingrese el nombre de usuario'
                ]
            ];
            if (!$this->validate($rules, $messages)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UsuarioModel();
                $user = $model->where('username', $this->request->getVar('username'))
                    ->first();
                $this->setUserSession($user);
                return redirect()->to('home');
            }
        }

        return view('Usuario/login', $data);
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'username' => $user['username'],
            'nombre' => $user['nombre'],
            'apellido' => $user['apellido'],
            'activo' => $user['activo'],
            'email' => $user['email'],
            'admin' => $user['admin'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }


    public function lista()
    {
        helper(['form']);
        $data['rows'] = 10;
        $data['user'] = '';
        if ($this->request->getPostGet('rows')) {
            $data['rows'] = $this->request->getPostGet('rows');
        }
        $usuarioModel = new UsuarioModel($db);
        if ($this->request->getPostGet('user')) {
            $data['user'] = $this->request->getPostGet('user');
            $data['usuarios'] = $usuarioModel->select('usuario.*, perfil.perfil')
                ->join('perfil', 'usuario.perfil_id = perfil.id')
                ->where("username like '%" . $data['user'] . "%' OR nombre like '%" . $data['user'] . "%' OR apellido like '%" . $data['user'] . "%'")
                ->paginate($data['rows']);
        } else {
            $data['usuarios'] = $usuarioModel->select('usuario.*, perfil.perfil')
                ->join('perfil', 'usuario.perfil_id = perfil.id')
                ->paginate($data['rows']);
        }
        $paginador = $usuarioModel->pager;
        $data['paginador'] = $paginador;

        $data['vista'] = 'usuario';
        $estructura = view('estructura/header', $data) . view('estructura/modals') . view('Usuario/usuario') . view('estructura/footer');
        return $estructura;
    }

    public function registrar()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //let's do the validation here
            $rules = [
                'username' => 'required|min_length[3]|max_length[30]|is_unique[usuario.username]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[usuario.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
                'perfil_id' => 'required',
                'nombre' => 'required|min_length[1]|max_length[30]',
                'apellido' => 'required|min_length[1]|max_length[30]'
            ];

            $errors = [
                'username' => [
                    'required' => 'Debe ingresar el nombre de usuario',
                    'min_length' => 'Debe ingresar minimo 3 caracteres para el nombre de usuario',
                    'max_length' => 'Debe ingresar maximo 30 caracteres para el nombre de usuario',
                    'is_unique' => 'El nombre de usuario ya esta en uso',
                ],
                'email' => [
                    'required' => 'Debe ingresar el email',
                    'min_length' => 'Debe ingresar minimo 6 caracteres para el email',
                    'max_length' => 'Debe ingresar maximo 50 caracteres para el email',
                    'is_unique' => 'El email ya esta en uso',
                    'valid_email' => 'El email no cumple con el formato de una email valido'
                ],
                'password' => [
                    'required' => 'Debe ingresar una contraseña',
                    'min_length' => 'Debe ingresar minimo 8 caracteres para la contraseña',
                ],
                'password_confirm' => [
                    'matches' => 'Las contraseñas no coinciden',
                ],
                'nombre' => [
                    'required' => 'Debe ingresar el nombre',
                    'min_length' => 'Debe ingresar minimo 1 caracteres para el nombre',
                    'max_length' => 'Debe ingresar maximo 30 caracteres para el nombre',
                ],
                'apellido' => [
                    'required' => 'Debe ingresar el apellido',
                    'min_length' => 'Debe ingresar minimo 1 caracteres para el apellido',
                    'max_length' => 'Debe ingresar maximo 30 caracteres para el apellido',
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UsuarioModel($db);

                $newData = [
                    'username' => $this->request->getVar('username'),
                    'nombre' => $this->request->getVar('nombre'),
                    'apellido' => $this->request->getVar('apellido'),
                    'email' => $this->request->getVar('email'),
                    'perfil_id' => $this->request->getVar('perfil_id'),
                    'password' => $this->request->getVar('password'),
                ];
                $model->save($newData);
                session()->setFlashdata('success', "Usuario registrado Exitosamente. " . $newData['username']);
                return redirect()->route('lista-usuarios');
            }
        }
        $vista['vista'] = 'usuario';
        $estructura = view('estructura/header', $vista) . view('Usuario/registrar', $data) . view('estructura/footer');
        return $estructura;
    }

    public function perfil()
    {
        $data = [];
        helper(['form']);
        $user = new UsuarioModel($db);

        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPostGet('id');
            //let's do the validation here
            $rules = [
                'email' => "required|min_length[6]|max_length[50]|valid_email|is_unique[usuario.email,id,$id]",
                'perfil_id' => 'required',
                'nombre' => 'required|min_length[3]|max_length[30]',
                'apellido' => 'required|min_length[3]|max_length[30]'
            ];
            $errors = [
                'email' => [
                    'required' => 'Debe ingresar el email',
                    'min_length' => 'Debe ingresar minimo 6 caracteres para el email',
                    'max_length' => 'Debe ingresar maximo 50 caracteres para el email',
                    'valid_email' => 'El email no cumple con el formato de una email valido',
                    'is_unique' => 'El email ingresado ya esta en uso'
                ],
                'nombre' => [
                    'required' => 'Debe ingresar el nombre',
                    'min_length' => 'Debe ingresar minimo 3 caracteres para el nombre',
                    'max_length' => 'Debe ingresar maximo 30 caracteres para el nombre',
                ],
                'apellido' => [
                    'required' => 'Debe ingresar el apellido',
                    'min_length' => 'Debe ingresar minimo 3 caracteres para el apellido',
                    'max_length' => 'Debe ingresar maximo 30 caracteres para el apellido',
                ],
            ];

            if ($this->request->getPost('password') != '') {
                $rules['password'] = 'required|min_length[8]|max_length[255]';
                $rules['password_confirm'] = 'matches[password]';
                $errors = [
                    'password' => [
                        'required' => 'Debe ingresar una contraseña',
                        'min_length' => 'Debe ingresar minimo 8 caracteres para la contraseña',
                    ],
                    'password_confirm' => [
                        'matches' => 'Las contraseñas no coinciden',
                    ]
                ];
            }

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UsuarioModel($db);

                $newData = [
                    'nombre' => $this->request->getVar('nombre'),
                    'apellido' => $this->request->getVar('apellido'),
                    'email' => $this->request->getVar('email'),
                    'perfil_id' => $this->request->getVar('perfil_id'),
                ];
                if ($this->request->getPost('password') != '') {
                    $newData['password'] = $this->request->getPost('password');
                }
                $model->update($id, $newData);
                session()->setFlashdata('success', '¡Actualización exitosa! Los cambios en la sesión seran reflejados al volver a entrar');
            }
        }
        $id = $this->request->getPostGet('id');
        $data['user'] = $user->find($id);
        $perfil = new PerfilModel($db);
        $data['perfiles'] = $perfil->where('estado', '0')->findAll();
        $vista['vista'] = 'usuario';
        $estructura = view('estructura/header', $vista) . view('Usuario/perfil', $data) . view('estructura/footer');
        return $estructura;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->route('login');
    }
}
