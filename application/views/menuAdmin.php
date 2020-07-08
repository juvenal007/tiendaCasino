<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($_SESSION)) {
    redirect(base_url());
}
$admin = $this->session->userdata('admin');
if ($admin[0]->tipo != "ADMINISTRADOR") {
    redirect(base_url());
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/favicon.png">
        <title>Matrix Template - The Ultimate Multipurpose admin template</title>
        <!-- Custom CSS -->
        <link href="<?= base_url() ?>assets/libs/flot/css/float-chart.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= base_url() ?>dist/css/style.min.css" rel="stylesheet">
    </head>
    <style>
         .fondo {
            background: url(<?= base_url() ?>assets/images/diagmonds.png) center center fixed;
            background-color: #00ccff;          
        }
        .fondoProducto {
            background: url(<?= base_url() ?>assets/images/textura1.png) center center fixed;
            background-color: #334049;          
        }
        .fondoCasi {
            background-color: #e4ebf0;   
        }
    </style>
    <body>

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
     
        <div id="main-wrapper">
            <div id="contenido">                  

                <?php $this->load->view('template/header'); ?>   


                <div class="page-wrapper">
                  
                    <div class="page-breadcrumb">
                        <div class="row">
                            <div class="col-12 d-flex no-block align-items-center">
                                <h4 class="page-title">INFORMACION PRINCIPAL</h4>
                                <div class="ml-auto text-right">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="container-fluid">
                      
                        <div class="row">
                            <!-- Column -->
                            <div class="col-md-6 col-lg-2 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-cyan text-center">
                                        <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                        <h5 class="m-b-0 m-t-5 font-light text-white">{{contarUsuarios}}</h5>
                                        <h6 class="text-white">Usuarios</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-2 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-success text-center">
                                        <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                        <h5 class="m-b-0 m-t-5 font-light text-white">{{contarProductos}}</h5>
                                        <h6 class="text-white">Productos</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-2 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-danger text-center">
                                        <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                        <h5 class="m-b-0 m-t-5 font-light text-white">{{contarCategorias}}</h5>
                                        <h6 class="text-white">Categorias</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-2 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-warning text-center">
                                        <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                        <h5 class="m-b-0 m-t-5 font-light text-white">{{contarVentas}}</h5>
                                        <h6 class="text-white">Ventas</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-2 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-danger text-center">
                                        <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                        <h5 class="m-b-0 m-t-5 font-light text-white">{{contarProveedores}}</h5>
                                        <h6 class="text-white">Proveedores</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-2 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-info text-center">
                                        <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                        <h5 class="m-b-0 m-t-5 font-light text-white">{{cantidadProdComprados}}</h5>
                                        <h6 class="text-white">Total Ventas</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->

                        </div>
     
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12"> 

                                <!-- card new -->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title m-b-0">Noticias</h4>
                                    </div>
                                    <ul class="list-style-none">
                                        <li class="d-flex no-block card-body">
                                            <i class="fa fa-check-circle w-30px m-t-5"></i>
                                            <div>
                                                <a href="#" class="m-b-0 font-medium p-0">RapidEats el nuevo sistema para tu casino!</a>
                                                <span class="text-muted">Rapido, facil de usar.</span>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="tetx-right">
                                                    <h5 class="text-muted m-b-0">20</h5>
                                                    <span class="text-muted font-16">Jun</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        
                        </div>
                    </div>                        
                </div>

            </div>
        </div>
        <?php $this->load->view('template/footer'); ?>   

        <script src="<?= base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="<?= base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/extra-libs/sparkline/sparkline.js"></script>
        <!--Wave Effects -->
        <script src="<?= base_url() ?>dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="<?= base_url() ?>dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="<?= base_url() ?>dist/js/custom.min.js"></script>
 
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.pie.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.time.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.stack.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.crosshair.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script src="<?= base_url() ?>dist/js/pages/chart/chart-page-init.js"></script>
        <script src="<?= base_url() ?>assets/js/axios.min.js"></script>
        <script src="<?= base_url() ?>assets/js/vue.js"></script>
        <script src="<?= base_url() ?>assets/js/menuAdmin.js"></script>

    </body>

</html>


