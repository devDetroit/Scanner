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
                                E-Mail <span class="text-danger"> * </span>
                            </label>
                            <input type="mail" class="form-control" required v-model="delivery.mail" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
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
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Total Paid <span class="text-danger"> * </span>
                            </label>
                            <input type="number" class="form-control" required v-model="delivery.total" aria-label="Username" aria-describedby="basic-addon1">
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
        <div class="col-md-6">
            <div class="card shadow p-1 bg-body rounded">
                <div class="card-header">
                    <h5 class="card-title text-center">Last Records</h5>
                </div>
                <div class="card-body">
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
                                <template v-if="latest.length > 0">
                                    <template v-for="delivery in latest">
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