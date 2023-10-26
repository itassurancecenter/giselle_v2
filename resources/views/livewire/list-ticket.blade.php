<div class="row mt-3">
    <div class="col-12">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th><input type="checkbox" name="" id=""></th>
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
                    <td><input type="checkbox" name="" id=""></td>
                    <td>{{ $t->TicketID }}</td>
                    <td>{{ $t->partner->partner_name }}</td>
                    <td>{{ $t->SubmitDate }}</td>
                    <td>{{ $t->PicDrop }}</td>
                    <td>
                        <strong>Jumlah Dokumen : </strong>{{ $t->document->count() }} <br>
                        <strong>Progress Dokumen</strong> <br>
                        <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-danger" style="width: 37%" aria-valuenow="50%" aria-valuemin="0" aria-valuemax="100">
                                50%
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('detail-tiket', $t->TicketID) }}" class="btn btn-info btn-sm">Detail Tiket</a>
                        <a href="#" class="btn btn-primary btn-sm">Update</a>
                        <a href="#" class="btn btn-primary btn-sm">Update Semua</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>

            {{ $ticket->links() }}

    </div>
</div>
