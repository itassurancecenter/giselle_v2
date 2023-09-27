<div class="row mt-3">
    <div class="col-12">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Dokumen</th>
              <th>Jenis Dokumen</th>
              <th>Penandatangan</th>
              <th>Status Dokumen</th>
              <th>Nomor Induk Dokumen</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($document as $d)
                <tr>
                    <td>{{ $d->DocumentID }}</td>
                    <td>{{ $d->jenis_dokumen->JenisDokumen }}</td>
                    <td>{{ $d->sign->sign_by }}</td>
                    <td>{{ $d->DocumentStatus }}</td>
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
                </tr>
                @endforeach
            </tbody>
          </table>
          <div class="float-right">
            {{ $document->links() }}
          </div>
    </div>
</div>
