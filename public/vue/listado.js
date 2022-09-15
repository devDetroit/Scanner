new Vue({
    el: "#listado",
    created: function () {
        this.getScanners();
        this.getFacilities();
    },
    data: {
        horaactual: null,
        scanners: [],
        facilitiesporpermiso: [],
        searchFacility: "",
        disponible: null,
        enuso: null,
        inactive: null,
        historial: []
    },
    computed: {

    },
    mounted: function () {
        this.timer = setInterval(() => {
            this.getScanners()
        }, 30000)
    },
    methods: {

        getFacilities: function () {
            var url = "/facilities/obtener/permiso";
            axios.get(url)
                .then((response) => {
                    this.facilitiesporpermiso = response.data;
                })
                .catch(function (error) {
                    toastr.warning("Error", "Ha ocurrido un error ");
                    console.log(error);
                });
        },


        getScanners: function () {
            var url = "/scanner/obtener";
            axios.get(url, {
                params: {
                    facility: this.searchFacility,
                },
            })
                .then((response) => {
                    this.scanners = response.data.scanner;
                    this.disponible = response.data.disponibles;
                    this.enuso = response.data.enuso;
                    this.inactive = response.data.inactivos;
                    this.horaactual = response.data.horaactual;
                })
                .catch(function (error) {
                    toastr.warning("Error", "Ha ocurrido un error ");
                    console.log(error);
                });
        },
    }
});
