new Vue({
    el: "#reporte",
    created: function () {
    },
    data: {
        cargando: 0,
        cargaexcel: false,

        busqueda: {
            startdate: null,
            enddate: null,
            returned: null
        },
        resultados: [],
    },
    computed: {},
    methods: {

        initializeTable() {
            console.log(this.busqueda);
            this.table = new Tabulator("#records-table", {
                height: 450, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
                ajaxURL: "/delivery/reporte/generar", //ajax URL
                ajaxParams: { startdate: this.busqueda.startdate, enddate: this.busqueda.enddate, payment: this.busqueda.payment_method, returned: this.busqueda.returned }, //ajxax parameters
                layout: "fitColumns", //fit columns to width of table (optional)
                columns: [ //Define Table Columns
                    {
                        title: "#",
                        field: "id",
                        width: 10
                    },
                    {
                        title: "Name",
                        field: "user.name",
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
                        field: "total", formatter: "money", formatterParams: {
                            symbol: "$",
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
        downloadExcel() {
            this.table.download("csv", "ReportDetails.csv");
        },
    },
});
