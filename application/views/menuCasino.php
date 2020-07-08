<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($_SESSION)) {
    redirect(base_url());
}
$admin = $this->session->userdata('user');
if ($admin[0]->tipo != "USUARIO") {
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
        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/icons/font-awesome/css/fontawesome-all.css" rel="stylesheet">
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
        .linea {
            height: 10px;
            background-color: black;
        }
        body {
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
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body bg-dark">
                                    <h3 class="float-left text-white">SALDO: {{cuenta.saldo}} Bienvenido: {{session.nombre}} {{session.apellido_pat}}</h3>
                                    <a  class="btn btn-outline-success float-right" href="<?= base_url('logout'); ?>" >LOGOUT</a>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card">
                                        <h5 class="card-header text-center bg-success text-white">Carro de compra</h5>
                                        <div class="card-body fondoCasi">
                                            <h5 class="card-title">Productos</h5>

                                            <table class="table table-striped table-bordered table-hover table-sm table-responsive-xl">
                                                <thead>
                                                    <tr class='bg-dark text-white'>
                                                        <th>Nombre</th>
                                                        <th>Precio</th>
                                                        <th>Cantidad</th>                                                   
                                                        <th>Total</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody v-if='u.estado == "ACTIVO"' v-for = '(u, index) in carroCompra'>
                                                <td>{{u.nombre}}</td>      
                                                <td>{{u.p_venta}}</td>
                                                <td>{{u.cantidad}}</td>
                                                <td>{{u.total}}</td>    
                                                <td class="text-center"><button class="btn btn-danger btn-circle" data-toggle="modal" @click='eliminarProducto(u)'><a class="sidebar-link"><i class="fa fa-times"></i></a></button></td>

                                                </tbody>  
                                            </table>
                                            <br>
                                            <h4>Total Comprado: {{totalComprado}}</h4>
                                            <button type="button" class="btn btn-info btn-block" @click='modalFinalizarCompra()'>FINALIZAR COMPRA</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">

                                    <div class="card">
                                        <h5 class="card-header text-center bg-success text-white">Productos</h5>
                                        <div class="card-body fondoCasi">
                                            <h5 class="card-title">Categorias</h5> 
                                            <div class="row">
                                                <div v-if='c.estado == "ACTIVO"' v-for='c in listaCategorias' class="col-3">                                         
                                                    <div class="card">
                                                        <img v-bind:src="c.imagenCat" class="img-thumbnail text-center card-img-top" width="150px">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-center">{{c.nombre}}</h5>
                                                            <p class="card-text text-center">{{c.descripcion}}</p>
                                                            <a class="btn btn-info btn-block" @click="modalProductos(c)">{{c.nombre}}</a>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>

                                        </div>
                                    </div>  
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal -->

                    <div  id='modalProductos' class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header text-center bg-success text-white">
                                    <h5 class="modal-tittle">Productos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body fondoProducto">
                                    <div class="row">
                                        <div v-if='(p.estado == "ACTIVO") && (p.stock > 0)' v-for='p in listaProductos' class="col-3">                                         
                                            <div class="card">
                                                <img v-bind:src="p.imagen" class="img-thumbnail text-center card-img-top" width="150px">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">$ {{p.p_venta}}</h5>
                                                    <p class="card-text text-center">{{p.nombre}}</p>
                                                    <a class="btn btn-info btn-block" @click="modalCantidad(p)">Agregar</a>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>

                                    <!-- Modal CANTIDAD -->
                                    <div class="modal fade" id="modalCantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header  bg-success text-white">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle" >Cantidad</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body fondoCasi">
                                                    <div class="form-group row">
                                                        <label for="cantidad" class="col-sm-3 text-right control-label col-form-label">Cantidad</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" id="cantidad" placeholder="Cantidad" v-model="cantidad">
                                                        </div>
<!--                                                        <pre>{{$data}}</pre>  -->
                                                    </div>
                                                </div>                                              
                                                <div class="modal-footer fondoCasi">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-primary" @click='comprarProducto(cantidad)'>Agregar al Carro</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
<!--                                    <pre>{{$data}}</pre>  -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <!-- Modal EditarProveedor-->
                            <div class="modal fade" id="modalFinalizarCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Finalizar Compra</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                           ¿Esta seguro que desea finalizar compra?
                                           Total: {{totalComprado}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" @click='finCompra()'>TERMINAR COMPRA</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    <!-- Modal -->
                    <div class="modal" id="mensaje" tabindex="-1" role="dialog" aria-labelledby="Proveedor editado con exito" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mensaje">Mensaje</h5>
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



<!--                    <pre>{{$data}}</pre>   -->
                </div>
            </div>

            <script src="<?= base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
            <script src="<?= base_url() ?>assets/js/axios.min.js"></script>
            <script src="<?= base_url() ?>assets/js/vue.js"></script>
            <script src="<?= base_url() ?>assets/js/menuCasino.js"></script>

    </body>

</html>