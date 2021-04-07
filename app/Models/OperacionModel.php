<?php

namespace App\Models;

use CodeIgniter\Model;

class OperacionModel extends Model
{
    protected $table      = 'operacion';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
    protected $allowedFields = [
        'id',
        'producto_id',
        'cantidad',
        'tipo_operacion_id',
        'venta_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
