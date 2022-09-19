new Vue({
    el: "#main",
    created: function () {
        console.log(1);
        this.$nextTick(() => this.$refs.search.focus());
        this.getHistorial();
    },
    data: {
        busqueda: {
            empleado: null,
            scanner: null
        },
        historial: [],
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
            console.log(2);
        },

        LlamarModal(estatus, mensaje) {
            console.log(3);
            let timerInterval
            Swal.fire({
                icon: estatus,
                title: mensaje,
                html: 'Este modal se cerrara en <b></b> milliseconds.',
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
                    location.reload();
                }
            })
        },
        getHistorial: function () {
            var url = "/scanner/historial";
            axios.get(url)
                .then((response) => {
                    this.historial = response.data;
                })
                .catch(function (error) {
                    /*   toastr.warning("Error", "Ha ocurrido un error "); */
                    console.log(error);
                });
        },
        GuardarScanner: function () {
            console.log(4);
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
                    /* this.getHistorial(); */
                })
                .catch(function (error) {
                    /*   toastr.warning("Error", "Ha ocurrido un error "); */
                    console.log(error);
                });


        },
    }
});
