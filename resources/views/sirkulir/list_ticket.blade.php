@extends('layout.main')
@section('judul')
@if (Route::current()->getName() == 'list-done')
    Dokumen Selesai Proses
@elseif(Route::current()->getName() == 'list-done-signed')
    Dokumen Selesai Sirkulir
@else
    Dokumen Proses Sirkulir
@endif
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #b30000">
                    <h3 class="card-title">List Dokumen Sirkulir</h3>
                </div>
                <div class="card-body">
                    @livewire('list-ticket')
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection
