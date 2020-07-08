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
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <div id="contenido">                  

                <?php $this->load->view('template/header'); ?>               

                <div class="page-wrapper">


                    <?php $this->load->view('template/subHeader'); ?>       

                    <div class="container">

                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12"> 
                                <div class="card">
                                    <form class="form-horizontal">
                                        <div class="card-body">
                                            <h4 class="card-title">Información</h4>
                                            <div class="form-group row">
                                                <label for="nombre" class="col-sm-3 text-right control-label col-form-label">Nombre</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" v-model="producto.nombre">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="codigo" class="col-sm-3 text-right control-label col-form-label">Codigo</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="codigo" placeholder="Codigo" v-model="producto.codigo">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="stock" class="col-sm-3 text-right control-label col-form-label">Stock</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="stock" placeholder="Stock" v-model="producto.stock">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="p_compra" class="col-sm-3 text-right control-label col-form-label">Precio Compra</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="p_compra" placeholder="Precio Compra" v-model="producto.p_compra">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="p_venta" class="col-sm-3 text-right control-label col-form-label">Precio Venta</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="p_venta" placeholder="Precio venta" v-model="producto.p_venta">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="descripcion" class="col-sm-3 text-right control-label col-form-label">Descripcion</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" v-model="producto.descripcion">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tipo" class="col-sm-3 text-right control-label col-form-label">Categoria</label>
                                                <div class="col-sm-9">
                                                    <select class="browser-default custom-select" id="tipo" v-model="producto.idcategoria">                                                
                                                        <option value="" disabled="" selected>Seleccione</option>                                                        
                                                        <option v-if='c.estado == "ACTIVO"'v-for="c in listaCategorias" v-bind:value='c.idcategoria'>{{c.nombre}}</option>
                                                    </select>
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <label for="tipo" class="col-sm-3 text-right control-label col-form-label">Proveedor</label>
                                                <div class="col-sm-9">
                                                    <select class="browser-default custom-select" id="tipo" v-model="producto.idproveedor">                                                
                                                        <option value="" disabled="">Seleccione</option>                                                        
                                                        <option v-if='p.estado == "ACTIVO"' v-for="p in listaProveedores" v-bind:value='p.idproveedor'>{{p.nombre}} {{p.apellido_pat}} {{p.apellido_mat}}</option>                                                       
                                                    </select>
                                                </div>
                                            </div> 



                                            <div class="form-group row">
                                                <div class="col-sm-3 text-right">
                                                    <button type="button" class="btn btn-success btn-lg" @click='verFoto()'>Subir</button>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="card-body">
                                                        <form id="upload-form" enctype="multipart/form-data" method="post" accept-charset="utf-8" v-on:submit.prevent="upload">
                                                            <div class="form-group">
                                                                <input type="file" class="form-control-file" id="image" name="image">
                                                            </div>
                                                            <p id="error"></p>
                                                        </form>	                                                        
                                                    </div> 
                                                </div>
                                            </div>

                                            <div class="col-sm-12 text-center">
                                                <img src="https://via.placeholder.com/150x150" alt="Image" class="img-thumbnail rounded mx-auto d-block" id="image-display" > 
                                            </div>
                                        </div>
                                        <div class="border-top">
                                            <div class="card-body text-center">
                                                <button type="button" class="btn btn-success btn-lg" @click='agregarProducto()'>Crear Producto</button>
                                            </div>
                                        </div>


                                        <!-- Modal -->
                                        <div class="modal" id="mensaje" tabindex="-1" role="dialog" aria-labelledby="Productoo creado con exito" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mensaje">Mensaje {{subtitulo}}</h5>
                                                        <a id="mensajeCerrar" class="close">&times;</a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-info" role="alert">
                                                            {{respuesta}}
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </form>                                    

                                </div>

                            </div>

                        </div>
                    </div>
                 

                   <?php $this->load->view('template/footer'); ?>   
                    <!-- ============================================================== -->
                    <!-- End footer -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Page wrapper  -->
                <!-- ============================================================== -->


            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
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
        <!--This page JavaScript -->
        <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
        <!-- Charts js Files -->
        <script src="<?= base_url() ?>assets/libs/flot/excanvas.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.pie.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.time.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.stack.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot/jquery.flot.crosshair.js"></script>
        <script src="<?= base_url() ?>assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script src="<?= base_url() ?>dist/js/pages/chart/chart-page-init.js"></script>
        <script src="<?= base_url() ?>assets/js/axios.min.js"></script>
        <script src="<?= base_url() ?>assets/js/vue.js"></script>
        <script src="<?= base_url() ?>assets/js/agregarProducto.js"></script>

    </body>

</html>

