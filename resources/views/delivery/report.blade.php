@extends('layouts.app')
@section('content')
<div id="reporte" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form method="POST" @submit.prevent="consultarReporte()">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> Start Date </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="date" style="border-width: 3px;" class="form-control form-control-sm" required v-model="busqueda.startdate" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> End Date </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="date" style="border-width: 3px;" class="form-control form-control-sm" required v-model="busqueda.enddate" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> E-Mail </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="mail" style="border-width: 3px;" class="form-control form-control-sm" v-model="busqueda.mail" aria-label="Username" aria-describedby="basic-addon1">
                                </div>

                            </div>
                            <div class="col-md-3">

                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> Shop Name </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="text" style="border-width: 3px;" class="form-control form-control-sm" v-model="busqueda.shop_name" aria-label="Username" aria-describedby="basic-addon1">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> Shop Address </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="text" style="border-width: 3px;" class="form-control form-control-sm" v-model="busqueda.shop_address" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> Driver Assigned </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="text" style="border-width: 3px;" class="form-control form-control-sm" v-model="busqueda.driver_assigned" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> Part Number </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="text" style="border-width: 3px;" class="form-control form-control-sm" v-model="busqueda.part_number" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> Payment Method </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <select class="form-control" v-model="busqueda.payment_method" v-model="searchFacility">
                                        <option value="1">Cash</option>
                                        <option value="2">Check</option>
                                        <option value="3">Credit Card</option>
                                        <option value="4">Charge Account</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> Returned </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <select class="form-control" v-model="busqueda.returned">
                                        <option value=0>No</option>
                                        <option value=1>Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div v-if="busqueda.returned == 1" class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> Parts Returned </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="number" style="border-width: 3px;" class="form-control form-control-sm" v-model="busqueda.parts_returned" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    <h3> Total </h3>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="number" style="border-width: 3px;" class="form-control form-control-sm" v-model="busqueda.total" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                    <div class="card-footer">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-lg btn-primary" style="margin-right: 5px;">
                                <i class="fas fa-search"></i>
                                <span>Search</span>
                            </button>
                        </div>

                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </form>
        </div>
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
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
                </div><!-- /.card-header -->
                <div class="card-body p-0">
                    <template v-if="!cargando">
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
                    </template>
                </div><!-- /.card-body -->
            </div><!-- /.card-->
        </div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection


@push('scripts')
<!-- Vue -->
<script src="/vue/delivery/reporte.js"></script>
@endpush