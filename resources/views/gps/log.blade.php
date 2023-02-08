@extends('layouts.app')
@section('title', 'Scanners log')
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
                    <div class="card-header">
                        <h3>Scanner Movement </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="fw-bold">
                                        <input type="text" class="form-control" v-on:change="getScanners" v-model="busqueda.facility" placeholder="Facility ...">
                                    </th>
                                    <th class="fw-bold">
                                        <input type="text" class="form-control" v-on:change="getScanners" v-model="busqueda.scanner" placeholder="Scanner ...">
                                    </th>
                                    <th class="fw-bold">
                                        <input type="date" class="form-control" v-on:change="getScanners" v-model="busqueda.start" placeholder="Start Date ...">
                                    </th>
                                    <th class="fw-bold">
                                        <input type="date" class="form-control" v-on:change="getScanners" v-model="busqueda.end" placeholder="End Date ...">
                                    </th>
                                    <th class="fw-bold"><input type="text" class="form-control" v-on:change="getScanners" v-model="busqueda.user" placeholder="User ..."></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="registro in log">
                                    <td>@{{ registro.scanner.facility.name }}</td>
                                    <td>@{{ registro.scanner.readdescription }}</td>
                                    <td>@{{ registro.start }}</td>
                                    <td>@{{ registro.end }}</td>
                                    <td>@{{ registro.user }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                    Showing @{{ pagination.from }} to
                                    @{{ pagination.to }} from @{{ pagination.total }} elements
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers float-right" id="example2_paginate">
                                    <ul class="pagination">
                                        <li v-if="pagination.current_page > 1" class="paginate_button page-item previous" id="example2_previous">
                                            <a href="#" @click.prevent="changePage(pagination.current_page - 1)" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">
                                                Previous
                                            </a>
                                        </li>
                                        <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']" class="paginate_button page-item">
                                            <a href="#" @click.prevent="changePage(page)" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">
                                                @{{ page }}
                                            </a>
                                        </li>
                                        <li v-if="pagination.current_page < pagination.last_page" class="paginate_button page-item next" id="example2_next">
                                            <a href="#" @click.prevent="changePage(pagination.current_page + 1)" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">
                                                Next
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@push('scripts')
<script src="/vue/gps/log.js"></script>
@endpush