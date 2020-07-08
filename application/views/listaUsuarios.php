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
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <?php $this->load->view('template/subHeader'); ?>      


                    <div class="container">                       
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">  
                                <div class="card">                                   
                                    <div class="card-body">
                                        <h5 class="card-title">Usuarios</h5>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr class='bg-dark text-white'>
                                                        <th>Rut</th>
                                                        <th>Nombre</th>
                                                        <th>Apellido P</th>
                                                        <th>Apellido M</th>
                                                        <th>Telefono</th>
                                                        <th>Institucion</th>
                                                        <th>N° Cuenta</th>                                                        

                                                    </tr>
                                                </thead>
                                                <tbody v-for = '(u, index) in listaUsuarios' v-show="(pag - 1) * NUM_RESULTS <= index && pag * NUM_RESULTS > index">
                                                <td>{{u.rut}}</td>
                                                <td>{{u.nombre}}</td>
                                                <td>{{u.apellido_pat}}</td>
                                                <td>{{u.apellido_mat}}</td>
                                                <td>{{u.telefono}}</td>
                                                <td>{{u.institucion}}</td>                                               
                                                <td>{{u.ncuenta}}</td>      
                                                <nav aria-label="Page navigation" class="text-center">
                                                    <ul class="pagination text-center">
                                                        <li class="page-item">
                                                            <div v-if="pag != 1">
                                                                <a class="page-link" href="#" aria-label="Previous" @click.prevent="pag -= 1">
                                                                    <span aria-hidden="true">Anterior</span>
                                                                </a> 
                                                            </div>
                                                            <div v-else>
                                                                <a class="page-link" href="#" aria-label="Previous">
                                                                    <span aria-hidden="true">Anterior</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li class="page-item">
                                                            <div v-if="pag * NUM_RESULTS / listaUsuarios.length < 1">
                                                                <a class="page-link" href="#" aria-label="Next" @click.prevent="pag += 1">
                                                                <span aria-hidden="true">Siguiente</span>
                                                            </a>                                                                
                                                            </div>
                                                            <div v-else>
                                                                <a class="page-link" href="#" aria-label="Next">
                                                                <span aria-hidden="true">Siguiente</span>
                                                            </a>
                                                            </div>
                                                            
                                                        </li>
                                                    </ul>
                                                </nav>
                                                </tbody>  
                                            </table>


                                        </div>

                                    </div>
                                </div>





                                <!-- Modal -->
                                <div class="modal" id="mensaje" tabindex="-1" role="dialog" aria-labelledby="Usuario creado con exito" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mensaje">USUARIO CREADO CON EXITO</h5>
                                                <a id="mensajeCerrar" class="close">&times;</a>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-success" role="alert">
                                                    Nuevo usuario agregado por {{session.nombre}}
                                                </div>
                                            </div>                                                    
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- column -->


                            <!-- ============================================================== -->
                            <!-- Recent comment and chats -->
                            <!-- ============================================================== -->
                        </div>
                    </div>
<!--                    <pre>{{$data}}</pre>-->
                    <!-- ============================================================== -->
                    <!-- End Container fluid  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- footer -->
                    <!-- ============================================================== -->
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
        <script src="<?= base_url() ?>assets/js/listaUsuarios.js"></script>

    </body>

</html>


