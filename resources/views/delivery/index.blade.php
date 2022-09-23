@extends('layouts.app')

@section('content')
<div id="delivery" class="container-fluid">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-md-8 mx-auto">
                <div class="jumbotron">
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <form method="POST" v-on:submit.prevent="Guardar()">
                                @csrf
                                <div class="col-md-6">

                                    <label for="exampleInputEmail1" class="form-label">
                                        <h3> E-Mail </h3>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="mail" style="border-width: 3px;" class="form-control form-control-lg" required v-model="delivery.mail" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <label for="exampleInputEmail1" class="form-label">
                                        <h3> Shop Name </h3>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" style="border-width: 3px;" class="form-control form-control-lg" required v-model="delivery.shop_name" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h3> Shop Address </h3>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" style="border-width: 3px;" class="form-control form-control-lg" required v-model="delivery.shop_address" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h3> Driver Assigned </h3>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" style="border-width: 3px;" class="form-control form-control-lg" required v-model="delivery.driver_assigned" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h3> Part Number </h3>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" style="border-width: 3px;" class="form-control form-control-lg" required v-model="delivery.part_number" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h3> Payment Method </h3>
                                    </label>
                                    <div class="input-group mb-3">
                                        <select class="form-control" v-model="delivery.payment_method" v-model="searchFacility">
                                            <option value="1">Cash</option>
                                            <option value="2">Check</option>
                                            <option value="3">Credit Card</option>
                                            <option value="4">Charge Account</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h3> Returned </h3>
                                    </label>
                                    <div class="input-group mb-3">
                                        <select class="form-control" v-model="delivery.returned">
                                            <option value=0>No</option>
                                            <option value=1>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-if="delivery.returned == 1" class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h3> Parts Returned </h3>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="number" style="border-width: 3px;" class="form-control form-control-lg" required v-model="delivery.parts_returned" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h3> Total </h3>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="number" style="border-width: 3px;" class="form-control form-control-lg" required v-model="delivery.total" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop


@push('scripts')

<!-- Vue Conceptos-->
<script src="/vue/delivery/delivery.js"></script>
<!-- Select2 -->


@endpush