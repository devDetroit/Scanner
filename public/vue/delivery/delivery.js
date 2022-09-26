
new Vue({
    el: "#delivery",
    mounted: function () {
        this.initializeTable();
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

        initializeTable() {
            this.table = new Tabulator("#records-table", {
                height: 205, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
                ajaxURL: "/delivery/latest", //ajax URL
                layout: "fitColumns", //fit columns to width of table (optional)
                columns: [ //Define Table Columns
                    {
                        title: "#",
                        field: "id",
                        width: 10
                    },
                    {
                        title: "E-Mail",
                        field: "mail",
                        width: 150
                    },
                    {
                        title: "Shop Name",
                        field: "shop_name",
                        hozAlign: "left",
                        width: 130
                    },
                    {
                        title: "Driver Assigned",
                        field: "driver_assigned",
                        width: 130
                    },
                    {
                        title: "Payment Method",
                        field: "FormaPago"
                    },
                    {
                        title: "Returned",
                        field: "Retorno"
                    },
                    {
                        title: "Parts Returned",
                        field: "parts_returned"
                    },
                    {
                        title: "Total",
                        field: "total", formatter: "money", formatterParams:{
                            symbol:"$",
                        }
                    },
                    {
                        title: "Created At",
                        field: "created_at",
                        sorter: "date",
                        hozAlign: "center"
                    },
                ],
            });
        },
        resetData() {
            for (const key in this.delivery) {
                this.delivery[key] = '';
            }
        },
        getLatestRecords() {
            var url = "/delivery/latest";
            axios.get(url).then(response => {
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
                this.table.setData();
            }).catch(function (error) {
                var array = []
                for (const [key, value] of Object.entries(error.response.data)) {
                    array.push(value[0])
                }
                Swal.fire(array[0],
                    array[1])
            });
        },
    }
});

