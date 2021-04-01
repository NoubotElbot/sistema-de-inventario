<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\VentaModel;

class Vender extends BaseController
{
    public function obtenerProductos()
    {
        if ($this->request->isAjax()) {
            $productoModel = new ProductoModel();
            $data['productos'] = $productoModel
                ->where('activo', 1)
                ->where('stock > 0')
                ->orderBy('nombre_producto')
                ->findAll();
            if (!empty($data['productos'])) {
                return json_encode($data);
            } else {
                $data['error'] = 'No hay productos disponibles';
            }
        }
    }

    public function obtenerCarro()
    {
        if ($this->request->isAjax()) {
            return json_encode(['carro' => session('carro')]);
        }
    }

    public function agregarAlCarro()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getPost("id");
            $productoModel = new ProductoModel();
            $producto = $productoModel->find($id);
            if (!$producto) {
                return json_encode(['error' => 'Producto no encotrado']);
            }
            if ($producto['stock'] <= 0) {
                return json_encode(['error' => 'Producto sin stock']);
            }
            $productos = session('carro');
            $posibleIndice = $this->buscarIndiceDeProducto($producto['id'], $productos);
            // Producto no fue encontrado en el carro, es decir, es la primera vez que se agrega al carro
            if ($posibleIndice === -1) {
                $producto['cantidad'] = 1;
                array_push($productos, $producto);
            } else {
                if ($productos[$posibleIndice]['cantidad'] + 1 > $producto['stock']) {
                    return json_encode(['error' => 'No se pueden agregar más productos de este tipo, se quedarían sin existencia']);
                }
                $productos[$posibleIndice]['cantidad']++;
            }
            session()->set([
                'carro' => $productos,
            ]);
        }
    }

    private function buscarIndiceDeProducto(string $codigo, array &$productos)
    {
        foreach ($productos as $indice => $producto) {
            if ($producto['id'] === $codigo) {
                return $indice;
            }
        }
        return -1;
    }

    public function eliminarDelCarro()
    {
    }

    public function registrarVenta()
    {
    }

    public function cancelarVenta()
    {
    }
}
