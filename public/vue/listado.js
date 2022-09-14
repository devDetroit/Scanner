new Vue({
    el: "#listado",
    created: function () {
        this.getScanners();
        this.getFacilities();
    },
    data: {
        scanners: [],
        facilitiesporpermiso: [],
        searchFacility: "",
    },
    computed: {

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
                    this.scanners = response.data;
                })
                .catch(function (error) {
                    toastr.warning("Error", "Ha ocurrido un error ");
                    console.log(error);
                });
        },
    }
});
