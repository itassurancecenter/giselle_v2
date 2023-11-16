<div class="row mt-3">
    <div class="col-12">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nomor Tiket</th>
              <th>Nama Mitra</th>
              <th>Tanggal Submit</th>
              <th>PIC Submit (Mitra)</th>
              <th>Detail Tiket</th>
              <th>Detail</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($ticket as $t)
                <tr>
                    <td>{{ $t->TicketID }}</td>
                    <td>{{ $t->partner->partner_name }}</td>
                    <td>{{ $t->SubmitDate }}</td>
                    <td>{{ $t->PicDrop }}</td>
                    <td>
                        <strong>Jumlah Dokumen : </strong>{{ $t->document->count() }} <br>
                        <strong>Progress Dokumen</strong> <br>
                        <div class="progress progress-sm">
                            @if ($t->document->count() !== 0)
                            <div class="progress-bar progress-bar-danger" style="width: {{ $t->documentDone->count()/$t->document->count()*100 }}%" aria-valuenow="{{ $t->documentDone->count()/$t->document->count()*100 }}%" aria-valuemin="0" aria-valuemax="100">
                                {{ $t->documentDone->count()/$t->document->count()*100 }} %
                            </div>
                            @else
                            <div class="progress-bar progress-bar-danger" style="width: 0%" aria-valuenow="0%" aria-valuemin="0" aria-valuemax="100">
                                0%
                            </div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('detail-tiket', $t->TicketID) }}" class="btn btn-info btn-sm btn-block">Detail Tiket</a>
                        <a href="#" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                        data-target="#update-{{ $t->TicketID }}"">Update</a>
                        <a href="#" class="btn btn-secondary btn-sm btn-block">Update Semua</a>
                        <form action="{{ route('bulk-update-status') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal fade" id="update-{{ $t->TicketID }}">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Dokumen</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="float-sm-right">
                                                <button type="submit" class="btn btn-md btn-info mb-2">Update Status</button>
                                            </div>

                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select-all-document"></th>
                                                        <th>ID Dokumen</th>
                                                        <th>Nomor Induk Dokumen</th>
                                                        <th>Jenis Dokumen</th>
                                                        <th>Penandatangan</th>
                                                        <th>Status Dokumen</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($t->document as $d)
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
                                                        <td>{{ $d->jenis_dokumen->JenisDokumen }}</td>
                                                        <td>{{ $d->sign->sign_by }}</td>
                                                        <td><span class="{{ $d->status->label_class }}">{{ $d->status->status }}</span></td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>

            {{ $ticket->links() }}

    </div>
</div>
<script>
    $("#select-all-checkbox").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
</script>
<script>
    $("#select-all-document").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
</script>
