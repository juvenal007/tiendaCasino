<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author Familia Salas
 */
class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
        $this->load->helper(array('form', 'url'));
    }

    public function do_upload() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg';
        $config['max_size'] = 5000;
        $config['max_width'] = 2500;
        $config['max_height'] = 1400;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        } else {

            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = "./uploads/" . $file_name;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;
            $config['new_image'] = "./uploads/mini" . $file_name;

            $this->image_lib->initialize($config);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }

            $var = $file_name;
            $new = explode(".jpg", $var);
            $new[0];
            $success = array('success' => "http://localhost/tiendaCasino/uploads/mini" . $new[0] . "_thumb.jpg");

            echo json_encode($success);
        }
    }

    public function addCategoria() {
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $imagenCat = $this->input->post('imagenCat');

        $res = '';

        if (!empty($nombre) && !empty($descripcion)) {
            
            $nombre = strtoupper($nombre);
            $descripcion = strtoupper($descripcion);      
            
            if ($imagenCat == '') {
                $imagenCat = 'http://localhost/tiendaCasino/uploads/default.jpg';
            }
            if ($this->Crud->addCategoria($nombre, $descripcion, $imagenCat)) {
                $res = "Categoria agregada exitosamente!";
            } else {
                $res = "Error de datos";
            }
        } else {
            $res = "Faltan Datos";
        }

        echo json_encode(array('value' => $res));
    }
    
    public function getCategorias()
    {
       echo json_encode($this->Crud->getCategorias());
    }
    
    public function editarCategoria()
    {
        $idcategoria = $this->input->post('idcategoria');
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        
        if (!empty($nombre) && !empty($descripcion)) {
            if ($this->Crud->editarCategoria($idcategoria, $nombre, $descripcion)) {
                $res = 'Categoria editada';
            }
            else
            {
                $res = 'Ninguna fila modificada';
            }
        }
        else
        {
            $res = 'Faltan datos';
        }        
        echo json_encode(array('value' => $res));        
    }
    
    public function eliminarCategoria()
    {
         $idcategoria = $this->input->post('idcategoria');        
         $res = '';        
        if (!empty($idcategoria)) {
            if ($this->Crud->eliminarCategoria($idcategoria)) {
                 $res = "Categoria eliminado exitosamente!";            
            }
            else
            {
                $res = 'Ninguna fila modificada';
            }
        }
        else
        {
            $res = "Faltan Datos";
        }
        echo json_encode(array('value' => $res));
    }

}
