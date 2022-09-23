

new Vue({
    el: "#delivery",
    created: function () {
        this.getLatestRecords();
    },
    data: {
        latest: [],
        cargaScanner: 0,
        scanners: [],
        facilities: [],
        delivery: {
            mail: '',
            shop_name: '',
            shop_address: '',
            driver_assigned: '',
            part_number: '',
            payment_method: 1,
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
        getLatestRecords: function () {

            var url = "/delivery/latest";
            axios.get(url).then(response => {
                this.latest = response.data.delivery;
                this.delivery.mail = response.data.user;

            }).catch(function (error) {
                toastr.warning("Error", "Ha ocurrido un error ");
                console.log(error);
            });
        },

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
                this.getLatestRecords();
            }).catch(function (error) {

                var array = []
                for (const [key, value] of Object.entries(error.response.data)) {
                    array.push(value[0])
                }
                Swal.fire(array[0],
                    array[1])



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
    }
});
