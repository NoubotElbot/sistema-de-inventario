<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\VentaModel;

class Vender extends BaseController
{

    public function index()
    {
        $data['vista'] = 'venta';
        return view('Venta/vender', $data);
    }

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

    private function obtenerProductosDelCarro()
    {
        $productos = session("carro");
        if (!$productos) {
            $productos = [];
        }
        return $productos;
    }

    private function guardarProductos($productos)
    {
        session()->set([
            'carro' => $productos,
        ]);
    }

    public function obtenerCarro()
    {
        if ($this->request->isAjax()) {
            return json_encode(['carro' => $this->obtenerProductosDelCarro()]);
        }
    }

    public function quitarProductoDeVenta()
    {
        if ($this->request->isAjax()) {
            $indice = $this->request->getPost("indice");
            $productos = $this->obtenerProductosDelCarro();
            array_splice($productos, $indice, 1);
            $this->guardarProductos($productos);
            return json_encode('success');
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
            $productos = $this->obtenerProductosDelCarro();
            $posibleIndice = $this->buscarIndiceDeProducto($producto['id'], $productos);
            // Producto no fue encontrado en el carro, es decir, es la primera vez que se agrega al carro
            if ($posibleIndice === -1) {
                $producto['cantidad'] = 1;
                
                $producto['total'] = $producto['cantidad'] * $producto['precio_out'];
                array_push($productos, $producto);
            } else {
                if ($productos[$posibleIndice]['cantidad'] + 1 > $producto['stock']) {
                    return json_encode(['error' => 'No se pueden agregar más productos de este tipo, se quedaría sin existencia']);
                }
                $productos[$posibleIndice]['cantidad']++;
                $productos[$posibleIndice]['total'] = $productos[$posibleIndice]['cantidad'] * $productos[$posibleIndice]['precio_out'];
            }
            $this->guardarProductos($productos);
            return json_encode('success');
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

    public function cancelarVenta()
    {
        session()->remove('carro');
        return redirect()->route('venta');
    }

    //calmao
    // public function terminarOCancelarVenta(Request $request)
    // {
    //     if ($request->input("accion") == "terminar") {
    //         return $this->terminarVenta($request);
    //     } else {
    //         return $this->cancelarVenta();
    //     }
    // }

    // public function terminarVenta(Request $request)
    // {
    //     // Crear una venta
    //     $venta = new Venta();
    //     $venta->id_cliente = $request->input("id_cliente");
    //     $venta->saveOrFail();
    //     $idVenta = $venta->id;
    //     $productos = $this->obtenerProductos();
    //     // Recorrer carrito de compras
    //     foreach ($productos as $producto) {
    //         // El producto que se vende...
    //         $productoVendido = new ProductoVendido();
    //         $productoVendido->fill([
    //             "id_venta" => $idVenta,
    //             "descripcion" => $producto->descripcion,
    //             "codigo_barras" => $producto->codigo_barras,
    //             "precio" => $producto->precio_venta,
    //             "cantidad" => $producto->cantidad,
    //         ]);
    //         // Lo guardamos
    //         $productoVendido->saveOrFail();
    //         // Y restamos la existencia del original
    //         $productoActualizado = Producto::find($producto->id);
    //         $productoActualizado->existencia -= $productoVendido->cantidad;
    //         $productoActualizado->saveOrFail();
    //     }
    //     $this->vaciarProductos();
    //     return redirect()
    //         ->route("vender.index")
    //         ->with("mensaje", "Venta terminada");
    // }



    // private function vaciarProductos()
    // {
    //     $this->guardarProductos(null);
    // }






    // public function agregarProductoVenta(Request $request)
    // {
    //     $codigo = $request->post("codigo");
    //     $producto = Producto::where("codigo_barras", "=", $codigo)->first();
    //     if (!$producto) {
    //         return redirect()
    //             ->route("vender.index")
    //             ->with("mensaje", "Producto no encontrado");
    //     }
    //     $this->agregarProductoACarrito($producto);
    //     return redirect()
    //         ->route("vender.index");
    // }




}
