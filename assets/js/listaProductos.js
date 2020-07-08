var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Agregar Producto',
        subtitulo: 'Producto',
        path: 'http://localhost/tiendaCasino/',
        NUM_RESULTS: 10,
        pag: 1,
        producto: {
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
        listaProveedores: [],
        listaProductos: [],
        prod: {}
    },
    methods: {
        agregarProducto: function () {
            var url = this.path + 'addProducto';
            param = new FormData();
            param.append('nombre', this.producto.nombre);
            param.append('codigo', this.producto.codigo);
            param.append('stock', this.producto.stock);
            param.append('p_compra', this.producto.p_compra);
            param.append('p_venta', this.producto.p_venta);
            param.append('descripcion', this.producto.descripcion);
            param.append('imagen', this.producto.imagen);
            param.append('idcategoria', this.producto.idcategoria);
            param.append('idproveedor', this.producto.idproveedor);
            axios.post(url, param).then(res => {
                console.log(res.data.value);
                this.respuesta = res.data.value;
                $(document).ready(function () {
                    $('#mensaje').show('fade');
                    setTimeout(function () {
                        $('#mensaje').hide('fade');
                    }, 3000);
                });
                this.limpiarCampos();
            }).catch(e => {
                console.log(e);
            });

        },
        getSession: function ()
        {
            var url = this.path + 'getSession';
            axios.post(url).then(res => {
                console.log(res);
                this.session = res.data[0];
            }).catch(e => {
                console.log(e);
            });
        },

        editarProducto: function (p)
        {
            var producto = p;
            $('#editarProductoModal').modal('show');
            this.modalEditarProducto.idproducto = producto.idproducto;
            this.modalEditarProducto.nombre = producto.productoNombre;
            this.modalEditarProducto.codigo = producto.codigo;
            this.modalEditarProducto.stock = producto.stock;
            this.modalEditarProducto.p_compra = producto.p_compra;
            this.modalEditarProducto.p_venta = producto.p_venta;
            this.modalEditarProducto.descripcion = producto.productoDescripcion;

        },
        botonModalEditar: function ()
        {
            $('#editarProductoModal').modal('hide');
            var url = this.path + 'editProducto';
            param = new FormData();
            param.append('idproducto', this.modalEditarProducto.idproducto);
            param.append('nombre', this.modalEditarProducto.nombre);
            param.append('codigo', this.modalEditarProducto.codigo);
            param.append('stock', this.modalEditarProducto.stock);
            param.append('p_compra', this.modalEditarProducto.p_compra);
            param.append('p_venta', this.modalEditarProducto.p_venta);
            param.append('descripcion', this.modalEditarProducto.descripcion);

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
        }
    },
    created: function () {
        this.getSession();
        this.getProductos();
    },
    mounted: function () {
        $(document).ready(function () {
            $('#mensajeCerrar').click(function () {
                $('#mensaje').hide('fade');
            });
            
             jQuery('#codigo').keypress(function (tecla) {
                if (tecla.charCode < 48 || tecla.charCode > 57)
                    return false;
            });
            
             jQuery('#stock').keypress(function (tecla) {
                if (tecla.charCode < 48 || tecla.charCode > 57)
                    return false;
            });

            jQuery('#p_compra').keypress(function (tecla) {
                if (tecla.charCode < 48 || tecla.charCode > 57)
                    return false;
            });

            jQuery('#p_venta').keypress(function (tecla) {
                if (tecla.charCode < 48 || tecla.charCode > 57)
                    return false;
            });
            
            
            
        });
    }
});


