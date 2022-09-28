@extends('layouts.app')
@section('title', 'Delivery Form')
@section('content')
<div id="dashboard" class="container-fluid">
    <div class="row">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow p-1 bg-body rounded">
                    <div class="card-header">
                        <h5 class="card-title">Report Records</h5>
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="initializeTable()" class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-12">
                                <label class="visually-hidden" for="inlineFormInputGroupUsername">From:</label>
                                <div class="input-group">
                                    <div class="input-group-text">From</div>
                                    <input type="date" v-model="busqueda.startdate" class="form-control" id="inlineFormInputGroupUsername" placeholder="from date">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="visually-hidden" for="inlineFormInputGroupUsername">To:</label>
                                <div class="input-group">
                                    <div class="input-group-text">To</div>
                                    <input type="date" v-model="busqueda.enddate" class="form-control" id="inlineFormInputGroupUsername" placeholder="to date">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="visually-hidden" for="inlineFormInputGroupUsername">To:</label>
                                <div class="input-group">
                                    <div class="input-group-text">Returned </div>
                                    <select name="cSucursalIdioma" v-model="busqueda.returned" class="form-control">
                                        <option value=1>YES</option>
                                        <option value=0>NO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card-->
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow p-1 mt-3 bg-body rounded">
                    <div class="card-header">
                        <h5 class="card-title">Records Table</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="fw-bold">PAYMENT METHOD</th>
                                    <th class="fw-bold">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="total">
                                    <tr>
                                        <td>CASH</td>
                                        <td>@{{ total['CASH'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>CHECK</td>
                                        <td>@{{ total['CHECK'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>CREDIT CARD</td>
                                        <td>@{{ total['CREDIT CARD'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>CHARGE ACCOUNT</td>
                                        <td>@{{ total['CHARGE ACCOUNT'] }}</td>
                                    </tr>
                                    <tr>
                                        <td> <strong>TOTAL</strong> </td>
                                        <td> <strong>@{{ total['CHARGE ACCOUNT'] + total['CREDIT CARD'] + total['CHECK'] + total['CASH'] }}</strong> </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card shadow p-1 mt-3 bg-body rounded">
                    <div class="card-header">
                        <h5>Pie Chart</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Vue Conceptos-->
<script src="/vue/delivery/dashboard.js"></script>
<!-- Select2 -->
@endpush