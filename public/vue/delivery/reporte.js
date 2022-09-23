new Vue({
    el: "#reporte",
    created: function () {
    },
    data: {
        cargando: 0,
        cargaexcel: false,

        busqueda: {
            mail: '',
            shop_name: '',
            shop_address: '',
            driver_assigned: '',
            part_number: '',
            payment_method: 0,
            returned: null,
            parts_returned: 0,
            total: 0,
            startdate: null,
            enddate: null
        },
        resultados: [],
    },
    computed: {},
    methods: {
        consultarReporte: function () {
            this.cargando = 1;
            this.resultados = [];
            var url = "/delivery/reporte/generar";
            var data = {
                busqueda: this.busqueda,
            };
            axios
                .post(url, data)
                .then((response) => {
                    this.cargando = 0;
                    this.resultados = response.data;
                })
                .catch(function (error) {
                    toastr.warning("Error", "Ha ocurrido un error ");
                    console.log(error);
                });
        },

        rellenarSucursales: function () {
            this.sucursalAsignada = [];
            this.zonaSeleccionada.forEach((zone) => {
                this.sucursales.forEach((branch) => {
                    if (zone.cZonaFolio == branch.cSucursalZona) {
                        this.sucursalAsignada.push(branch);
                    }
                });
            });

            this.busqueda.sucursal = [];

            this.zonaSeleccionada.forEach((zone) => {
                this.sucursalAsignada.forEach((branch) => {
                    if (branch.cSucursalZona == zone.cZonaFolio) {
                        let existe = this.busqueda.sucursal.find(
                            (sucursal) =>
                                sucursal.cSucursalFolio == branch.cSucursalFolio
                        );
                        if (!existe) this.busqueda.sucursal.push(branch);
                    }
                });
            });
        },
        todasZonas: function () {
            if (this.CheckZona) {
                this.zonaSeleccionada = this.zonas;
                this.rellenarSucursales();
            } else {
                this.zonaSeleccionada = [];
                this.rellenarSucursales();
            }
        },

        getSucursales: function () {
            var url = "/general/empleado/sucursales";
            axios
                .get(url)
                .then((response) => {
                    this.sucursales = response.data;
                })
                .catch(function (error) {
                    toastr.warning("Error", "Ha ocurrido un error ");
                    console.log(error);
                });
        },
        getZonas: function () {
            var url = "/general/empleado/zonas";
            axios
                .get(url)
                .then((response) => {
                    this.zonas = response.data;
                })
                .catch(function (error) {
                    toastr.warning("Error", "Ha ocurrido un error ");
                    console.log(error);
                });
        },
        Branch: function ({ cSucursalFolio, cSucursalIdentificador }) {
            return `[${cSucursalFolio}] - ${cSucursalIdentificador}`;
        },

        generarPDF: function () {
            this.cargapdf = true;
            var url = "/reportes/productos/generar/pdf";
            var data = {
                busqueda: this.busqueda,
            };
            axios({
                method: "post",
                url: url,
                responseType: "blob",
                data: data,
            }).then((response) => {
                this.cargapdf = false;
                let blob = new Blob([response.data], {
                    type: "application/pdf",
                });
                let link = document.createElement("a");
                link.href = window.URL.createObjectURL(blob);
                link.download = "ReporteProducto.pdf";
                link.click();
            });


        },

        generarExcel: function () {
            this.cargaexcel = true;
            var url = "/reportes/productos/generar/excel";
            var data = {
                busqueda: this.busqueda,
            };
            axios({
                method: "post",
                url: url,
                responseType: "blob",
                data: data,
            }).then((response) => {
                this.cargaexcel = false;
                let blob = new Blob([response.data], {
                    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                });
                let link = document.createElement("a");
                link.href = window.URL.createObjectURL(blob);
                link.download = "ReporteProducto.csv";
                link.click();
            });
        },

        formatPrice: function (value) {
            var formatter = new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "USD",
                minimumFractionDigits: 2,
            });
            return formatter.format(value);
        },
    },
});
