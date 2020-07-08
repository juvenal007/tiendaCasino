<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Producto
 *
 * @author JuvenaL
 */
class Producto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    public function agregarProducto() {
        $nombre = $this->input->post('nombre');
        $codigo = $this->input->post('codigo');
        $stock = $this->input->post('stock');
        $p_compra = $this->input->post('p_compra');
        $p_venta = $this->input->post('p_venta');
        $descripcion = $this->input->post('descripcion');
        $imagen = $this->input->post('imagen');
        $idcategoria = $this->input->post('idcategoria');
        $idproveedor = $this->input->post('idproveedor');

        $res = '';

        if (!empty($nombre) && !empty($codigo) && !empty($stock) && !empty($p_compra) && !empty($p_venta) && !empty($descripcion) && !empty($idcategoria) && !empty($idproveedor)) {
            
            $nombre = strtoupper($nombre);
            $descripcion = strtoupper($descripcion);
            
            
            if ($imagen == '') {
                $imagen = 'http://localhost/tiendaCasino/uploads/default.jpg';
            }
            if ($this->Crud->addProducto($nombre, $codigo, $stock, $p_compra, $p_venta, $descripcion, $imagen, $idcategoria, $idproveedor)) {
                $res = "Producto agregado exitosamente!";
            } else {
                $res = "Filas sin modificar";
            }
        } else {
            $res = "Faltan Datos";
        }
        echo json_encode(array('value' => $res));
    }

    public function getProductos() {
        echo json_encode($this->Crud->getProductos());
    }

    public function editarProducto() {
        $nombre = $this->input->post('nombre');
        $codigo = $this->input->post('codigo');
        $stock = $this->input->post('stock');
        $p_compra = $this->input->post('p_compra');
        $p_venta = $this->input->post('p_venta');
        $descripcion = $this->input->post('descripcion');
        $idproducto = $this->input->post('idproducto');

        $res = '';

        if (!empty($nombre) && !empty($codigo) && !empty($stock) && !empty($p_compra) && !empty($p_venta) && !empty($descripcion) && !empty($idproducto)) {

            if ($this->Crud->editProducto($idproducto, $nombre, $codigo, $stock, $p_compra, $p_venta, $descripcion)) {
                $res = "Producto editado exitosamente!";
            } else {
                $res = "Filas sin modificar";
            }
        } else {
            $res = "Faltan Datos";
        }
        echo json_encode(array('value' => $res));
    }

    public function eliminarProducto() {
        $idproducto = $this->input->post('idproducto');
        $res = '';
        if (!empty($idproducto)) {
            if ($this->Crud->eliminarProducto($idproducto)) {
                $res = "Producto eliminado exitosamente!";
            } else {
                $res = 'Ninguna fila modificada';
            }
        } else {
            $res = "Faltan Datos";
        }
        echo json_encode(array('value' => $res));
    }

    public function listaProdCat() {
        $idcategoria = $this->input->post('idcategoria');

        if (!empty($idcategoria)) {
            echo json_encode($this->Crud->listaProdCat($idcategoria));
        }
    }

    public function finCompra() {
        $total = $this->input->post('total');
        $totalU = $this->input->post('totalU');
        $idusuario = $this->input->post('idusuario');
        $productosAgregados = $this->input->post('productosAgregados');
        $cantidad = $this->input->post('cantidad');
        $precio = $this->input->post('precio');
        $idcuenta = $this->input->post('idcuenta');
        $totalCompra = $this->input->post('totalCompra');

        $res = '';

        if (!empty($total) && !empty($idusuario) && !empty($productosAgregados) && !empty($cantidad) && !empty($precio) && !empty($idcuenta)) {

            $productosAgregados = explode('-', $productosAgregados);
            array_pop($productosAgregados);

            $largo = sizeof($productosAgregados);

            $cantidad = explode('-', $cantidad);
            array_pop($cantidad);

            $precio = explode('-', $precio);
            array_pop($precio);

            $totalCompra = explode('-', $totalCompra);
            array_pop($totalCompra);

            $cuenta = $this->Crud->getCuentaId($idcuenta);

            if ($this->Crud->addCompra($totalU, $total, $largo, $idusuario)) {

                $ultimaCompra = $this->Crud->ultimaCompra();


                for ($i = 0; $i < $largo; $i++) {
                    $producto = $this->Crud->getProducto($productosAgregados[$i]);
                    $this->Crud->addDetalleCompra($precio[$i], $producto[0]->descripcion, $producto[0]->nombre, $cantidad[$i], $totalCompra[$i], $ultimaCompra[0]->idcompra, $productosAgregados[$i]);
                    $stockOriginal = $producto[0]->stock;
                    $saldoOriginal = $cuenta[0]->saldo;
                    if (($stockOriginal <= 0) && ($saldoOriginal < $total)) {
                        $res = 'error';
                    } else {
                        $nuevoStock = (int) $stockOriginal - $cantidad[$i];
                        $idproducto = $producto[0]->idproducto;
                        $this->Crud->descontarStock($idproducto, $nuevoStock);

                        $nuevoSaldo = (int) $saldoOriginal -  (int)$total;
                        
                        $this->Crud->descontarSaldo($cuenta[0]->idcuenta, $nuevoSaldo);
                    }
                }

                $res = 'Compra agregada';
            } else {
                $res = 'Ninguna fila modificada';
            }
        } else {
            $res = 'Faltan Datos';
        }
        echo json_encode(array('value' => $res));
    }

}
