@extends('layout.main')
@section('judul')
Tambah Dokumen
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #b30000">
                    <h3 class="card-title">Tambah Dokumen</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Tiket</label>
                        <input type="text" class="form-control" value="{{ $ticket->TicketID }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Mitra</label>
                        <input type="text" class="form-control" value="{{ $ticket->partner->partner_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal Submit</label>
                        <input type="text" class="form-control" value="{{ date('d M Y', strtotime($ticket->SubmitDate)) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">PIC Submit Mitra</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama PIC Saat Submit Dokumen"
                            value="{{ $ticket->PicDrop }}" readonly>
                    </div>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header" style="background-color: #b30000">
                    <h3 class="card-title">List Dokumen</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="float-right">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-doc">
                                    <i class="nav-icon fas fa-plus-circle"></i> Tambah Dokumen
                                  </button>
                            </div>
                            <div class="modal fade" id="modal-doc">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Tambah Dokumen <strong>{{ $ticket->TicketID }}</strong></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" action="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="">Jenis Dokumen</label>
                                                <input type="text" class="form-control" name="" id="">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Tambah</button>
                                    </div>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                        </div>
                    </div>
                    <livewire:list-dokumen>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
@livewireScripts()
@endsection
