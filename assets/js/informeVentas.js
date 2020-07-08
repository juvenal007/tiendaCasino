var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Informe de Ventas',
        subtitulo: 'Informe Ventas',
        path: 'http://localhost/tiendaCasino/',
        respuesta: '',
        NUM_RESULTS: 10,
        pag: 1,
        session: [],
        listaProveedores: [],
        listaVentas: []
    },
    methods: {

        limpiarFecha: function ()
        {
            $('#fechaInicio').val('');
            $('#fechaFin').val('');
        },

        getFecha: function ()
        {
            var fecha1 = $('#fechaInicio').val();
            var fecha2 = $('#fechaFin').val();

            var url = this.path + 'getInformeVentas';
            param = new FormData();
            param.append('fechaInicio', fecha1);
            param.append('fechaFin', fecha2);
            axios.post(url, param).then(res => {
                console.log(res.data.value);
                // this.respuesta = res.data.msg;
                this.listaVentas = res.data.value;

                if (res.data.msg == 'Cargando Datos') {
                    toastr.success('Datos Obtenidos', 'Notificacion');
                } else if (res.data.msg == 'Sin datos') {
                    toastr.info('Sin datos', 'Notificacion');
                } else if (res.data.msg == 'Error de datos') {
                    toastr.error('Error de datos');
                }
                this.limpiarFecha();



            }).catch(e => {
                console.log(e);
            });


            console.log(fecha1 + fecha2);
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
        editarProveedor: function ()
        {
            $('#editarProveedorModal').modal('hide')
            var url = this.path + 'editProveedor';
            param = new FormData();
            param.append('idproveedor', this.modalEditarProveedor.idproveedor);
            param.append('rut', this.modalEditarProveedor.rut);
            param.append('nombre', this.modalEditarProveedor.nombre);
            param.append('apellido_pat', this.modalEditarProveedor.apellido_pat);
            param.append('apellido_mat', this.modalEditarProveedor.apellido_mat);
            param.append('telefono', this.modalEditarProveedor.telefono);
            param.append('direccion', this.modalEditarProveedor.direccion);
            param.append('ciudad', this.modalEditarProveedor.ciudad);
            axios.post(url, param).then(res => {
                console.log(res.data.value);
                this.respuesta = res.data.value;
                $(document).ready(function () {
                    $('#mensaje').show('fade');
                    setTimeout(function () {
                        $('#mensaje').hide('fade');
                    }, 3000);
                });
                this.getProveedores();
            }).catch(e => {
                console.log(e);
            });
        },
        cargarModalEditar: function (p)
        {
            var proveedor = p;
            $('#editarProveedorModal').modal('show');
            this.modalEditarProveedor.idproveedor = proveedor.idproveedor;
            this.modalEditarProveedor.rut = proveedor.rut;
            this.modalEditarProveedor.nombre = proveedor.nombre;
            this.modalEditarProveedor.apellido_pat = proveedor.apellido_pat;
            this.modalEditarProveedor.apellido_mat = proveedor.apellido_mat;
            this.modalEditarProveedor.telefono = proveedor.telefono;
            this.modalEditarProveedor.direccion = proveedor.direccion;
            this.modalEditarProveedor.ciudad = proveedor.ciudad;
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

        modalEliminarProveedor: function (p)
        {
            var proveedor = p;
            $('#eliminarProveedorModal').modal('show');
            this.modalEditarProveedor.idproveedor = proveedor.idproveedor;
            this.modalEditarProveedor.rut = proveedor.rut;
            this.modalEditarProveedor.nombre = proveedor.nombre;
            this.modalEditarProveedor.apellido_pat = proveedor.apellido_pat;
            this.modalEditarProveedor.apellido_mat = proveedor.apellido_mat;
            this.modalEditarProveedor.telefono = proveedor.telefono;
            this.modalEditarProveedor.direccion = proveedor.direccion;
            this.modalEditarProveedor.ciudad = proveedor.ciudad;
        },
        eliminarProveedor: function ()
        {
            $('#eliminarProveedorModal').modal('hide')
            var url = this.path + 'eliminarProveedor';
            param = new FormData();
            param.append('idproveedor', this.modalEditarProveedor.idproveedor);
            axios.post(url, param).then(res => {

                console.log(res.data.value);
                this.respuesta = res.data.value;
                $(document).ready(function () {
                    $('#mensaje').show('fade');
                    setTimeout(function () {
                        $('#mensaje').hide('fade');
                    }, 3000);
                });
                this.getProveedores();
            }).catch(e => {
                console.log(e);
            });
        }
    },
    created: function () {
        this.getSession();

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


        });
    }
});



