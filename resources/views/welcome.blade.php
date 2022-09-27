@extends('layouts.app')
@section('title', 'Device Control')
@section('content')
<style>
    body {
        background-color: #e7e0de;
    }
</style>

<div id="main" class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-3 bg-body rounded">
                <div class="card-body">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">
                            <h1><i class="fa-solid fa-user"></i> EMPLOYEE </h1>
                        </label>
                        <div class="input-group mb-3">
                            <input id="employee" type="text" style="border-width: 3px;" class="form-control form-control-lg" v-on:keyup.enter="focusInput" required v-model="busqueda.empleado">
                        </div>
                    </div>
                    <div class="mb-3" style="margin-top: 100px;">
                        <label for="exampleInputPassword1" class="form-label">
                            <h1><i class="fa-solid fa-barcode"></i> SCANNER</h1>
                        </label>
                        <input id="scanner" type="text" style="border-width: 3px;" class="form-control form-control-lg" required v-on:keyup.enter="focusInput" v-model="busqueda.scanner">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow bg-body rounded">
                <div class="card-body">
                    <h5 class="card-title">Tracking</h5>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="fw-bold">Scanner</th>
                                <th class="fw-bold">User</th>
                                <th class="fw-bold">Start</th>
                                <th class="fw-bold">End</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="historial.length > 0">
                                <tr v-for="hist in historial">
                                    <td>@{{ hist.scanner.description }}</td>
                                    <td>@{{ hist.user }}</td>
                                    <td>@{{ hist.start }}</td>
                                    <td>@{{ hist.end }}</td>
                                </tr>
                            </template>
                            <template v-else>
                                <td colspan="6">
                                    <p class="text-center">No existen registros</p>
                                </td>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="/vue/main.js"></script>
@endpush