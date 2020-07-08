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
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/libs/jquery-minicolors/jquery.minicolors.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <link href="<?= base_url() ?>assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= base_url() ?>dist/css/style.min.css" rel="stylesheet">
    </head>
    <style>
        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 24px;
            line-height: 1.33;
        }
        .btn-circle.btn-lg {
            width: 50px;
            height: 50px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 25px;
        }
        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
        }
        
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


                            <div class="col-lg-12">  
                                <div class="card">                                   
                                    <div class="card-body">
                                        <h4 class="card-title">Cuentas</h4>
                                        <h5 class="card-title">Informe de cuentas de usuarios</h5>
                                        
                                        <div v-show='info'>     
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <label>Buscar cuenta</label>

                                                    <div class="form-group row">
                                                        <label for="cuenta" class="col-sm-3 text-right control-label col-form-label">Cuenta</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" id="cuenta" placeholder="N°" v-model="cuenta">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <br>

                                            <button class="btn btn-outline-success btn-block" @click="getCuenta()">Buscar</button>
                                            <br>

                                            <h5 class="card-title">Datos de cuenta y usuario.</h5>

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-sm">
                                                    <thead>
                                                        <tr class='bg-dark text-white'>
                                                            <th>Rut</th>
                                                            <th>Nombre</th>
                                                            <th>Apellidos</th>
                                                            <th>Ciudad</th>                                                   
                                                            <th>Dirección</th>
                                                            <th>Fecha</th>
                                                            <th>Institución</th>
                                                            <th>Telefono</th>                                                       
                                                            <th>N° Cuenta</th>
                                                            <th>Saldo</th>                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody v-for = '(u, index) in listaCuentas' v-show="(pag - 1) * NUM_RESULTS <= index && pag * NUM_RESULTS > index">
                                                    <td class="font-weight-bold">{{u.rut}}</td>
                                                    <td class="font-weight-bold">{{u.nombre}}</td>
                                                    <td>{{u.apellido_pat}} {{u.apellido_mat}}</td>  
                                                    <td>{{u.ciudad}}</td>
                                                    <td>{{u.direccion}}</td>
                                                    <td>{{u.fecha}}</td>
                                                    <td>{{u.institucion}}</td>  
                                                    <td>{{u.telefono}}</td>
                                                    <td>{{u.ncuenta}}</td>
                                                    <td>{{u.saldo}}</td>         
                                                    </tbody>  
                                                </table>
                                            </div>
                                            <br>
                                            <h5 class="card-title">Datos de compras</h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-sm">
                                                    <thead>
                                                        <tr class='bg-dark text-white'>
                                                            <th>ID Compra</th>
                                                            <th>Nombre</th>
                                                            <th>Fecha</th>
                                                            <th>Estado</th>                                                   
                                                            <th>Cantidad U</th>
                                                            <th>Cantidad P</th>
                                                            <th>Total</th>
                                                            <th>Detalle</th>                                      
                                                        </tr>
                                                    </thead>
                                                    <tbody v-for = '(u, index) in listaCompras' v-show="(pag - 1) * NUM_RESULTS <= index && pag * NUM_RESULTS > index">
                                                    <td class="font-weight-bold">{{u.idcompra}}</td>
                                                    <td class="font-weight-bold">{{u.nombre}}</td>
                                                    <td>{{u.fecha}}</td>  
                                                    <td>{{u.estado}}</td>
                                                    <td>{{u.cantidad_u}}</td>
                                                    <td>{{u.cantidad_p}}</td>
                                                    <td>{{u.total}}</td>                                                                                               
                                                    <td class="text-center"><button class="btn btn-success btn-circle" data-toggle="modal" @click='modalDetalle(u)'><a class="sidebar-link"><i class="fas fa-edit"></i></a></button></td>
                                                    <nav aria-label="Page navigation" class="text-center">
                                                        <ul class="pagination text-center">
                                                            <li class="page-item">
                                                                <div v-if="pag != 1">
                                                                    <a class="page-link"  aria-label="Previous" @click.prevent="pag -= 1">
                                                                        <span aria-hidden="true">Anterior</span>
                                                                    </a> 
                                                                </div>
                                                                <div v-else>
                                                                    <a class="page-link"  aria-label="Previous">
                                                                        <span aria-hidden="true">Anterior</span>
                                                                    </a>
                                                                </div>
                                                            </li>
                                                            <li class="page-item">
                                                                <div v-if="pag * NUM_RESULTS / listaCompras.length < 1">
                                                                    <a class="page-link"aria-label="Next" @click.prevent="pag += 1">
                                                                        <span aria-hidden="true">Siguiente</span>
                                                                    </a>                                                                
                                                                </div>
                                                                <div v-else>
                                                                    <a class="page-link"  aria-label="Next">
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

                                        
                                        <div v-show='info'>
                                            <h5 class="card-title">Detalle de compras</h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-sm">
                                                    <thead>
                                                        <tr class='bg-dark text-white'>
                                                            <th>Id Detalle</th>
                                                            <th>Nombre</th>
                                                            <th>Descripcion</th>
                                                            <th>Fecha</th>
                                                            <th>Cantidad</th>                                                   
                                                            <th>Precio</th>
                                                            <th>Total</th>
                                                            <th>ID compra</th>
                                                            <th>ID producto</th>                                      
                                                        </tr>
                                                    </thead>
                                                    <tbody v-for = '(u, index) in listaDetalle' v-show="(pag - 1) * NUM_RESULTS <= index && pag * NUM_RESULTS > index">
                                                    <td class="font-weight-bold">{{u.idcompra_detalle}}</td>
                                                    <td class="font-weight-bold">{{u.nombreProducto}}</td>
                                                    <td>{{u.descripcion}}</td>  
                                                    <td>{{u.fecha}}</td>
                                                    <td>{{u.cantidadProducto}}</td>
                                                    <td>$ {{u.precio}}</td>
                                                    <td>$ {{u.totalCompra}}</td>
                                                    <td>{{u.compra_idcompra}}</td>
                                                    <td>{{u.producto_idproducto}}</td>
                                                    
                                                    <nav aria-label="Page navigation" class="text-center">
                                                        <ul class="pagination text-center">
                                                            <li class="page-item">
                                                                <div v-if="pag != 1">
                                                                    <a class="page-link"  aria-label="Previous" @click.prevent="pag -= 1">
                                                                        <span aria-hidden="true">Anterior</span>
                                                                    </a> 
                                                                </div>
                                                                <div v-else>
                                                                    <a class="page-link"  aria-label="Previous">
                                                                        <span aria-hidden="true">Anterior</span>
                                                                    </a>
                                                                </div>
                                                            </li>
                                                            <li class="page-item">
                                                                <div v-if="pag * NUM_RESULTS / listaDetalle.length < 1">
                                                                    <a class="page-link"aria-label="Next" @click.prevent="pag += 1">
                                                                        <span aria-hidden="true">Siguiente</span>
                                                                    </a>                                                                
                                                                </div>
                                                                <div v-else>
                                                                    <a class="page-link"  aria-label="Next">
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
                                </div>    
                            </div>

                            <!-- Modal -->
                            <div class="modal" id="mensaje" tabindex="-1" role="dialog" aria-labelledby="Usuario creado con exito" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mensaje">Mensaje Categoria</h5>
                                            <a id="mensajeCerrar" class="close">&times;</a>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-info" role="alert">



                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                            </div>


                         

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


        <script src="<?= base_url() ?>assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
        <script src="<?= base_url() ?>assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/toastr/build/toastr.min.js"></script>

        <script src="<?= base_url() ?>assets/js/axios.min.js"></script>
        <script src="<?= base_url() ?>assets/js/vue.js"></script>
        <script src="<?= base_url() ?>assets/js/informeUsuarios.js"></script>
        
    </body>

</html>