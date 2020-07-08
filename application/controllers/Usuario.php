<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author JuvenaL
 */
class Usuario extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    public function getUsuarios() {
        echo json_encode($this->Crud->getUsuarios());
    }

    public function getCuenta() {
        $idcuenta = $this->input->post('idcuenta');
        $res = '';

        $cuenta = $this->Crud->getCuentaId($idcuenta);

        echo json_encode(array('value' => $cuenta));
    }

    public function addUsuario() {
        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido_pat = $this->input->post('apellido_pat');
        $apellido_mat = $this->input->post('apellido_mat');
        $telefono = $this->input->post('telefono');
        $institucion = $this->input->post('institucion');
        $direccion = $this->input->post('direccion');
        $password = $this->input->post('password');
        $ciudad = $this->input->post('ciudad');
        $tipo = $this->input->post('tipo');

        $res = '';

        if (!empty($institucion) && !empty($direccion) && !empty($ciudad) && !empty($rut) && !empty($nombre) && !empty($apellido_pat) && !empty($apellido_mat) && !empty($telefono)) {

            $rut = str_replace('-', "", $rut);
            $rut = str_replace('.', "", $rut);

            $nombre = strtoupper($nombre);
            $apellido_pat = strtoupper($apellido_pat);
            $apellido_mat = strtoupper($apellido_mat);           
            $institucion = strtoupper($institucion);
            $direccion = strtoupper($direccion);         
            $ciudad = strtoupper($ciudad); 


            $ncuenta = intval((($rut * 2 + ($rut / 2)) / 2) * 1.5);
            $this->Crud->addCuenta($ncuenta);

            $cuenta = $this->Crud->getCuenta($ncuenta);
            if ($this->Crud->addUsuario($rut, $nombre, $apellido_pat, $apellido_mat, $telefono, $institucion, $direccion, $password, $ciudad, $tipo, $cuenta[0]->idcuenta)) {

                $res = 'Usuario agregado';
            } else {
                $res = 'Filas sin modificar';
            }
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $res));
    }
    
    public function addSaldo()
    {
        $idcuenta = $this->input->post('idcuenta');
        $saldo = $this->input->post('saldo');

        $res = '';

        if (!empty($idcuenta) && !empty($saldo)) {
            $cuenta = $this->Crud->getCuentaId($idcuenta);            
            $saldoOriginal = $cuenta[0]->saldo;            
            $saldo = (int) $saldoOriginal + (int) $saldo;            
            if ($this->Crud->addSaldo($idcuenta, $saldo)) {
                $res = 'Saldo agregado con exito';
            } else {
                $res = 'Filas sin modificar';
            }
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $res));
    }

}
