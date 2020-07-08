var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Lista Usuarios',
        subtitulo: 'Lista',
        path: 'http://localhost/tiendaCasino/',
        listaUsuarios: [],
        NUM_RESULTS: 15,
        pag: 1,
        session: []
    },
    methods: {
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
                 $(document).ready(function () {
                        $('#mensaje').show('fade');
                        setTimeout(function () {
                            $('#mensaje').hide('fade');
                        }, 5000);
                    });
             
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
        },
        getUsuarios: function ()
        {
            var url = this.path + 'getUsuarios';
            axios.post(url).then(res =>{
               console.log(res); 
               this.listaUsuarios = res.data;               
            }).catch(e =>{
                console.log(e);
            });
        }

    },
    created: function () {
        this.getSession();
        this.getUsuarios();
    },
    mounted: function () {
        $(document).ready(function () {
            $('#mensajeCerrar').click(function () {
                $('#mensaje').hide('fade');
            });
        });
    }
});



