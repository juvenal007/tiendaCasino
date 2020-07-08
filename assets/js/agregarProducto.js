var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Agregar Producto',
        subtitulo: 'Producto',
        path: 'http://localhost/tiendaCasino/',
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
            idcategoria: '',
            nombre: '',
            descripcion: ''
        },
        listaCategorias: [],
        listaProveedores: []
    },
    methods: {

        verFoto: function ()
        {
            this.file_data = $('#image').prop('files')[0];
            this.form_data = new FormData();
            this.form_data.append('file', this.file_data);
            var url = this.path + "subirFoto";

            axios.post(url, this.form_data).then(res => {
                console.log(res);
                if (res.data.success) {
                    $('#error').addClass("text-success");
                    $('#error').show('fade');
                    $('#error').html("Imagen cargada en el sistema correctamente");
                    $('#image-display').attr('src', res.data.success);
                    this.producto.imagen = res.data.success;
                }
                if (res.data.error) {
                    $('#error').addClass("text-danger");
                    $('#error').html(res.data.error);
                }
            }).catch(e => {
                console.log(e);
            });
        },

        limpiarCampos: function ()
        {
            this.producto.nombre = '';
            this.producto.codigo = '';
            this.producto.stock = '';
            this.producto.p_compra = '';
            this.producto.p_venta = '';
            this.producto.descripcion = '';
            this.producto.idcategoria = '';
            this.producto.idproveedor = '';

            $('#image-display').attr('src', 'https://via.placeholder.com/150x150');
            $('#error').html("");
        },

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
        modalProductos: function ()
        {

            $('#mostrarProductos').modal('show');


        },
        editarCat: function (u)
        {
            var categoria = u;
            $('#editarCat').modal('show');
            this.modalEditarCat.idcategoria = categoria.idcategoria;
            this.modalEditarCat.nombre = categoria.nombre;
            this.modalEditarCat.descripcion = categoria.descripcion;
            console.log(categoria.idcategoria);
            console.log(categoria.nombre);
            console.log(categoria.descripcion);
        },
        botonModalEditar: function ()
        {
            var url = this.path + 'editCat';
            param = new FormData();
            param.append('idcategoria', this.modalEditarCat.idcategoria);
            param.append('nombre', this.modalEditarCat.nombre);
            param.append('descripcion', this.modalEditarCat.descripcion);

            axios.post(url, param).then(res => {
                console.log(res.data.value);
                $('#editarCat').modal('hide');
                this.respuesta = res.data.value;
                $(document).ready(function () {
                    $('#mensaje').show('fade');
                    setTimeout(function () {
                        $('#mensaje').hide('fade');
                    }, 3000);
                });

                this.listaCat();
            }).catch(e => {
                console.log(e);
            });

        },

        getCategorias: function ()
        {
            var url = this.path + 'listaCat';
            axios.post(url).then(res => {
                console.log(res);
                this.listaCategorias = res.data;
            }).catch(e => {
                console.log(e);
            });
        },
        getProveedores: function ()
        {
            var url = this.path + 'getProveedores';
            axios.post(url).then(res => {
                console.log(res);
                this.listaProveedores = res.data;
            }).catch(e => {
                console.log(e);
            });
        }

    },
    created: function () {
        this.getSession();
        this.getCategorias();
        this.getProveedores();
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


