var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Iniciar Sesion',
        path: 'http://localhost/tiendaCasino/',
        session: [],
        contarUsuarios: '',
        contarProductos: '',
        contarCategorias: '',
        contarVentas: '',
        contarProveedores: '',
        cantidadProdComprados: ''      
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
                window.location.href = res.data.ruta;
                if (res.data.res == "Administrador") {                  
                    window.location.href = res.data.ruta;
                }
                else if(res.data.res == "Usuario")
                {                   
                    window.location.href = res.data.ruta;
                }
                else
                {
                    console.log(res);
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
            var url = this.path + 'contarUsuarios';
            axios.post(url).then(res => {
                console.log(res);
                this.contarUsuarios = res.data[0];
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
        getCategorias: function ()
        {
            var url = this.path + 'contarCategorias';
            axios.post(url).then(res => {
                console.log(res);
                this.contarCategorias = res.data[0];
            }).catch(e => {
                console.log(e);
            });
        },
        getVentas: function ()
        {
            var url = this.path + 'contarVentas';
            axios.post(url).then(res => {
                console.log(res);
                this.contarVentas = res.data[0][0].total;
            }).catch(e => {
                console.log(e);
            });
        },
        
        getProveedores: function ()
        {
            var url = this.path + 'contarProveedores';
            axios.post(url).then(res => {
                console.log(res);
                this.contarProveedores = res.data[0];
            }).catch(e => {
                console.log(e);
            });
        },
        
        getProd: function ()
        {
            var url = this.path + 'cantidadProdComprados';
            axios.post(url).then(res => {
                console.log(res);
                this.cantidadProdComprados = res.data[0][0].total;
            }).catch(e => {
                console.log(e);
            });
        }

    },
    created: function () {
        this.getSession();
        this.getUsuarios();
        this.getProductos();
        this.getCategorias();
        this.getProveedores();
        this.getVentas();
        this.getProd();
    },
    mounted: function () {
    }
});

