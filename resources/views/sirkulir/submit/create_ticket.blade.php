@extends('layout.main')
@section('judul')
Submit Dokumen
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #b30000">
                    <h3 class="card-title">Buat Tiket</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('create-tiket') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Mitra</label>
                            {{-- <input type="text" class="form-control" value="PT INFOMEDIA NUSANTARA" disabled> --}}
                            <select class="form-control select2bs4" style="width: 100%;" name="partner_id">
                                <option selected="selected">Pilih Nama Mitra</option>
                                @foreach ($partner as $p)
                                <option value="{{ $p->id_partner }}">{{ $p->partner_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal Submit</label>
                            <input type="text" class="form-control" name="submit_date"
                                value="{{ date('Y-m-d', strtotime($currentDate)) }}" readonly>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">PIC Submit Mitra</label>
                            <input type="text" class="form-control" name="pic_drop"
                                placeholder="Masukkan Nama PIC Saat Submit Dokumen">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger btn-md">Buat Tiket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection
