<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['nombre_producto', 'descripcion', 'precio', 'stock', 'stock_critico', 'usuario_id', 'categoria_id', 'activo', 'create_at'];
}