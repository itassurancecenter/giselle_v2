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
          <livewire:master-user>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  @livewireScripts()
@endsection
