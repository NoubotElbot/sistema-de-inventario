<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table      = 'venta';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['caja_id', 'usuario_id', 'persona_id', 'total', 'cash', 'descuento', 'tipo_operacion_id', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}