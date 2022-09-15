@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #e7e0de;
    }
</style>
<div id="listado">
    <div class="row">
        <div class="d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card shadow mb-2 bg-body rounded">
                    <div class="card-body">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="fw-bold">Available</th>
                                    <th class="fw-bold">In use</th>
                                    <th class="fw-bold">Inactive</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">@{{ disponible }}</td>
                                    <td class="fw-bold">@{{ enuso }}</td>
                                    <td class="fw-bold">@{{ inactive }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-header">
                        <h3 class="text-center">Device Control</h3>
                        <h6 class="text-end">Last Update: @{{ horaactual }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Device Name</th>
                                        <th>Status</th>
                                        <th>
                                            <select name="Pais" class="form-control" v-on:change="getScanners" v-model="searchFacility">
                                                <option value="">All</option>
                                                <option v-for="facility in facilitiesporpermiso" :value="facility.id">
                                                    @{{ facility.name }}
                                                </option>
                                            </select>
                                        </th>
                                        <th>State</th>
                                        <th>Current User</th>
                                        <th>Last Time Picked</th>
                                        <th>Last Time Returned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="scanners.length > 0">
                                        <tr v-for="scanner in scanners">
                                            <td>@{{ scanner.id }}</td>
                                            <td>@{{ scanner.description  }}</td>
                                            <td :class="scanner.active ? 'bg-success fw-bold' : 'bg-danger fw-bold'" v-if="scanner.active == 0">Inactive</td>
                                            <td :class="scanner.active ? 'bg-success fw-bold' : 'bg-danger fw-bold'" v-else>Active</td>
                                            <td>@{{ scanner.facility.name  }}</td>
                                            <td :class="scanner.status ? 'bg-danger fw-bold' : 'bg-success fw-bold'" v-if="scanner.status == 0">Avaiable</td>
                                            <td :class="scanner.status ? 'bg-danger fw-bold' : 'bg-success fw-bold'" v-else>In use</td>
                                            <td v-if="scanner.status == 0">N/A</td>
                                            <td v-else-if="scanner.ultimoregistro">@{{ scanner.ultimoregistro.user }}</td>
                                            <td v-if="scanner.ultimoregistro">@{{ scanner.ultimoregistro.start }}</td>
                                            <td v-else></td>
                                            <td v-if="scanner.ultimoregistro">@{{ scanner.ultimoregistro.end }}</td>
                                            <td v-else></td>
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

    </div>
</div>
@endsection


@push('scripts')
<script src="/vue/listado.js"></script>
@endpush