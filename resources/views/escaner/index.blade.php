@extends('layouts.app')

@section('content')
<div id="scanner" class="container-fluid">
    <template v-if="cargaScanner == 1">
        <div class="d-flex justify-content-center">
            <p class="text-center">
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><br>
                <span>Loading ...</span>
            </p>
        </div>
    </template>
    <template v-else>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Scanners</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="btn float-right btn-small btn-primary" v-on:click.prevent="createScanner()">
                            Create Scanner <i class="fas fa-plus"></i></a>
                        <br><br>
                        <div class="table-responsive-sm">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>State</th>
                                        <th>Facility</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="scanners">
                                        <tr v-for="scanner in scanners">
                                            <td>@{{ scanner.id }}</td>
                                            <td>@{{ scanner.description }}</td>
                                            <td v-if="scanner.status == 1">In Use</td>
                                            <td v-else>Available</td>
                                            <td>@{{ scanner.facility.name }}</td>
                                            <td v-if="scanner.active == 1">Active</td>
                                            <td v-else>Inactive</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info" v-on:click.prevent="editScanner(scanner)"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" v-on:click.prevent="removeScanner(scanner)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <td colspan="6">
                                            <p class="text-center">No records to show</p>
                                        </td>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--   <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                            {!! trans('concepto.most') !!} @{{ pagination.from }} {!! trans('concepto.al') !!}
                            @{{ pagination.to }} {!! trans('concepto.de') !!} @{{ pagination.total }} {!!
                            trans('concepto.elementos') !!}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers float-right" id="example2_paginate">
                            <ul class="pagination">
                                <li v-if="pagination.current_page > 1" class="paginate_button page-item previous" id="example2_previous">
                                    <a href="#" @click.prevent="changePage(pagination.current_page - 1)" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">
                                        {!! trans('concepto.ant') !!}
                                    </a>
                                </li>
                                <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']" class="paginate_button page-item">
                                    <a href="#" @click.prevent="changePage(page)" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">
                                        @{{ page }}
                                    </a>
                                </li>
                                <li v-if="pagination.current_page < pagination.last_page" class="paginate_button page-item next" id="example2_next">
                                    <a href="#" @click.prevent="changePage(pagination.current_page + 1)" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">
                                        {!! trans('concepto.sig') !!}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            @include('escaner.modal.editar')
            @include('escaner.modal.agregar')
            @include('escaner.modal.eliminar')
        </div>
    </template>
</div>


@stop


@push('scripts')

<!-- Vue Conceptos-->
<script src="/vue/scanner/scanner.js"></script>
<!-- Select2 -->


@endpush