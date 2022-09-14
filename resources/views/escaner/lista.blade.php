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
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-header text-center">
                        <h3>Device Control</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Device Name</th>
                                    <th>
                                        <select name="Pais" class="form-control" v-on:change="getScanners" v-model="searchFacility">
                                            <option value="">All</option>
                                            <option v-for="facility in facilitiesporpermiso" :value="facility.id">
                                                @{{ facility.name }}
                                            </option>
                                        </select>
                                    </th>
                                    <th>Estatus</th>
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
@endsection


@push('scripts')
<script src="/vue/listado.js"></script>
@endpush