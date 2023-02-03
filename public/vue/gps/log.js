new Vue({
    el: "#listado",
    created: function () {
        this.getScanners();
        this.getFacilities();
    },
    data: {
        horaactual: null,
        log: [],
        facilitiesporpermiso: [],
        busqueda: {
            scanner: '',
            user: '',
            start: null,
            end: null
        },
        disponible: null,
        enuso: null,
        inactive: null,
        historial: [],
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
                    console.log(error);
                });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getScanners(page);

        },
        getScanners: function (page) {
            var url = "/gps/log/obtener?page=" + page;
            axios.get(url, {
                params: {
                    scanner: this.busqueda.scanner,
                    user: this.busqueda.user,
                    facility: this.busqueda.facility,
                    start: this.busqueda.start,
                    end: this.busqueda.end,
                },
            })
                .then((response) => {
                    this.log = response.data.log.data;
                    this.pagination = response.data.pagination;
                    this.disponible = response.data.disponibles;
                    this.enuso = response.data.enuso;
                    this.inactive = response.data.inactivos;
                    this.horaactual = response.data.horaactual;
                })
                .catch(function (error) {

                    console.log(error);
                });
        },
    }
});
