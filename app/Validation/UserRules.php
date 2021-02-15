<?php

namespace App\Validation;

use App\Models\UsuarioModel;

class UserRules {

    public function validateUser(string $str, string $fields, array $data) {
        $model = new UsuarioModel();
        $user = $model->where('username', $data['username'])->where('activo',1)
                ->first();

        if (!$user) {
            return false;
        }
        return password_verify($data['password'], $user['password']);
    }
    public function validatePass(string $str, string $fields, array $data) {
        $model = new UsuarioModel();
        $user = $model->where('id', $data['id'])->where('activo',1)
                ->first();

        if (!$user) {
            return false;
        }
        return password_verify($data['password'], $user['password']);
    }
}
