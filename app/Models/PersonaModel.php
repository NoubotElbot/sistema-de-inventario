<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table      = 'persona';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['nombre', 'apellido', 'company', 'direccion', 'email', 'telefono', 'tipo', 'activo', 'create_at'];
}