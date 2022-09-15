@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #e7e0de;
    }
</style>

<div id="main">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-md-8 mx-auto">
                <div class="jumbotron">
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <form method="POST" v-on:submit.prevent="GuardarEmpleado()">
                                @csrf
                                <div class="mb-3">
                                    <i class="fa-solid fa-user fa-2xl"></i>&nbsp; &nbsp; &nbsp;
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h1> <b>Empleado</b> </h1>
                                    </label>

                                    <div class="input-group mb-3">
                                        <input type="text" style="border-width: 3px;" class="form-control form-control-lg" :disabled="empleadoCheck" required ref="search" v-model="busqueda.empleado" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                            </form>
                            <br><br>
                            <form method="POST" v-on:submit.prevent="GuardarScanner()">
                                <div class="mb-3">
                                    <i class="fa-solid fa-barcode fa-2xl"></i>
                                    &nbsp; &nbsp; &nbsp;
                                    <label for="exampleInputPassword1" class="form-label">
                                        <h1><b>Escaner</b></h1>
                                    </label>

                                    <input type="text" style="border-width: 3px;" ref="scanner" class="form-control form-control-lg" required ref="scanner" v-model="busqueda.scanner">
                                </div>
                                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-2 bg-body rounded">
                <div class="card-body">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="fw-bold">Scanner</th>
                                <th class="fw-bold">Start</th>
                                <th class="fw-bold">End</th>
                                <th class="fw-bold">User</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            <template v-if="historial.length > 0">
                                <tr v-for="hist in historial">
                                    <td>@{{ hist.scanner.description }}</td>
                                    <td>@{{ hist.start }}</td>
                                    <td>@{{ hist.end }}</td>
                                    <td>@{{ hist.user }}</td>
                                </tr>
                            </template>
                            <template v-else>
                                <td colspan="6">
                                    <p class="text-center">No existen registros</p>
                                </td>
                            </template>
                        </tbody>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/vue/main.js"></script>
@endpush