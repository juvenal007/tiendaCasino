var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Informe de Productos',
        subtitulo: 'Productos',
        path: 'http://localhost/tiendaCasino/',
        respuesta: '',
        NUM_RESULTS: 10,
        pag: 1,
        session: [],
        listaCategorias: [],
        listaProductos: [],
        arrayCat: [],
        listCatFinal: [],
        contarCategorias: '',
        contarProductos: '',
    },
    methods: {

        exportarExcel: function ()
        {
            var url = this.path + 'exportarExcel';
            document.location.target = "_blank";
            document.location.href = url;
            toastr.success('Exportando a excel', 'Notificacion');
        },

        limpiar: function ()
        {
            $('#fechaInicio').val('');
            $('#fechaFin').val('');
        },

        getCategorias: function ()
        {
            var url = this.path + 'getInformeProductosCat';
            param = new FormData();
            axios.post(url).then(res => {
                console.log(res.data);
//                this.respuesta = res.data.msg;
                this.listaCategorias = res.data.categorias;
                this.arrayCat = res.data.value;

                var categorias = '';
                categorias = this.listaCategorias;
                for (var i = 0; i < this.listaCategorias.length; i++) {
                    categorias[i].cantidadProd = this.arrayCat[i];
                }
                if (res.data.msg == 'Cargando Datos') {
                    toastr.success('Datos Obtenidos', 'Notificacion');
                } else if (res.data.msg == 'Sin datos') {
                    toastr.info('Sin datos', 'Notificacion');
                } else if (res.data.msg == 'Error de datos') {
                    toastr.error('Error de datos');
                }

            }).catch(e => {
                console.log(e);
            });

        },

        getProductos: function ()
        {
            var url = this.path + 'contarProductos';
            axios.post(url).then(res => {
                console.log(res);
                this.contarProductos = res.data[0];
            }).catch(e => {
                console.log(e);
            });
        },

        agregarProveedor: function () {
            var url = this.path + 'addProveedor';
            param = new FormData();
            param.append('rut', this.proveedor.rut);
            param.append('nombre', this.proveedor.nombre);
            param.append('apellido_pat', this.proveedor.apellido_pat);
            param.append('apellido_mat', this.proveedor.apellido_mat);
            param.append('telefono', this.proveedor.telefono);
            param.append('direccion', this.proveedor.direccion);
            param.append('ciudad', this.proveedor.ciudad);
            axios.post(url, param).then(res => {
                console.log(res.data.value);
                this.respuesta = res.data.value;
                $(document).ready(function () {
                    $('#mensaje').show('fade');
                    setTimeout(function () {
                        $('#mensaje').hide('fade');
                    }, 3000);
                });
                this.limpiar();
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

        getCategorias_count: function ()
        {
            var url = this.path + 'contarCategorias';
            axios.post(url).then(res => {
                console.log(res);
                this.contarCategorias = res.data[0];
            }).catch(e => {
                console.log(e);
            });
        }



    },
    created: function () {
        this.getSession();
        this.getCategorias();
        this.getProductos();
    },
    mounted: function () {
        $(document).ready(function () {
            $('#mensajeCerrar').click(function () {
                $('#mensaje').hide('fade');
            });
            jQuery('#fechaInicio').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy'
            });
            jQuery('#fechaFin').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy'
            });

            jQuery('#fechaInicio').keypress(function (tecla) {
                if (tecla.charCode < 48 || tecla.charCode > 57)
                    return false;
            }).on('paste', function (e) {
                e.preventDefault();
            });

            jQuery('#fechaFin').keypress(function (tecla) {
                if (tecla.charCode < 48 || tecla.charCode > 57)
                    return false;
            });

            jQuery('#codigo').keypress(function (tecla) {
                if (tecla.charCode < 48 || tecla.charCode > 57)
                    return false;
            });

           


        });
    }
});




