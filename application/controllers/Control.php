<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Control
 *
 * @author JuvenaL
 */
class Control extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    public function index() {
        $this->load->view('login');
    }

    public function login() {

        $rut = $this->input->post('rut');
        $password = $this->input->post('password');
        $ruta = "";
        $user = "";
        $res = "";
        if (isset($rut) && isset($password)) {
            $user = $this->Crud->iniciarSesion($rut, sha1(md5($password)));
            if (count($user) > 0) {
                if ($user[0]->tipo == "ADMINISTRADOR") {
                    $ruta = base_url() . "menuAdmin";
                    $res = "Administrador";
                    $this->session->set_userdata("admin", $user);
                } else if($user[0]->tipo == "USUARIO") {
                    $res = "Usuario";
                    $ruta = base_url(). "menuCasino";
                    $this->session->set_userdata("user", $user);
                }
            } else {
                $res = "Usuario no valido";
            }
        } else {
            $res = "Datos incorrectos";
        }
        echo json_encode(array('value' => $res, 'ruta' => $ruta, 'user' => $user));
    }
    
     public function getSession() {

        $user = $this->session->userdata('user');
        $admin = $this->session->userdata('admin');

        if (isset($user)) {
            echo json_encode(array($user[0]));
        }
        if (isset($admin)) {
            echo json_encode(array($admin[0]));
        }
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
    public function contarUsuarios()
    {
        echo json_encode(array($this->Crud->contarUsuarios()));
    }
    
    public function contarProductos()
    {
         echo json_encode(array($this->Crud->contarProductos()));
    }
    public function contarCategorias()
    {
         echo json_encode(array($this->Crud->contarCategorias()));
    }
    public function contarVentas()
    {
         echo json_encode(array($this->Crud->contarVentas()));
    }
    
    public function contarProveedores()
    {
         echo json_encode(array($this->Crud->contarProveedores()));
    }
    public function cantidadProdComprados()
    {
         echo json_encode(array($this->Crud->cantidadProdComprados()));
    }

}
