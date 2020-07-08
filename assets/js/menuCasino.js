var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Agregar Producto',
        subtitulo: 'Producto',
        path: 'http://localhost/tiendaCasino/',
        cantidad: '',
        cuenta: [],
        producto: {
            idproducto: '',
            nombre: '',
            codigo: '',
            stock: '',
            p_compra: '',
            p_venta: '',
            descripcion: '',
            imagen: '',
            idcategoria: '',
            idproveedor: ''
        },
        session: [],
        form_data: '',
        respuesta: '',
        file_data: {},
        modalEditarProducto: {
            idproducto: '',
            nombre: '',
            codigo: '',
            stock: '',
            p_compra: '',
            p_venta: '',
            descripcion: '',
            imagen: '',
            idcategoria: '',
            idproveedor: ''
        },
        listaCategorias: [],
        listaProductos: [],
        carroCompra: [],
        idcuenta: '',
        totalComprado: 0

    },
    methods: {

        getSession: function ()
        {
            var url = this.path + 'getSession';
            axios.post(url).then(res => {
                console.log(res);
                this.session = res.data[0];
                console.log("CUENTA: " + res.data[0].cuenta_idcuenta);

                var url = this.path + 'getCuenta';
                var param = new FormData();
                param.append('idcuenta', res.data[0].cuenta_idcuenta);
                axios.post(url, param).then(res => {

                    console.log(res.data.value[0]);
                    this.cuenta = res.data.value[0];
                }).catch(e => {
                    console.log(e);
                });


            }).catch(e => {
                console.log(e);
            });
        },

        getProductos: function ()
        {
            var url = this.path + 'getProductos';
            axios.post(url).then(res => {
                console.log(res);
                this.listaProductos = res.data;
            }).catch(e => {
                console.log(e);
            });
        },
        modalEliminarProductos: function (p)
        {
            var producto = p;
            $('#eliminarProductoModal').modal('show');
            this.modalEditarProducto.idproducto = producto.idproducto;
            this.modalEditarProducto.nombre = producto.productoNombre;
            this.modalEditarProducto.codigo = producto.codigo;
            this.modalEditarProducto.stock = producto.stock;
            this.modalEditarProducto.p_compra = producto.p_compra;
            this.modalEditarProducto.p_venta = producto.p_venta;
            this.modalEditarProducto.descripcion = producto.productoDescripcion;
        },

        eliminarProducto: function ()
        {
            $('#eliminarProductoModal').modal('hide')
            var url = this.path + 'eliminarProducto';
            param = new FormData();
            param.append('idproducto', this.modalEditarProducto.idproducto);
            axios.post(url, param).then(res => {
                console.log(res.data.value);
                this.respuesta = res.data.value;
                $(document).ready(function () {
                    $('#mensaje').show('fade');
                    setTimeout(function () {
                        $('#mensaje').hide('fade');
                    }, 3000);
                });
                this.getProductos();
            }).catch(e => {
                console.log(e);
            });
        },

        getCategorias: function ()
        {
            var url = this.path + 'listaCat';
            param = new FormData();
            axios.post(url).then(res => {
                this.listaCategorias = res.data;
                console.log(res.data);
            }).catch(e => {
                console.log(e);
            });
        },

        modalProductos: function (c)
        {
            $('#modalProductos').modal('show');
            var categoria = c;
            var url = this.path + 'listaProdCat';
            param = new FormData();
            param.append('idcategoria', categoria.idcategoria);
            axios.post(url, param).then(res => {
                this.listaProductos = res.data;
                console.log(res.data);
            }).catch(e => {
                console.log(e);
            });
        },

        eliminarProducto: function (p)
        {
            var producto = p;

            for (var i = 0; i < this.carroCompra.length; i++) {
                if (this.carroCompra[i].idproducto == producto.idproducto) {
                    this.carroCompra.splice(i, 1);
                }
            }

            var total = 0;
            for (var i = 0; i < this.carroCompra.length; i++) {
                total += this.carroCompra[i].total;
            }

            this.totalComprado = total;

        },

        comprarProducto: function (cantidad)
        {
            var prodModal = this.producto;
            var validacion = prodModal.stock - cantidad;
            if (cantidad.length <= 0) {
                this.respuesta = 'Ingrese Cantidad';
                $(document).ready(function () {
                    $('#mensaje').show('fade');
                    setTimeout(function () {
                        $('#mensaje').hide('fade');
                    }, 3000);
                });
            } else
            {
                if (validacion < 0) {
                    this.respuesta = 'Stock menor a cantidad ingresada';
                    $(document).ready(function () {
                        $('#mensaje').show('fade');
                        setTimeout(function () {
                            $('#mensaje').hide('fade');
                        }, 3000);
                    });
                    this.cantidad = '';
                } else {

                    for (var i = 0; i < this.carroCompra.length; i++) {
                        if (this.carroCompra[i].idproducto == prodModal.idproducto) {
                            this.carroCompra.splice(i, 1);
                        }
                    }
                    prodModal.cantidad = this.cantidad;

                    if (((this.cantidad * prodModal.p_venta) + this.totalComprado) > this.cuenta.saldo) {
                        this.respuesta = 'Saldo insuficiente';
                        $(document).ready(function () {
                            $('#mensaje').show('fade');
                            setTimeout(function () {
                                $('#mensaje').hide('fade');
                            }, 3000);
                        });
                        this.cantidad = '';
                        if (this.carroCompra.length < 1) {
                            this.totalComprado = 0;
                        }
                    } else {
                        prodModal.total = (this.cantidad * prodModal.p_venta);
                        this.carroCompra.push(prodModal);
                        this.cantidad = '';

                        var totalComprado = 0;

                        for (var i = 0; i < this.carroCompra.length; i++) {
                            totalComprado += this.carroCompra[i].total;
                        }
                        this.totalComprado = totalComprado;

                        $('#modalCantidad').modal('hide');
                        $('#modalProductos').modal('hide');
                    }
                }
            }

        },

        modalFinalizarCompra: function ()
        {
            if (this.totalComprado == 0) {
                this.respuesta = 'Ningun producto comprado';
                $(document).ready(function () {
                    $('#mensaje').show('fade');
                    setTimeout(function () {
                        $('#mensaje').hide('fade');
                    }, 3000);
                });
            } else
            {
                $('#modalFinalizarCompra').modal('show');
            }

        },

        finCompra: function ()
        {

            let cadena = '';

            for (var i = 0; i < this.carroCompra.length; i++) {
                cadena += this.carroCompra[i].idproducto + '-';
            }

            console.log(cadena);
            let divisor = cadena.split('-');
            for (var i = 0; i < divisor.length; i++) {
                console.log(divisor[i]);
            }
            divisor.pop();
            console.log(divisor);

            let cadena2 = '';

            for (var i = 0; i < this.carroCompra.length; i++) {
                cadena2 += this.carroCompra[i].cantidad + '-';
            }
            console.log(cadena2);
            let divisor2 = cadena2.split('-');
            for (var i = 0; i < divisor2.length; i++) {
                console.log(divisor2[i]);
            }
            divisor2.pop();
            console.log(divisor2);

            let cadena3 = '';

            for (var i = 0; i < this.carroCompra.length; i++) {
                cadena3 += this.carroCompra[i].p_venta + '-';
            }
            console.log(cadena3);
            let divisor3 = cadena3.split('-');
            for (var i = 0; i < divisor3.length; i++) {
                console.log(divisor3[i]);
            }
            divisor3.pop();
            console.log(divisor3);

            var totalU = 0;

            for (var i = 0; i < this.carroCompra.length; i++) {
                totalU += parseInt(this.carroCompra[i].cantidad, 10);
            }

            console.log(totalU);

            let cadena4 = '';

            for (var i = 0; i < this.carroCompra.length; i++) {
                cadena4 += this.carroCompra[i].total + '-';
            }
            console.log(cadena4);
            let divisor4 = cadena4.split('-');
            for (var i = 0; i < divisor4.length; i++) {
                console.log(divisor4[i]);
            }
            divisor4.pop();
            console.log(divisor4);

//            var totalCompra = 0;
//            
//            for (var i = 0; i < this.carroCompra.length; i++) {
//                totalCompra += parseInt(this.carroCompra[i].total, 10);
//            }

            $('#modalFinalizarCompra').modal('hide');
            var url = this.path + 'finCompra';
            var param = new FormData();
            param.append('total', this.totalComprado);
            param.append('totalU', totalU);
            param.append('idusuario', this.session.idusuario);
            console.log(this.session.idusuario);
            param.append('productosAgregados', cadena);
            param.append('cantidad', cadena2);
            param.append('precio', cadena3);
            param.append('totalCompra', cadena4);
            param.append('idcuenta', this.cuenta.idcuenta);

            axios.post(url, param).then(res => {
                console.log(res.data);
                this.respuesta = 'COMPRA FINALIZADA SALDRAS DEL SISTEMA EN 3 SEGUNDOS';
                $(document).ready(function () {
                    $('#mensaje').show('fade');
                    setTimeout(function () {
                        $('#mensaje').hide('fade');
                        window.location.href = 'http://localhost/tiendaCasino/';

                    }, 3000);
                });
                this.getSession();
            }).catch(e => {
                console.log(e);
            });

        },

        modalCantidad: function (p)
        {
            this.producto = p;
            $('#modalCantidad').modal('show');

        }


    },
    created: function () {
        this.getSession();
        this.getCategorias();

    },
    mounted: function () {
        $(document).ready(function () {
            $('#mensajeCerrar').click(function () {
                $('#mensaje').hide('fade');
            });
        });
    }
});





