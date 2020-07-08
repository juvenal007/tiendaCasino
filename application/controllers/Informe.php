<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Informes
 *
 * @author JuvenaL
 */
class Informe extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
        $this->load->library('Excel');
    }

    public function getInformeVentas() {
        $fechaInicio = $this->input->post('fechaInicio');
        $fechaFin = $this->input->post('fechaFin');
        $res = '';
        $value = '';
        if (!empty($fechaInicio) && !empty($fechaFin)) {

            list($dia1, $mes1, $ano1) = explode('/', $fechaInicio);
            list($dia2, $mes2, $ano2) = explode('/', $fechaFin);

            $value = $this->Crud->getInformeVentas($dia1, $mes1, $ano1, $dia2, $mes2, $ano2);

            if (count($value) >= 1) {
                $res = 'Cargando Datos';
            } else {
                $res = 'Sin datos';
            }
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $value,
            'msg' => $res));
    }

    public function getInformeCuentas() {
        $ncuenta = $this->input->post('ncuenta');

        $res = '';
        $value = '';
        $compras = '';
        $usuario = '';
        if (!empty($ncuenta)) {
            try {
                $cuenta = $this->Crud->getCuenta($ncuenta);
                if (count($cuenta) > 0) {
                    $usuario = $this->Crud->getUsuarioCuenta($cuenta[0]->idcuenta);

                    if (count($usuario) > 0) {
                        $compras = $this->Crud->getComprasUsuario($usuario[0]->idusuario);

                        $largo = sizeof($compras);

                        if (count($compras) > 0) {
                            $res = 'Cargando Datos';
                        } else {
                            $res = 'Sin datos';
                        }
                    } else {
                        $res = 'Sin datos';
                    }
                } else {
                    $res = 'Sin datos';
                }
            } catch (Exception $ex) {
                $res = 'sin datos';
            }
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $usuario,
            'compras' => $compras,
            'msg' => $res));
    }

    public function getDetalleCompra() {
        $idcompra = $this->input->post('idcompra');

        $res = '';
        $value = '';
        if (!empty($idcompra)) {

            $value = $this->Crud->getDetalleCompra($idcompra);

            if (count($value) >= 1) {
                $res = 'Cargando Datos';
            } else {
                $res = 'Sin datos';
            }
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $value,
            'msg' => $res));
    }

    public function getInformeProductosCat() {
        $res = '';
        $value = '';
        $categorias = $this->Crud->getCategorias();

        $productos = $this->Crud->getProductosCat();

        $largo = sizeof($categorias);

        if (count($categorias) > 0) {

            for ($i = 0; $i < $largo; $i++) {

                $cat = $this->Crud->getCountCategorias($categorias[$i]->idcategoria);

                $arrayCat[] = $cat;
            }
        } else {
            $res = 'Sin datos';
        }

        echo json_encode(array('value' => $arrayCat,
            'categorias' => $categorias,
            'productos' => $productos,
            'msg' => $res));
    }

    public function exportarExcel() {
        $producto = $this->Crud->getAllProductos();
        $nuevoP = [];
        foreach ($producto as $p) {
            if ($p->estado == 'ACTIVO') {
                array_push($nuevoP, $p);
            }
        }


        if (count($nuevoP) > 0) {
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle('Inventario');


            $cont = 1;
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(7);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8);

            $this->excel->getActiveSheet()->getStyle("A{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("B{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("C{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("D{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("E{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("F{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("G{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("H{$cont}")->getFont()->setBold(true);

            $this->excel->getActiveSheet()->getStyle("A{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("B{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("C{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("D{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("E{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("F{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("G{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("H{$cont}")->getFont()->setSize(9);

            //Definimos los títulos de la cabecera.
            $this->excel->getActiveSheet()->setCellValue("A{$cont}", 'ID');
            $this->excel->getActiveSheet()->setCellValue("B{$cont}", 'NOMBRE');
            $this->excel->getActiveSheet()->setCellValue("C{$cont}", 'DESCRIPCION');
            $this->excel->getActiveSheet()->setCellValue("D{$cont}", 'STOCK');
            $this->excel->getActiveSheet()->setCellValue("E{$cont}", 'VENTA');
            $this->excel->getActiveSheet()->setCellValue("F{$cont}", 'COMPRA');
            $this->excel->getActiveSheet()->setCellValue("G{$cont}", 'CODIGO');
            $this->excel->getActiveSheet()->setCellValue("H{$cont}", 'ESTADO');


            foreach ($nuevoP as $p) {
                $cont++;

                $this->excel->getActiveSheet()->getStyle("A{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("B{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("C{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("D{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("E{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("F{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("G{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("H{$cont}")->getFont()->setSize(9);


                $this->excel->getActiveSheet()->getStyle("D{$cont}")->getFont()->setBold(true);

                $this->excel->getActiveSheet()->setCellValue("A{$cont}", $p->idproducto);
                $this->excel->getActiveSheet()->setCellValue("B{$cont}", $p->nombre);
                $this->excel->getActiveSheet()->setCellValue("C{$cont}", $p->descripcion);
                $this->excel->getActiveSheet()->setCellValue("D{$cont}", $p->stock);
                $this->excel->getActiveSheet()->setCellValue("E{$cont}", $p->p_venta);
                $this->excel->getActiveSheet()->setCellValue("F{$cont}", $p->p_compra);
                $this->excel->getActiveSheet()->setCellValue("G{$cont}", $p->codigo);
                $this->excel->getActiveSheet()->setCellValue("H{$cont}", $p->estado);
            }
            $hora = strftime("%H:%M:%S", time());
            $fecha = strftime("%Y-%m-%d", time());
            $archivo = "INVENTARIOFecha:{$fecha}Hora:{$hora}.xls";
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $archivo . '"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            $objWriter->save('php://output');
        } else {
            echo 'No se han encontrado llamadas';
            exit;
        }
    }

}
