@extends('layout.main')
@section('judul')
@if(Route::current()->getName() == 'tambah-dokumen')
Tambah Dokumen
@elseif(Route::current()->getName() == 'detail-tiket')
Detail Tiket {{ $ticket->TicketID }}
@endif
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #b30000">
                    <h3 class="card-title">Detail Tiket</h3>
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
                        <input type="text" class="form-control"
                            value="{{ date('d M Y', strtotime($ticket->SubmitDate)) }}" readonly>
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
                                @if(Route::current()->getName() == 'tambah-dokumen')
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-doc">
                                    <i class="nav-icon fas fa-plus-circle"></i> Tambah Dokumen
                                </button>
                                @endif
                            </div>
                            <div class="modal fade" id="modal-doc">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('store-dokumen', $id_ticket) }}" action="GET" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Dokumen
                                                    <strong>{{ $ticket->TicketID }}</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Jenis Dokumen</label>
                                                    <select class="form-control select2bs4" style="width: 100%;"
                                                        name="document_type" id="document_type">
                                                        <option selected="selected">Pilih Jenis Dokumen</option>
                                                        @foreach ($jenis_dokumen as $jd)
                                                        <option value="{{ $jd->KodeDokumen }}">{{ $jd->JenisDokumen }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div id="showBapl" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="">No Penagihan</label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="document_parent_bapl">
                                                            <option >Pilih NO KL - Periode Penagihan
                                                            </option>
                                                            @foreach ($penagihan as $p)
                                                            <option value="{{ $p->NO_PENAGIHAN }}">
                                                                {{ $p->NO_PENAGIHAN }} ({{ $p->NO_KL }} -
                                                                {{ $p->PERIODE_DESC }}) </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="showBapla" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="">No KL Perpanjangan</label>
                                                        <input type="text" style="text-transform: uppercase;"
                                                            class="form-control"
                                                            placeholder="Masukkan Nomor KL Perpanjangan"
                                                            name="document_parent_bapla" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Penandatangan</label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="sign_by_bapla">
                                                            <option >Pilih Penandatangan</option>
                                                            @foreach ($sign as $s)
                                                            <option value="{{ $s->sign_id }}">{{ $s->sign_by }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="showBakBapl" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="">Nomor KL</label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="document_parent_bak_bapl" id="kl-select">
                                                            <option value="selected">Pilih Nomor KL</option>
                                                            @foreach ($kl as $kl)
                                                            <option value="{{ $kl->NO_KL }}">{{ $kl->NO_KL }} </option>
                                                            @endforeach
                                                        </select>
                                                        <small style="color: red">Isikan kolom berikut jika tidak terdapat nomor KL dipilihan</small>
                                                        <input class="form-control" type="text" name="document_parent_bak_bapl" id="kl-text" placeholder="Masukan Nomor KL disini dengan lengkap">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Status SID</label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="status_sid">
                                                            <option >Pilih Status</option>
                                                            <option value="fbc">Sudah FBC</option>
                                                            <option value="not-fbc">Belum FBC</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Penandatangan</label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="sign_by_bak_bapl">
                                                            <option>Pilih Penandatangan</option>
                                                            @foreach ($sign as $s)
                                                            <option value="{{ $s->sign_id }}">{{ $s->sign_by }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="showBakBapla" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="">Nomor KL Perpanjangan</label>
                                                        <input type="text" style="text-transform: uppercase;"
                                                            class="form-control"
                                                            placeholder="Masukkan Nomor KL Perpanjangan"
                                                            name="document_parent_bak_bapla" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Penandatangan</label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="sign_by_bak_bapla">
                                                            <option >Pilih Penandatangan</option>
                                                            @foreach ($sign as $s)
                                                            <option value="{{ $s->sign_id }}">{{ $s->sign_by }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="showBaRekon" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="">Nomor KL/KB</label>
                                                        <input type="text" style="text-transform: uppercase;"
                                                            class="form-control" placeholder="Masukkan Nomor KL/KB"
                                                            name="document_parent_rekon" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Penandatangan</label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="sign_by_rekon">
                                                            <option >Pilih Penandatangan</option>
                                                            @foreach ($sign as $s)
                                                            <option value="{{ $s->sign_id }}">{{ $s->sign_by }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                    {{-- <livewire:list-dokumen> --}}
                    @livewire('list-dokumen', ['id_ticket' => $id_ticket])
                </div>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
@livewireScripts()
<script>
   $(document).ready(function () {
        $("#kl-select").change(function () {

            var selectedOption = $(this).val();

            if (selectedOption !== "selected") {
                $("#kl-text").prop("disabled", true).val('');
            } else {
                $("#kl-text").prop("disabled", false);
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#document_type").on("change", function () {
            var selectedValue = $(this).val();


            if (selectedValue === "BAK-BAPL") {
                $("#showBakBapl").show();
            } else {
                $("#showBakBapl").hide();
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        $("#document_type").on("change", function () {

            var selectedValue = $(this).val();


            if (selectedValue === "BAK-BAPLA") {
                $("#showBakBapla").show();
            } else {
                $("#showBakBapla").hide();
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        $("#document_type").on("change", function () {

            var selectedValue = $(this).val();


            if (selectedValue === "BAPLA") {
                $("#showBapla").show();
            } else {
                $("#showBapla").hide();
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        $("#document_type").on("change", function () {

            var selectedValue = $(this).val();


            if (selectedValue === "BA-REKON") {
                $("#showBaRekon").show();
            } else {
                $("#showBaRekon").hide();
            }
        });
    });

</script>
@endsection
