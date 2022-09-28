new Vue({
    el: "#dashboard",
    mounted: function () {
    },
    data: {
        total: null,

        busqueda: {
            startdate: null,
            enddate: null,
            returned: 1
        },
        chart: null
    },
    methods: {
        initializeTable() {
            if (this.chart != null) {
                this.chart.destroy();
            }
            const labels = [
                'CASH',
                'CHECK',
                'CREDIT CARD',
                'CHARGEA ACCOUNT',
            ];

            var url = "/delivery/dashboard/generar";
            axios.get(url, {
                params: {
                    start: this.busqueda.startdate,
                    end: this.busqueda.enddate,
                    returned: this.busqueda.returned
                }
            },).then(response => {
                if (response.data == 0) {
                    toastr.warning('No records for this date')
                } else {
                    var total = response.data.totales.payform;
                    this.total = total;
                    const data = {
                        labels: labels,
                        datasets: [{
                            label: 'My First dataset',
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)',
                                'rgb(168, 18, 18)'
                            ],
                            borderColor: 'rgb(255, 99, 132)',
                            data: [total['CASH'], total['CHECK'], total['CREDIT CARD'], total['CHARGE ACCOUNT']],
                        }]
                    };

                    console.log(total);

                    const config = {
                        type: 'doughnut',
                        data: data,
                        options: {
                            responsive: true
                        }
                    };
                    this.chart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );
                }

            }).catch(function (error) {
                toastr.warning("Error", "Ha ocurrido un error ");
                console.log(error);
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
