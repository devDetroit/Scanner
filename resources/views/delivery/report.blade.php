@extends('layouts.app')
@section('content')
<div id="reporte" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow p-1 bg-body rounded">
                <!-- <div class="card-header">
                    <h3>Records</h3>
                    <template v-if="resultados">
                        <template v-if="!cargando && resultados.length>0">
                            <div class="card-tools">
                                <div class="row">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button @click.prevent="generarExcel()" class="btn btn-success" :disabled="cargaexcel">
                                            <i :class="!cargaexcel ? 'fas fa-file-pdf' : 'fa fa-spinner fa-pulse fa-1x fa-fw'"></i>
                                            <span> Excel </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </template>
                </div> -->
                <div class="card-body">
                    <h5 class="card-title">Report Records</h5>
                    <form class="row row-cols-lg-auto g-3 align-items-center mt-2">
                        <div class="col-12">
                            <label class="visually-hidden" for="inlineFormInputGroupUsername">From:</label>
                            <div class="input-group">
                                <div class="input-group-text">@</div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="from date">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="visually-hidden" for="inlineFormInputGroupUsername">To:</label>
                            <div class="input-group">
                                <div class="input-group-text">@</div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="to date">
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">search</button>
                        </div>
                    </form>
                    <div id="table-records"></div>
                    <!--     <template v-if="!cargando">
                        <div class="table table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mail</th>
                                        <th class="text-center">Shop Name</th>
                                        <th class="text-right">Shop Address</th>
                                        <th class="text-right">Driver Assigned</th>
                                        <th class="text-right">Part Number</th>
                                        <th class="text-right">Payment Method</th>
                                        <th class="text-right">Returned</th>
                                        <th class="text-right">Parts Returned</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="resultados.length > 0">
                                        <template v-for="delivery in resultados">
                                            <tr>
                                                <td>@{{ delivery.id }}</td>
                                                <td>@{{ delivery.mail  }}</td>
                                                <td class="text-center">@{{ delivery.shop_name }}</td>
                                                <td class="text-center">@{{ delivery.shop_address }}</td>
                                                <td class="text-center">@{{ delivery.driver_assigned }}</td>
                                                <td class="text-center">@{{ delivery.part_number }}</td>
                                                <td v-if="delivery.payment_method == 1" class="text-center">Cash</td>
                                                <td v-else-if="delivery.payment_method == 2" class="text-center">Check</td>
                                                <td v-else-if="delivery.payment_method == 3" class="text-center">Credit Card</td>
                                                <td v-else-if="delivery.payment_method == 4" class="text-center">Charge Account</td>
                                                <td v-if="delivery.returned == 0" class="text-center">No</td>
                                                <td v-else-if="delivery.returned == 1" class="text-center">Si</td>
                                                <td v-if="delivery.parts_returned != null" class="text-center">@{{ delivery.parts_returned }}</td>
                                                <td v-else-if="delivery.parts_returned == null" class="text-center">N/A</td>
                                                <td class="text-right">@{{ formatPrice(delivery.total) }}</td>
                                            </tr>
                                        </template>
                                    </template>
                                    <template v-else>
                                        <td colspan="7">
                                            <p class="text-center">No se encontraron resultados</p>
                                        </td>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </template>
                    <template v-else>
                        <div class="overlay"> <br />
                            <p class="text-center">
                                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            </p>
                        </div>
                    </template> -->
                </div><!-- /.card-body -->
            </div><!-- /.card-->
        </div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection


@push('scripts')
<!-- Vue -->
<link href="https://unpkg.com/tabulator-tables@5.3.4/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.3.4/dist/js/tabulator.min.js"></script>
<script src="/vue/delivery/reporte.js"></script>
@endpush