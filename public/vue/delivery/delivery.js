new Vue({
    el: "#delivery",
    created: function () {
        this.getLatestRecords();
    },
    data: {
        latest: [],
        delivery: {
            mail: '',
            shop_name: '',
            shop_address: '',
            driver_assigned: '',
            part_number: '',
            payment_method: 1,
            returned: 0,
            parts_returned: '',
            total: ''
        },
        table: null
    },
    methods: {
        resetData() {
            for (const key in this.delivery) {
                this.delivery[key] = '';
            }
        },
        getLatestRecords() {
            var url = "/delivery/latest";
            axios.get(url).then(response => {
                this.latest = response.data.delivery;
                this.delivery.mail = response.data.user;

            }).catch(function (error) {
                console.error(error);
            });
        },
        guardar() {
            var url = "/delivery/guardar";
            axios.post(url, this.delivery).then((response) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Record Entered Successfully',
                    text: '',
                })
                this.resetData();
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
        formatPrice(value) {
            var formatter = new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "USD",
                minimumFractionDigits: 2,
            });
            return formatter.format(value);
        },
    }
});
