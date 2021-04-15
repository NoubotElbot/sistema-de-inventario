<?php

namespace App\Controllers;

use App\Models\CajaModel;
use App\Models\PersonaModel;
use App\Models\ProductoModel;
use App\Models\OperacionModel;
use App\Models\VentaModel;

class Vender extends BaseController
{

    public function index()
    {
        $data['vista'] = 'venta';
        $cajaModel = new CajaModel();
        $data['cajas'] = $cajaModel->findAll();
        return view('Venta/vender', $data);
    }

    public function obtenerProductos()
    {
        if ($this->request->isAjax()) {
            $productoModel = new ProductoModel();
            $data['productos'] = $productoModel
                ->where('stock > 0')
                ->orderBy('nombre_producto')
                ->findAll();
            if (empty($data['productos'])) {
                return json_encode(['error' => 'No hay productos disponibles']);
            }
            return json_encode($data);
        }
    }
    public function obtenerClientes()
    {
        if ($this->request->isAJAX()) {
            $personaModel = new PersonaModel();
            $data['clientes'] = $personaModel
                ->where('tipo', 1)
                ->orderBy('nombre')
                ->findAll();
            if (empty($data['clientes'])) {
                return json_encode(['error' => 'No hay clientes disponibles']);
            }
            return json_encode($data);
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
            $codigo = $this->request->getPost("codigo");
            $productoModel = new ProductoModel();
            $producto = $productoModel->where('codigo', $codigo)->first();
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

    public function terminarCancelar()
    {
        if ($this->request->getPost("accion") == "terminar") {
            return $this->terminarVenta();
        } else {
            return $this->cancelarVenta();
        }
    }

    private function vaciarProductos()
    {
        session()->remove('carro');
    }

    private function cancelarVenta()
    {
        $this->vaciarProductos();
        return redirect()->route('venta');
    }

    public function terminarVenta()
    {
        $reglas = [
            'cliente' => 'required|is_not_unique[cliente.id]',
            'caja' => 'required|is_not_unique[caja.id]',
        ];
        $mensaje = [
            'cliente' => [
                'required' => 'Debe seleccionar al cliente',
                'is_not_unique' => 'Error cliente no exite'
            ],
            'caja' => [
                'required' => 'Debe seleccionar una caja',
                'is_not_unique' => 'Error caja no exite'
            ],
        ];

        if (!$this->validate($reglas, $mensaje) || !$this->obtenerProductosDelCarro()) {
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to('vender');
        } else {
            $ventaModel = new VentaModel();
            $productos = $this->obtenerProductosDelCarro();
            $total = 0;
            foreach ($productos as $p) {
                $total += $p['precio_out'] * $p['cantidad'];
            }
            $data = [
                'caja_id' => $this->request->getPost('caja'),
                'usuario_id' => session('id'),
                'persona_id' => $this->request->getPost('cliente'),
                'total' => $total,
                'cash' => $total,
                'decuento' => 0,
                'tipo_operacion_id' => 2
            ];
            if ($ventaModel->save($data)) {
                $idVenta = $ventaModel->selectMax('id')->first();
                $operacionModel = new OperacionModel();
                $productoModel = new ProductoModel();
                foreach ($productos as $p) {
                    $operacion = [
                        'producto_id' => $p['id'],
                        'cantidad' => $p['cantidad'],
                        'venta_id' => $idVenta['id'],
                        'tipo_operacion_id' => 2
                    ];
                    $operacionModel->save($operacion);
                    // Y restamos el stock
                    $productoModel->set('stock', "stock-{$p['cantidad']}", false)->update($p['id']);
                }
            }
            $this->vaciarProductos();
            session()->setFlashdata('success', 'Venta realizada con exito');
            return redirect()->to('venta');
        }
    }
}
