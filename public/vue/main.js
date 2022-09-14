new Vue({
    el: "#main",
    created: function () {
        this.$nextTick(() => this.$refs.search.focus());
    },
    data: {
        busqueda: {
            empleado: null,
            scanner: null
        }
        ,
        empleadoCheck: false
    },
    computed: {

    },
    methods: {

        resetData: function () {
            this.busqueda.empleado = null;
            this.busqueda.scanner = null;
            this.empleadoCheck = false;
        },

        GuardarEmpleado: function () {
            this.empleadoCheck = true;
            this.$nextTick(() => this.$refs.scanner.focus());
        },

        LlamarModal(estatus, mensaje) {
            let timerInterval
            Swal.fire({
                icon: estatus,
                title: mensaje,
                html: 'Este modal se cerrara en <b></b> milliseconds.',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
            })
        },
        GuardarScanner: function () {
            var url = "/scanner/verificar/empleado";
            var data = this.busqueda;

            if (!this.busqueda.empleado) {
                let timerInterval
                Swal.fire({
                    title: 'Empleado es necesario',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
                return
            }
            axios
                .post(url, data)
                .then((response) => {

                    if (response.data == 0) {
                        this.LlamarModal('error', 'Escaner no existe');
                    } else if (response.data.tipo == 1) {
                        var scanner = response.data.scanner
                        var mensaje = 'Escanner #' + scanner.id + ' ha sido prestado';
                        this.LlamarModal('success', mensaje)
                    } else if (response.data.tipo == 2) {
                        var scanner = response.data.scanner
                        var mensaje = 'Escanner #' + scanner.id + ' ha sido devuelto';
                        this.LlamarModal('success', mensaje)
                    } else if (response.data == 2) {
                        this.LlamarModal('error', 'La persona que pide el scanner debe ser la misma que la que entrega')
                    }
                    this.resetData();

                })
                .catch(function (error) {
                    toastr.warning("Error", "Ha ocurrido un error ");
                    console.log(error);
                });


        },
    }
});
