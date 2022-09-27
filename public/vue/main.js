toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
new Vue({
    el: "#main",
    data: {
        busqueda: {
            empleado: '',
            scanner: ''
        },
        historial: [],
    },
    methods: {
        resetData() {
            this.busqueda.empleado = '';
            this.busqueda.scanner = '';
        },
        LlamarModal(estatus, mensaje) {
            alert(mensaje)
        },
        getHistorial() {
            axios.get("/scanner/historial")
                .then((response) => {
                    this.historial = response.data;
                })
                .catch(function (error) {
                    alert('Error en el sistema, contactar a sistemas')
                    console.error(error)
                });
        },
        validateData() {
            return employee.value.trim().length > 0 && scanner.value.trim().length > 0;
        },
        focusInput() {
            if (employee.value.trim().length == 0) {
                employee.focus()
                return
            }

            if (scanner.value.trim().length == 0) {
                scanner.focus()
                return
            }

            if (this.validateData())
                this.submitInfo()
        },
        submitInfo: function () {
            var url = "scanner/verificar/empleado";
            var data = this.busqueda;

            axios
                .post(url, data)
                .then((response) => {
                    if (response.data != null) {
                        toastr[response.data.returnValue < 0 ? 'error' : 'success'](response.data.returnMessage, "Mensaje del Sistema")

                    }
                    this.resetData();
                    this.getHistorial();
                })
                .then(() => this.focusInput())
                .catch(function (error) {
                    console.error(error)
                });
        },
    },
    mounted: function () {
        this.getHistorial();
        this.focusInput();
    },
});
