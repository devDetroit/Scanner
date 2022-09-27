@extends('layouts.app')
@section('title', 'Delivery Report')
@section('content')
<div id="reporte" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow p-1 bg-body rounded">
                <div class="card-body">
                    <h5 class="card-title">Report Records</h5>
                    <form v-on:submit.prevent="initializeTable()" class="row row-cols-lg-auto g-3 align-items-center mt-2">
                        <div class="col-12">
                            <label class="visually-hidden" for="inlineFormInputGroupUsername">From:</label>
                            <div class="input-group">
                                <div class="input-group-text">@</div>
                                <input type="date" v-model="busqueda.startdate" class="form-control" id="inlineFormInputGroupUsername" placeholder="from date">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="visually-hidden" for="inlineFormInputGroupUsername">To:</label>
                            <div class="input-group">
                                <div class="input-group-text">@</div>
                                <input type="date" v-model="busqueda.enddate" class="form-control" id="inlineFormInputGroupUsername" placeholder="to date">
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <button type="button" v-on:click="downloadExcel" class="btn btn-warning">Download .CSV</button>
                        </div>
                    </form>
                    <div id="records-table"></div>
                </div><!-- /.card-body -->
            </div><!-- /.card-->
        </div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection


@push('scripts')
<!-- Vue -->
<link href="https://unpkg.com/tabulator-tables@5.3.4/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.3.4/dist/js/tabulator.min.js"></script>
<script src="/vue/delivery/reporte.js"></script>
@endpush