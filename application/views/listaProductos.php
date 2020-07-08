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
                                        <h5 class="card-title">Lista Productos</h5>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr class='bg-dark text-white'>
                                                        <th>Nombre</th>
                                                        <th>Codigo</th>
                                                        <th>Stock </th>                                                   
                                                        <th>P compra</th>
                                                        <th>P venta</th>
                                                        <th>Fecha</th>                                                        
                                                        <th>Descripcion</th>
                                                        <th>Imagen</th>
                                                        <th>Categoria</th>
                                                        <th>Proveedor</th>
                                                        <th>Editar</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody v-if='u.productoEstado == "ACTIVO"' v-for = '(u, index) in listaProductos' v-show="(pag - 1) * NUM_RESULTS <= index && pag * NUM_RESULTS > index">
                                                <td>{{u.productoNombre}}</td>                                              
                                                <td>{{u.codigo}}</td>
                                                <td>{{u.stock}}</td>
                                                <td>{{u.p_compra}}</td>
                                                <td>{{u.p_venta}}</td>
                                                <td>{{u.fecha}}</td>
                                                <td>{{u.productoDescripcion}}</td>
                                                <td class="text-center"><img v-bind:src="u.imagen" width="100"></td>
                                                <td>{{u.categoriaNombre}}</td>
                                                <td>{{u.proveedorNombre}} {{u.proveedorApellido_pat}}</td>                                               
                                                
                                                <td class="text-center"><button class="btn btn-success btn-circle" data-toggle="modal" @click='editarProducto(u)'><a class="sidebar-link"><i class="fas fa-edit"></i></a></button></td>
                                                <td class="text-center"><button class="btn btn-danger btn-circle" data-toggle="modal" @click='modalEliminarProductos(u)'><a class="sidebar-link"><i class="fas fa-times"></i></a></button></td>
                                                
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
                                                            <div v-if="pag * NUM_RESULTS / listaProductos.length < 1">
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

                            <!-- Modal -->
                            <div class="modal" id="mensaje" tabindex="-1" role="dialog" aria-labelledby="Proveedor editado con exito" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mensaje">Mensaje Categoria</h5>
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


                          

                            <!-- Modal EditarProveedor-->
                           <div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar {{subtitulo}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                             <div class="form-group row">
                                                <label for="nombre" class="col-sm-3 text-right control-label col-form-label">Nombre</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" v-model="modalEditarProducto.nombre">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="codigo" class="col-sm-3 text-right control-label col-form-label">Codigo</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="codigo" placeholder="Codigo" v-model="modalEditarProducto.codigo">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="stock" class="col-sm-3 text-right control-label col-form-label">Stock</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="stock" placeholder="Stock" v-model="modalEditarProducto.stock">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="p_compra" class="col-sm-3 text-right control-label col-form-label">Precio Compra</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="p_compra" placeholder="Precio Compra" v-model="modalEditarProducto.p_compra">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="p_venta" class="col-sm-3 text-right control-label col-form-label">Precio Venta</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="p_venta" placeholder="Precio venta" v-model="modalEditarProducto.p_venta">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="descripcion" class="col-sm-3 text-right control-label col-form-label">Descripcion</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" v-model="modalEditarProducto.descripcion">
                                                </div>
                                            </div>
                                            
                                            
                                            
                                           
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary" @click='botonModalEditar()'>Guardar cambios</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal EditarProveedor-->
                            <div class="modal fade" id="eliminarProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Mensaje {{subtitulo}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Esta seguro que desea eliminar {{subtitulo}}: {{modalEditarProducto.nombre}} 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" @click='eliminarProducto()'>Eliminar</button>
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
        <script src="<?= base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/extra-libs/sparkline/sparkline.js"></script>
        <script src="<?= base_url() ?>dist/js/waves.js"></script>
        <script src="<?= base_url() ?>dist/js/sidebarmenu.js"></script>
        <script src="<?= base_url() ?>dist/js/custom.min.js"></script>        
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
        <script src="<?= base_url() ?>assets/js/listaProductos.js"></script>

    </body>

</html>