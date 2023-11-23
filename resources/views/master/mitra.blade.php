@extends('layout.main')
@section('judul')
Data Mitra
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Mitra</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dt-buttons btn-group flex-wrap"> <button
                                class="btn btn-secondary buttons-copy buttons-html5" tabindex="0"
                                aria-controls="example1" type="button"><span>Copy</span></button> <button
                                class="btn btn-secondary buttons-csv buttons-html5" tabindex="0"
                                aria-controls="example1" type="button"><span>CSV</span></button> <button
                                class="btn btn-secondary buttons-excel buttons-html5" tabindex="0"
                                aria-controls="example1" type="button"><span>Excel</span></button> <button
                                class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0"
                                aria-controls="example1" type="button"><span>PDF</span></button> <button
                                class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1"
                                type="button"><span>Print</span></button>
                            <div class="btn-group"><button
                                    class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis"
                                    tabindex="0" aria-controls="example1" type="button"
                                    aria-haspopup="true"><span>Column visibility</span><span
                                        class="dt-down-arrow"></span></button></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="example1_filter" class="float-right">
                            <label>Search:<input type="text" wire:model="search" aria-label="search"
                                    class="form-control form-control-sm" placeholder="Cari Data"
                                    aria-controls="example1"></label>
                        </div>
                    </div>
                </div>
                <livewire:master-mitra>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

@livewireScripts()
@endsection
