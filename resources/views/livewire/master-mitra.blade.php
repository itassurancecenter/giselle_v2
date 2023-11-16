<div>
    <input wire:model="search" type="text" placeholder="Search...">
    <table class="table table-responsive table-bordered table-striped" id="dataMitra">
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
    <div class="float-right">
        {{ $data_mitra->links() }}
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#dataMitra').DataTable();
            });
        </script>
    @endpush
</div>
