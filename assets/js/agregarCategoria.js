var app = new Vue({
    el: '#contenido',
    data: {
        titulo: 'Agregar Categoria',
        subtitulo: 'Categoria',
        path: 'http://localhost/tiendaCasino/',
        NUM_RESULTS: 10,
        pag: 1,
        categoria: {
            nombre: '',
            descripcion: '',
            imagenCat: '',
            estado: ''
        },
        session: [],
        form_data: '',
        respuesta: '',
        file_data: {},
        listaCategorias: [],
        modalEditarCat: {
            idcategoria: '',
            nombre: '',
            descripcion: '',
            estado:''
        }
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
                    this.categoria.imagenCat = res.data.success;
                }
                if (res.data.error) {
                    $('#error').addClass("text-danger");
                    $('#error').html(res.data.error);
                }
            }).catch(e => {
                console.log(e);
            });
        },

        listaCat: function ()
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

        limpiarCampos: function ()
        {
            this.categoria.nombre = '';
            this.categoria.descripcion = '';
            this.categoria.imagenCat = '';
            $('#image-display').attr('src', 'https://via.placeholder.com/150x150');
            $('#error').html("");
        },

        agregarCategoria: function () {
            var url = this.path + 'addCategoria';
            param = new FormData();
            param.append('nombre', this.categoria.nombre);
            param.append('descripcion', this.categoria.descripcion);
            param.append('imagenCat', this.categoria.imagenCat);

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
                this.listaCat();
            }).catch(e => {
                console.log(e);
            });
            this.listaCat();
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
        
        modalEliminarCategoria: function (p)
        {
            var categoria = p;
            $('#eliminarCategoria').modal('show');
            this.modalEditarCat.idcategoria = categoria.idcategoria;
            this.modalEditarCat.nombre = categoria.nombre;
            this.modalEditarCat.descripcion = categoria.descripcion;
            console.log(categoria.idcategoria);
            console.log(categoria.nombre);
            console.log(categoria.descripcion);
        },
        eliminarCategoria: function ()
        {
           $('#eliminarCategoria').modal('hide')
            var url = this.path + 'eliminarCategoria';
            param = new FormData();
            param.append('idcategoria', this.modalEditarCat.idcategoria);
            axios.post(url, param).then(res => {
                console.log(res.data.value);
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
        }
        
        

    },
    created: function () {
        this.getSession();
        this.listaCat();
    },
    mounted: function () {
        $(document).ready(function () {
            $('#mensajeCerrar').click(function () {
                $('#mensaje').hide('fade');
            });
        });
    }
});