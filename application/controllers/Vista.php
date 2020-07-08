<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vistas
 *
 * @author JuvenaL
 */
class Vista extends CI_Controller {

//    public function user() {
//        //COMPROBAR SI LA SESSION ES LA CORRECTA HACIA USER
//        if ($this->session->userdata('user') || $this->session->userdata('admin')) {
//            $this->load->view('menuUser');
//        } else {
//            redirect('control');
//        }
//    }    

    public function cargarSession($value)
    {
         if ($this->session->userdata('admin')) {
            $this->load->view($value);
        } else {
            redirect(base_url());
        }
    }
    
    public function agregarProducto()
    {
        $carga = 'agregarProducto';
        $this->cargarSession($carga);
    }
    
     public function agregarSaldo()
    {
        $carga = 'agregarSaldo';
        $this->cargarSession($carga);
    }
    
    
    public function informeProductos()
    {
        $carga = 'informeProductos';
        $this->cargarSession($carga);        
    }
    
    public function informeUsuarios()
    {
        $carga = 'informeUsuarios';
        $this->cargarSession($carga);
    }
    
    public function informeVentas()
    {
        $carga = 'informeVentas';
        $this->cargarSession($carga);
    }
    
    public function menuCasino()
    {
        if ($this->session->userdata('user')) {
            $this->load->view('menuCasino');
        } else {
            redirect(base_url());
        }
    }
    
    public function listaProductos()
    {
       $carga = 'listaProductos';
        $this->cargarSession($carga); 
    }
    
    public function listaProveedores()
    {
        $carga = 'listaProveedores';
        $this->cargarSession($carga);
    }
    
    public function agregarProveedor()
    {
        $carga = 'agregarProveedor';
        $this->cargarSession($carga);
    }
    
        public function agregarCategoria()
    {
        $carga = 'agregarCategoria';
        $this->cargarSession($carga);
    }
    
    public function listaUsuarios()
    {
        $carga = 'listaUsuarios';
        $this->cargarSession($carga);
    }
    
    public function agregarUsuario() {
       $carga = 'agregarUsuario';
       $this->cargarSession($carga);
    }
    

    public function menuAdmin() {
         $carga = 'menuAdmin';
       $this->cargarSession($carga);
    }

    public function menuUser() {
        if ($this->session->userdata('user')) {
            $this->load->view('menuUser');
        } else {
            redirect(base_url());
        }
    }

}
