new Vue({
    el: "#scanner",
    created: function () {
        this.getScanners();
    },
    data: {
        cargaScanner: 0,
        scanners: [],
        facilities: [],
        scanner: {
            id: null,
            description: null,
            status: null,
            facility_id: null,
            active: null
        },
        scannerData: null,
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
        },

        offset: 3
    },
    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {

        resetData: function () {
            this.scanner.id = null,
                this.scanner.names = null;
            this.scanner.state = null;
            this.scanner.active = null;
            this.scanner.facility_id = null;
        },

        getScanners: function (page) {
            this.cargaScanner = 1;
            var url = "/scanner/todo?page=" + page;
            axios.get(url).then(response => {
                this.scanners = response.data.scanner.data;
                this.pagination = response.data.pagination;
                this.cargaScanner = 0;
            }).catch(function (error) {
                toastr.warning("Error", "Ha ocurrido un error ");
                console.log(error);
            });
        },
        getFacilities: function (page) {

            var url = "/facilities/obtener";
            axios.get(url).then(response => {
                this.facilities = response.data;

            }).catch(function (error) {
                toastr.warning("Error", "Ha ocurrido un error ");
                console.log(error);
            });
        },
        createScanner: function () {
            this.resetData();
            this.getFacilities();
            $("#agregar").modal("show");
        },
        addScanner: function () {
            var url = "/scanner/agregar";
            var data = {
                'scanner': this.scanner
            };

            axios.post(url, data).then((response) => {

                if (response.data == 1) {
                    Swal.fire(
                        'Scanner already exists',
                        '',
                        'error'
                    )
                    return
                }

                Swal.fire(
                    'Scanner added successfully',
                    '',
                    'success'
                )
                this.getScanners();
                this.resetData();
                $("#agregar").modal("hide");
            }).catch(function (error) {
                toastr.warning("Error", "Ha ocurrido un error ");
                console.log(error);
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getConceptos(page);

        },
        editScanner: function (scanner) {
            this.scannerData = scanner;
            this.getFacilities();
            $("#editar").modal("show");
        },

        updateScanner: function () {
            var url = "/scanner/actualizar";
            var data = {
                'scanner': this.scannerData
            };
            axios.post(url, data).then((response) => {

                if (response.data == 1) {
                    Swal.fire(
                        'Scanner already exists',
                        '',
                        'error'
                    )
                    return
                }

                Swal.fire(
                    'Scanner updated successfully',
                    '', 
                    'success'
                )
                this.getScanners();
                this.resetData();
                $("#editar").modal("hide");
            }).catch(function (error) {
                toastr.warning("Error", "Ha ocurrido un error ");
                console.log(error);
            });
        },

        removeScanner: function (scanner) {
            this.scannerData = scanner;
            $("#eliminar").modal("show");
        },

        deleteScanner: function () {
            var url = "/scanner/eliminar";
            var data = {
                'scanner': this.scannerData
            };
            axios.post(url, data).then(() => {
                Swal.fire(
                    'Scanner deleted successfully',
                    'success'
                )
                this.getScanners();
                this.resetData();
                $("#eliminar").modal("hide");
            }).catch(function (error) {
                toastr.warning("Error", "Ha ocurrido un error ");
                console.log(error);
            });
        },
    }
});
