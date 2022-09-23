@extends('layouts.app')

@section('content')
<div id="delivery" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow p-1 bg-body rounded">
                <div class="card-body">
                    <h5 class="card-title text-center">Submit Cupon</h5>
                    <form method="POST" v-on:submit.prevent="Guardar()">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                E-Mail
                            </label>
                            <input type="mail" class="form-control" required v-model="delivery.mail" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Shop Name
                            </label>
                            <input type="text" class="form-control" required v-model="delivery.shop_name" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Shop Address
                            </label>

                            <input type="text" class="form-control" required v-model="delivery.shop_address" aria-label="Username" aria-describedby="basic-addon1">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Driver Assigned
                            </label>
                            <input type="text" class="form-control" required v-model="delivery.driver_assigned" aria-label="Username" aria-describedby="basic-addon1">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Part Number
                            </label>
                            <input type="text" class="form-control" required v-model="delivery.part_number" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Payment Method
                            </label>
                            <select class="form-control" v-model="delivery.payment_method" v-model="searchFacility">
                                <option value="1">Cash</option>
                                <option value="2">Check</option>
                                <option value="3">Credit Card</option>
                                <option value="4">Charge Account</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Returned
                            </label>
                            <select class="form-control" v-model="delivery.returned">
                                <option value=0>No</option>
                                <option value=1>Yes</option>
                            </select>
                        </div>
                        <div v-if="delivery.returned == 1" class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Parts Returned
                            </label>
                            <input type="number" class="form-control" required v-model="delivery.parts_returned" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Total
                            </label>
                            <input type="number" class="form-control" required v-model="delivery.total" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-warning">New</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow p-1 bg-body rounded">
                <div class="card-body">
                    <h5 class="card-title text-center">Last Records</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')

<!-- Vue Conceptos-->
<script src="/vue/delivery/delivery.js"></script>
<!-- Select2 -->


@endpush