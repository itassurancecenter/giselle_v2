<form action="{{ route('bulk-update-status') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        @if (Route::current()->getName() == 'detail-tiket')
        <div class="col-12 text-right">
            <button type="submit" class="btn btn-md btn-info mb-2" style="position: right">Update Status</button>
        </div>
        @endif
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="select-all-checkbox"></th>
                        <th>ID Dokumen</th>
                        <th>Nomor Induk Dokumen</th>
                        <th>Jenis Dokumen</th>
                        <th>Penandatangan</th>
                        <th>Progress Sirkulir</th>
                        <th>Status Dokumen</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($document as $d)
                    <tr>
                        <td><input type="checkbox" name="selected_document[]" value="{{ $d->id }}"></td>
                        <td>{{ $d->DocumentID }}</td>
                        @if ($d->DocumentType == 'BAK-BAPLA' || $d->DocumentType == 'BAPLA')
                        <td><strong>Nomor KL Perpanjangan : </strong> {{ $d->DocumentDescParent }}</td>
                        @elseif ($d->DocumentType == 'BAK-BAPL')
                        <td><strong>Nomor KL : </strong> {{ $d->DocumentDescParent }}</td>
                        @elseif ($d->DocumentType == 'BAPL')
                        <td>
                            <strong>Nomor Penagihan : </strong> {{ $d->DocumentDescParent }} <br>
                            <strong>Nomor KL - Periode Penagihan : </strong> {{ $d->DocumentDescChild }}
                        </td>
                        @else
                        <td><strong>Nomor Induk Dokumen : </strong> {{ $d->DocumentDescParent }}</td>
                        @endif
                        <td>{{ $d->jenis_dokumen->JenisDokumen }} - <strong>{{ $d->sign->sign_by }}</strong></td>
                        <td>{{ $d->sign->sign_by }}</td>
                        <td>
                            <div class="progress progress-sm">
                                @if ($d->SignBy == '10')
                                @if ($d->DocumentStatus > 7)
                                <div class="progress-bar progress-bar-danger" style="width: 100%" aria-valuenow="100%"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                                @else
                                <div class="progress-bar progress-bar-danger"
                                    style="width: {{ $d->DocumentStatus/7*100 }}%"
                                    aria-valuenow="{{ $d->DocumentStatus/7*100 }}%" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                                @endif
                                @else
                                @if ($d->DocumentStatus > 2)
                                <div class="progress-bar progress-bar-danger" style="width: 100%" aria-valuenow="100%"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                                @else
                                <div class="progress-bar progress-bar-danger"
                                    style="width: {{ $d->DocumentStatus/2*100 }}%"
                                    aria-valuenow="{{ $d->DocumentStatus/3*100 }}%" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                                @endif
                                @endif
                            </div>
                            @if ($d->SignBy == '10')
                            @if ($d->DocumentStatus > 7)
                            <small>100%</small>
                            @else
                            <small>{{ intval($d->DocumentStatus/7*100) }}%</small>
                            @endif
                            @else
                            @if ($d->DocumentStatus > 2)
                            <small>100%</small>
                            @else
                            <small>{{ $d->DocumentStatus/2*100 }}%</small>
                            @endif
                            @endif
                        </td>
                        <td><span class="{{ $d->status->label_class }}">{{ $d->status->status }}</span></td>

                        <td>
                            <a class="btn btn-sm btn-info btn-block" data-toggle="modal"
                                data-target="#modal-{{ $d->id }}" style="color: white">Histori
                                Dokumen</a>
                            @if(Route::current()->getName() == 'tambah-dokumen')
                            <a class="btn btn-sm btn-danger btn-block" style="color: white">Hapus Dokumen</a>
                            @endif
                            @if(Route::current()->getName() == 'detail-tiket')
                            @if ($d->DocumentStatus != '2' && $d->DocumentStatus != '7' && $d->DocumentStatus != '10' && $d->DocumentStatus != '13' && $d->DocumentStatus != '14' &&
                            $d->DocumentStatus != '15' && $d->DocumentStatus != '16' && $d->DocumentStatus != '17')
                            <a href="{{ route('update-status', $d->id) }}" class="btn btn-sm btn-info btn-block"
                                style="color: white">Update
                                Status</a>
                            @endif
                            @if ($d->DocumentStatus == '2' || $d->DocumentStatus == '7' || $d->DocumentStatus == '10' || $d->DocumentStatus == '13')
                            <a class="btn btn-sm btn-info btn-block" data-toggle="modal"
                                data-target="#takeout-{{ $d->id }}" style="color: white">Ambil Dokumen</a>
                            @endif
                            @if ($d->DocumentStatus == '2' || $d->DocumentStatus == '7' || $d->DocumentStatus == '10' || $d->DocumentStatus == '13' || $d->DocumentStatus == '16' || $d->DocumentStatus == '17')
                            <a class="btn btn-sm btn-info btn-block" data-toggle="modal"
                                data-target="#upload-{{ $d->id }}" style="color: white">Upload Dokumen Selesai</a>
                            @endif
                            @if ($d->file != NULL)
                            <a href="{{ asset('storage/'. $d->file->DocumentPath) }}"
                                class="btn btn-sm btn-info btn-block" data-toggle="modal"
                                data-target="#prevdoc-{{ $d->id }}" style="color: white">Preview Dokumen</a>
                            @endif
                            @if ($d->DocumentStatus == '14' && $d->DocumentStatus != '15' && $d->DocumentStatus != '16')
                            <button class="btn btn-sm btn-info btn-block dropdown-toggle dropdown-icon"
                                data-toggle="dropdown"">
                                Verifikasi Dokumen
                            </button>
                            @endif
                            <div class=" dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#accept-{{ $d->id }}">Terima Dokumen</button>
                            <a class="dropdown-item" href="#" data-toggle="modal"
                                data-target="#return-{{ $d->id }}">Tolak Dokumen</a>
                            </div>
                            @endif
                        </td>
                        <div class="modal fade" id="takeout-{{ $d->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ambil Dokumen {{ $d->DocumentDescParent }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('dokumen.takeout', $d->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Masukkan Nama PIC</label>
                                                <input type="text" name="pic" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="prevdoc-{{ $d->id }}">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Preview Dokumen {{ $d->DocumentID }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($d->file != NULL)
                                        <div class="card">
                                            <div class="card-header">
                                                <h6><strong>Preview Dokumen Signed</strong></h6>
                                            </div>
                                            <div class="card-body">
                                                {{-- <i class="fas fa-file-pdf"></i> <strong>Dokumen {{ $d->DocumentDescParent }}</strong>
                                                <br><a href="{{ asset('storage/'. $d->file->DocumentPath) }}" target="_blank">Lihat
                                                    File</a> --}}
                                                <iframe src="{{ asset('storage/'. $d->file->DocumentPath) }}" width="100%"
                                                    height="500px" frameborder="0"></iframe>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <div class="modal fade" id="return-{{ $d->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tolak Dokumen {{ $d->DocumentID }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($d->file != NULL)
                                        <div class="card">
                                            <div class="card-header">
                                                <h6><strong>Preview Dokumen Signed</strong></h6>
                                            </div>
                                            <div class="card-body">
                                                <i class="fas fa-file-pdf"></i> <strong>Dokumen
                                                    {{ $d->DocumentDescParent }}</strong>
                                                <br><a href="{{ asset('storage/'. $d->file->DocumentPath) }}" target="_blank">Lihat
                                                    File</a>
                                            </div>
                                        </div>
                                        @endif
                                        <form action="{{ route('dokumen.tolak', $d->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Masukkan Komentar</label>
                                                <input type="text" name="komentar" class="form-control">
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <div class="modal fade" id="accept-{{ $d->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Terima Dokumen {{ $d->DocumentID }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($d->file != NULL)
                                        <div class="card">
                                            <div class="card-header">
                                                <h6><strong>Preview Dokumen Signed</strong></h6>
                                            </div>
                                            <div class="card-body">
                                                <i class="fas fa-file-pdf"></i> <strong>Dokumen {{ $d->DocumentDescParent }}</strong>
                                                <br><a href="{{ asset('storage/'. $d->file->DocumentPath) }}" target="_blank">Lihat
                                                    File</a>
                                            </div>
                                        </div>
                                        @endif
                                        <form action="{{ route('dokumen.terima', $d->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Masukkan Komentar</label>
                                                <input type="text" name="komentar" class="form-control">
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="upload-{{ $d->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('dokumen.uploadFile', $d->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Upload Evidence Dokumen {{ $d->DocumentID }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="file" name="file" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="modal-{{ $d->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Histori Dokumen {{ $d->DocumentID }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <!-- Timelime example  -->
                                            <div class="row">
                                                @if($d->log != NULL)
                                                <div class="col-md-12">
                                                    <!-- The time line -->

                                                    <div class="timeline">
                                                        <!-- timeline time label -->
                                                        @foreach ($d->log as $l)
                                                        <div class="time-label">
                                                            <span class="bg-red">{{ date('d F Y', strtotime($l->created_at)) }}</span>
                                                        </div>
                                                        <!-- /.timeline-label -->
                                                        <!-- timeline item -->

                                                        <div>
                                                            <i class="fas fa-envelope bg-blue"></i>
                                                            <div class="timeline-item">
                                                                <span class="time"><i class="fas fa-clock"></i>
                                                                    {{ date('H:m', strtotime($l->created_at->addHours(7))) }}</span>
                                                                <h3 class="timeline-header"><a href="#">{{ $l->status }} -
                                                                        <strong>PIC : </strong> {{ $l->UpdatedBy }}</a></h3>

                                                                <div class="timeline-body">
                                                                    {{ $l->LogDesc }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        <!-- END timeline item -->
                                                        <div>
                                                            <i class="fas fa-clock bg-gray"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="col-md-12">
                                                    <h5><strong style="color: red;">Belum ada histori dokumen!</strong></h5>
                                                </div>
                                                @endif
                                                <!-- /.col -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>
<script>
    $("#select-all-checkbox").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
