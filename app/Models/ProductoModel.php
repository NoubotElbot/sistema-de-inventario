<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['nombre_producto', 'descripcion', 'precio_in','precio_out', 'stock', 'stock_critico', 'usuario_id', 'categoria_id', 'activo', 'created_at','updated_at'];
}