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
                                                <label for="rut" class="col-sm-3 text-right control-label col-form-label">Rut</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="rut" placeholder="Rut" v-model="usuario.rut">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nombre" class="col-sm-3 text-right control-label col-form-label">Nombre</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" v-model="usuario.nombre">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="apellido_pat" class="col-sm-3 text-right control-label col-form-label">Apellido Paterno</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="apellido_pat" placeholder="Apellido Pat" v-model="usuario.apellido_pat">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="apellido_mat" class="col-sm-3 text-right control-label col-form-label">Apellido Materno</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="apellido_mat" placeholder="Apellido Mat" v-model="usuario.apellido_mat">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="telefono" class="col-sm-3 text-right control-label col-form-label">Telefono</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="telefono" placeholder="Telefono" v-model="usuario.telefono">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="institucion" class="col-sm-3 text-right control-label col-form-label">Institucion</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="institucion" placeholder="Institucion" v-model="usuario.institucion">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="direccion" class="col-sm-3 text-right control-label col-form-label">Dirección</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="direccion" placeholder="Dirección" v-model="usuario.direccion">
                                                </div>
                                            </div>    
                                            <div class="form-group row">
                                                <label for="password" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" autocomplete="new-Password"  class="form-control" id="password" placeholder="Ingrese password" v-model="usuario.password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="ciudad" class="col-sm-3 text-right control-label col-form-label">Ciudad</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="ciudad" placeholder="Dirección" v-model="usuario.ciudad">
                                                </div>
                                            </div> 
                                            <div class="form-group row">
                                                <label for="tipo" class="col-sm-3 text-right control-label col-form-label">Tipo</label>
                                                <div class="col-sm-9">
                                                    <select class="browser-default custom-select" id="tipo" v-model="usuario.tipo">                                                
                                                        <option value="USUARIO">USUARIO</option>
                                                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                                    </select>
                                                </div>
                                            </div> 


                                        </div>
                                        <div class="border-top">
                                            <div class="card-body text-center">
                                                <button type="button" class="btn btn-success btn-lg" @click='agregarUsuario()'>Crear usuario</button>
                                            </div>
                                        </div>


                                        <!-- Modal -->
                                        <div class="modal" id="mensaje" tabindex="-1" role="dialog" aria-labelledby="Usuario creado con exito" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mensaje">Mensaje Usuario</h5>
                                                        <a id="mensajeCerrar" class="close">&times;</a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-success" role="alert">
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
<!--                    <pre>{{$data}}</pre>-->
           
                       <?php $this->load->view('template/footer'); ?>   
                </div>
               


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
        <script src="<?= base_url() ?>assets/js/agregarUsuario.js"></script>

    </body>

</html>


