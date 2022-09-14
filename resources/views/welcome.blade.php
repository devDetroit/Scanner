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
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h1> <b>Empleado</b> </h1>
                                    </label>&nbsp; &nbsp; &nbsp;
                                    <i class="fa-solid fa-user fa-2xl"></i>
                                    <div class="input-group mb-3">
                                        <input type="text" style="border-width: 3px;" class="form-control form-control-lg" :disabled="empleadoCheck" required ref="search" v-model="busqueda.empleado"  aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                            </form>
                            <br><br>
                            <form method="POST" v-on:submit.prevent="GuardarScanner()">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">
                                        <h1><b>Escaner</b></h1>
                                    </label>&nbsp; &nbsp; &nbsp;
                                    <i class="fa-solid fa-barcode fa-2xl"></i>
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
</div>
@endsection

@push('scripts')
<script src="/vue/main.js"></script>
@endpush