@extends('layouts.app')
@section('title', 'Delivery Form')
@section('content')
<div id="delivery" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow p-1 bg-body rounded">
                <div class="card-body">
                    <h5 class="card-title text-center">Submit Cupon</h5>
                    <form method="POST" v-on:submit.prevent="guardar()">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 border-end">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        Shop Name <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required v-model="delivery.shop_name" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        Shop Address <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required v-model="delivery.shop_address" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        Driver Assigned
                                    </label>
                                    <input type="text" class="form-control" v-model="delivery.driver_assigned" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        Total Paid <span class="text-danger"> * </span>
                                    </label>
                                    <input type="number" class="form-control" required v-model="delivery.total" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        Part Number Delivered <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required v-model="delivery.part_number" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        Payment Method <span class="text-danger"> * </span>
                                    </label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="1" v-model="delivery.payment_method" v-model="picked" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Cash
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="2" v-model="delivery.payment_method" v-model="picked" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Check
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="3" v-model="delivery.payment_method" v-model="picked" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Credit Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="4" v-model="delivery.payment_method" v-model="picked" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Charge Account
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        Return
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault2" value="0" v-model="delivery.returned" v-model="picked" id="return">
                                        <label class="form-check-label" for="return">
                                            No
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault2" value="1" v-model="delivery.returned" v-model="picked" id="return2" checked>
                                        <label class="form-check-label" for="return2">
                                            Si
                                        </label>
                                    </div>
                                </div>
                                <div v-if="delivery.returned == 1" class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        Parts Returned
                                    </label>
                                    <textarea class="form-control" required v-model="delivery.parts_returned" aria-label="Username" aria-describedby="basic-addon1">
                                        </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-warning">New</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <p class="text-danger"><small> * Required Fields</small></p>
            </div>
        </div>
        <div class="col-md-10 mt-3">
            <div class="card shadow p-1 bg-body rounded">
                <div class="card-header">
                    <h5 class="card-title text-center">Last Records</h5>
                </div>
                <div class="card-body">
                    <div id="records-table"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<link href="https://unpkg.com/tabulator-tables@5.3.4/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.3.4/dist/js/tabulator.min.js"></script>
<!-- Vue Conceptos-->
<script src="/vue/delivery/delivery.js"></script>
<!-- Select2 -->
@endpush