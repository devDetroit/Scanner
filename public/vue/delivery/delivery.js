

new Vue({
    el: "#delivery",
    created: function () {
    },
    data: {
        cargaScanner: 0,
        scanners: [],
        facilities: [],
        delivery: {
            mail: 'asasas',
            shop_name: 'asas',
            shop_address: 'asas',
            driver_assigned: 'asas',
            part_number: '121212',
            payment_method: 2,
            returned: 0,
            parts_returned: null,
            total: 14
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
        /*  getFacilities: function (page) {
 
             var url = "/facilities/obtener";
             axios.get(url).then(response => {
                 this.facilities = response.data;
 
             }).catch(function (error) {
                 toastr.warning("Error", "Ha ocurrido un error ");
                 console.log(error);
             });
         }, */

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getScanners(page);

        },
        Guardar: function () {
            var url = "/delivery/guardar";
            axios.post(url, this.delivery).then((response) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Record Entered Successfully',
                    text: '',
                })
            }).catch(function (error) {

                var array = []
                for (const [key, value] of Object.entries(error.response.data)) {
                    array.push(value[0])
                }
                Swal.fire(array[0],
                    array[1])

                /*  Swal.fire(array[0],
                     array[1]) */
                /* array.forEach(element =>
                    Swal.fire(element[0]
                    )) */


                /*  for (const [key, value] of Object.entries(error.response.data)) {
                     Swal.fire(
                         `${key}: ${value}`
                         ,
                         '',
                         'error'
                     )
                 } */

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
