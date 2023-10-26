<div class="row mt-3">
    <div class="col-12">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox" name="" id=""></th>
                    <th>ID Dokumen</th>
                    <th>Jenis Dokumen</th>
                    <th>Penandatangan</th>
                    <th>Progress Sirkulir</th>
                    <th>Status Dokumen</th>
                    <th>Nomor Induk Dokumen</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($document as $d)
                <tr>
                    <td><input type="checkbox" name="" id=""></td>
                    <td>{{ $d->DocumentID }}</td>
                    <td>{{ $d->jenis_dokumen->JenisDokumen }}</td>
                    <td>{{ $d->sign->sign_by }}</td>
                    <td>
                        <div class="progress progress-sm">
                            @if ($d->SignBy == '10')
                            @if ($d->DocumentStatus > 7)
                            <div class="progress-bar progress-bar-danger" style="width: 100%" aria-valuenow="100%"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                            @else
                            <div class="progress-bar progress-bar-danger" style="width: {{ $d->DocumentStatus/7*100 }}%"
                                aria-valuenow="{{ $d->DocumentStatus/7*100 }}%" aria-valuemin="0" aria-valuemax="100">
                            </div>
                            @endif
                            @else
                            @if ($d->DocumentStatus > 2)
                            <div class="progress-bar progress-bar-danger" style="width: 100%" aria-valuenow="100%"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                            @else
                            <div class="progress-bar progress-bar-danger" style="width: {{ $d->DocumentStatus/2*100 }}%"
                                aria-valuenow="{{ $d->DocumentStatus/3*100 }}%" aria-valuemin="0" aria-valuemax="100">
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
                    <td>
                        <button class="btn btn-sm btn-info btn-block" data-toggle="modal"
                            data-target="#modal-history">Histori
                            Dokumen</button>
                        <a href="{{ route('update-status', $d->id) }}" class="btn btn-sm btn-info btn-block">Update
                            Status</a>
                    </td>
                    <div class="modal fade" id="modal-history">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Histori Dokumen</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <!-- Timelime example  -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- The time line -->
                                                <div class="timeline">
                                                    <!-- timeline time label -->
                                                    <div class="time-label">
                                                        <span class="bg-red">27 Sep 2023</span>
                                                    </div>
                                                    <!-- /.timeline-label -->
                                                    <!-- timeline item -->
                                                    <div>
                                                        <i class="fas fa-envelope bg-blue"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                                            <h3 class="timeline-header"><a href="#">Dokumen diambil
                                                                    Mitra</a></h3>

                                                            <div class="timeline-body">
                                                                Dokumen diambil Mitra (PIC: Fulan)
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END timeline item -->

                                                    <!-- timeline item -->
                                                    <div>
                                                        <i class="fas fa-comments bg-yellow"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock"></i> 27 mins
                                                                ago</span>
                                                            <h3 class="timeline-header"><a href="#">Dokumen Selesai TTD
                                                                    Manager</a></h3>
                                                            <div class="timeline-body">
                                                                Diupdate oleh M. Ilham Syafrizal
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END timeline item -->
                                                    <!-- timeline time label -->
                                                    <div class="time-label">
                                                        <span class="bg-green">25 Sep 2023</span>
                                                    </div>
                                                    <!-- /.timeline-label -->
                                                    <!-- timeline item -->
                                                    <div>
                                                        <i class="fa fa-camera bg-purple"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock"></i> 2 days
                                                                ago</span>
                                                            <h3 class="timeline-header"><a href="#">Dokumen Diproses
                                                                    Manager</a></h3>
                                                            <div class="timeline-body">
                                                                Diupdate oleh M.Agung Prakarsa
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END timeline item -->
                                                    <!-- timeline item -->
                                                    <div>
                                                        <i class="fas fa-video bg-maroon"></i>

                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock"></i> 5 days
                                                                ago</span>

                                                            <h3 class="timeline-header"><a href="#">Dokumen disubmit
                                                                    oleh mitra <strong>ADMINISTRASI MEDIKA</strong></a>
                                                            </h3>

                                                            <div class="timeline-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END timeline item -->
                                                    <div>
                                                        <i class="fas fa-clock bg-gray"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
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
        <div class="float-right">
            {{ $document->links() }}
        </div>
    </div>
</div>
