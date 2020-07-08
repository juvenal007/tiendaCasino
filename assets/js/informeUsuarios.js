var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Informe de Usuarios',
        subtitulo: 'Cuentas de usuario',
        path: 'http://localhost/tiendaCasino/',
        respuesta: '',
        NUM_RESULTS: 10,
        pag: 1,
        info: true,
        cuenta: '',
        session: [],
        listaProveedores: [],
        listaCuentas: [],
        listaCompras: [],
        listaDetalle: []
    },
    methods: {
        
        

        limpiar: function ()
        {
            this.cuenta = '';
        },

        getCuenta: function ()
        {
            var cuenta = this.cuenta;

            var url = this.path + 'getInformeCuentas';
            param = new FormData();
            param.append('ncuenta', cuenta);
            axios.post(url, param).then(res => {
                console.log(res.data.value);
                // this.respuesta = res.data.msg;
                this.listaCuentas = res.data.value;
                this.listaCompras = res.data.compras;
                console.log(res.data.compras);
                if (res.data.msg == 'Cargando Datos') {
                    toastr.success('Datos Obtenidos', 'Notificacion');

                } else if (res.data.msg == 'Sin datos') {
                    if (this.listaCuentas.length > 0) {
                        toastr.success('Datos Obtenidos', 'Notificacion');
                    } else
                    {
                        toastr.info('Sin datos', 'Notificacion');
                        this.listaDetalle = '';
                    }

                } else if (res.data.msg == 'Error de datos') {
                    toastr.error('Error de datos');

                }
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

        modalDetalle: function (u)
        {
            var detalle = u;

            console.log("DETALLE: " + detalle.idcompra);

            var url = this.path + 'getDetalleCompra';
            param = new FormData();
            param.append('idcompra', detalle.idcompra);
            axios.post(url, param).then(res => {
                console.log(res.data.value);

                console.log(res.data);

                this.listaDetalle = res.data.value;

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



            jQuery('#cuenta').keypress(function (tecla) {
                if (tecla.charCode < 48 || tecla.charCode > 57)
                    return false;
            });


        });
    }
});



