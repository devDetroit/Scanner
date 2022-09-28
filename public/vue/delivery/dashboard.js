new Vue({
    el: "#dashboard",
    mounted: function () {
    },
    data: {
        total: null,

        busqueda: {
            startdate: null,
            enddate: null,
            returned: null
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

        printPDF() {
            // get size of report page
            var reportPageHeight = $('#dashboard').innerHeight();
            var reportPageWidth = $('#dashboard').innerWidth();

            // create a new canvas object that we will populate with all other canvas objects
            var pdfCanvas = $('<canvas />').attr({
                id: "canvaspdf",
                width: reportPageWidth,
                height: reportPageHeight
            });

            // keep track canvas position
            var pdfctx = $(pdfCanvas)[0].getContext('2d');
            var pdfctxX = 0;
            var pdfctxY = 0;
            var buffer = 100;

            // for each chart.js chart
            $("canvas").each(function (index) {
                // get the chart height/width
                var canvasHeight = $(this).innerHeight();
                var canvasWidth = $(this).innerWidth();

                // draw the chart into the new canvas
                pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
                pdfctxX += canvasWidth + buffer;

                // our report page is in a grid pattern so replicate that in the new canvas
                if (index % 2 === 1) {
                    pdfctxX = 0;
                    pdfctxY += canvasHeight + buffer;
                }
            });

            // create new pdf and add our new canvas as an image
            var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
            pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);

            // download the pdf
            pdf.save('filename.pdf');
        }
    }
});
