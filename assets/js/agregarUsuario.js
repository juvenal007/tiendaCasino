var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Agregar Usuario',
        subtitulo: 'Usuarios',
        path: 'http://localhost/tiendaCasino/',
        respuesta: '',
        usuario: {
            rut: '',
            nombre: '',
            apellido_pat: '',
            apellido_mat: '',
            telefono: '',
            institucion: '',
            direccion: '',
            password: '',
            ciudad: '',
            tipo: '',            
        },
        session: []
    },
    methods: {
        
        limpiar: function ()
        {
            this.usuario.rut = '';
            this.usuario.nombre = '';
            this.usuario.apellido_pat = '';
            this.usuario.apellido_mat = '';
            this.usuario.telefono = '';
            this.usuario.institucion = '';
            this.usuario.direccion = '';
            this.usuario.password = '';
            this.usuario.ciudad = '';
            this.usuario.tipo = '';
        },
        

        agregarUsuario: function () {
            var url = this.path + 'addUsuario';
            param = new FormData();
            param.append('rut', this.usuario.rut);    
            param.append('nombre', this.usuario.nombre);
            param.append('apellido_pat', this.usuario.apellido_pat);
            param.append('apellido_mat', this.usuario.apellido_mat);
            param.append('telefono', this.usuario.telefono);
            param.append('institucion', this.usuario.institucion);
            param.append('direccion', this.usuario.direccion);
            param.append('password', this.usuario.password);
            param.append('ciudad', this.usuario.ciudad);
            param.append('tipo', this.usuario.tipo);
            
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
            axios.post(url).then(res =>{
               console.log(res); 
               this.session = res.data[0];               
            }).catch(e =>{
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
        });
    }
});



