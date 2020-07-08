var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Iniciar Sesion',
        path: 'http://localhost/tiendaCasino/',
        rut: '',
        password: ''
    },
    methods: {

        iniciar: function () {

            var url = this.path + 'login-user';
            param = new FormData();
            param.append('rut', this.rut);
            param.append('password', this.password);
            axios.post(url, param).then(res => {
                this.rut = "";
                this.password = "";
                console.log(res.data);
//                window.location.href = res.data.ruta;
                if (res.data.value == "Administrador") {

                    $(document).ready(function () {
                        toastr.success('Datos Obtenidos', res.data.value);
                        setTimeout(function () {                            
                             window.location.href = res.data.ruta;
                        }, 2000);
                    });

                } else if (res.data.value == "Usuario")
                {
                   $(document).ready(function () {
                        toastr.success('Datos Obtenidos', res.data.value);
                        setTimeout(function () {                            
                             window.location.href = res.data.ruta;
                        }, 2000);
                    });
                } else
                {
                    toastr.error('Error de datos', "Mensaje");
                }

            }).catch(e => {
                console.log(e);
            });
        },

        iniciarEnter: function (event) {
            // who caused it? "event.target.id"
            // console.log('keyup from id: ' + event.target.id)
            // what was pressed?
            let keyMessage = 'keyup: ';
            if (event.key == "Enter") {
                //  console.log("enter"); AL PRESIONAR TECLA EN EL PASSWORD ACTIVA EL METODO 
                this.iniciar();
            }
        }

    },
    created: function () {

    },
    mounted: function () {

    }
});