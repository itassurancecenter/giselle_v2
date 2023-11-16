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
                {{-- <livewire:master-mitra> --}}
                <table id="example1" class="table table-responsive table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID Mitra</th>
                            <th style="width: 55%;">Nama Mitra</th>
                            <th style="width: 30%;">Ditambahkan</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_mitra as $dm)
                        <tr>
                            <td>{{ $dm->id_partner }}</td>
                            <td>{{ $dm->partner_name }}</td>
                            <td>{{ date('d F Y', strtotime($dm->last_update)) }}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-md">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@livewireScripts()
@endsection
