<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proveedor
 *
 * @author JuvenaL
 */
class Proveedor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    public function addProveedor() {

        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido_pat = $this->input->post('apellido_pat');
        $apellido_mat = $this->input->post('apellido_mat');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');
        $ciudad = $this->input->post('ciudad');


        $res = '';

        if (!empty($rut) && !empty($nombre) && !empty($apellido_pat) && !empty($apellido_mat) && !empty($telefono) && !empty($direccion) && !empty($ciudad)) {

            $nombre = strtoupper($nombre);
            $apellido_pat = strtoupper($apellido_pat);
            $apellido_mat = strtoupper($apellido_mat);        
            $direccion = strtoupper($direccion);
            $ciudad = strtoupper($ciudad);


            if ($this->Crud->addProveedor($rut, $nombre, $apellido_pat, $apellido_mat, $telefono, $direccion, $ciudad)) {
                $res = "Proveedor agregada exitosamente!";
            } else {
                $res = "Error de datos";
            }
        } else {
            $res = "Faltan Datos";
        }

        echo json_encode(array('value' => $res));
    }

    public function getProveedores() {
        echo json_encode($this->Crud->getProveedores());
    }

    public function editarProveedor() {
        $idproveedor = $this->input->post('idproveedor');
        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido_pat = $this->input->post('apellido_pat');
        $apellido_mat = $this->input->post('apellido_mat');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');
        $ciudad = $this->input->post('ciudad');

        $res = '';

        if (!empty($idproveedor) && !empty($rut) && !empty($nombre) && !empty($apellido_pat) && !empty($apellido_mat) && !empty($telefono) && !empty($direccion) && !empty($ciudad)) {
            if ($this->Crud->editProveedor($idproveedor, $rut, $nombre, $apellido_pat, $apellido_mat, $telefono, $direccion, $ciudad)) {
                $res = "Proveedor editado exitosamente!";
            } else {
                $res = "Ninguna fila modificada";
            }
        } else {
            $res = "Faltan Datos";
        }
        echo json_encode(array('value' => $res));
    }

    public function eliminarProveedor() {
        $idproveedor = $this->input->post('idproveedor');
        $res = '';
        if (!empty($idproveedor)) {
            if ($this->Crud->eliminarProveedor($idproveedor)) {
                $res = "Proveedor eliminado exitosamente!";
            } else {
                $res = 'Ninguna fila modificada';
            }
        } else {
            $res = "Faltan Datos";
        }
        echo json_encode(array('value' => $res));
    }

}
