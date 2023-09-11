<div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width: 5%;">No</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Role</th>
          <th>Nama Mitra</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data_user as $du)
                <tr>
                    <td>{{ $du->iduser }}</td>
                    <td>{{ $du->name }}</td>
                    <td>{{ $du->username }}</td>
                    @if ($du->role == 1)
                        <td>Admin</td>
                    @elseif ($du->role == 2)
                        <td>Mitra</td>
                    @elseif ($du->role == 3)
                        <td>Staff ASC</td>
                    @elseif ($du->role == 4)
                        <td>Officer ASC</td>
                    @elseif ($du->role == 5)
                        <td>Manager ASC</td>
                    @elseif ($du->role == 6)
                        <td>Senior Manager ASC</td>
                    @elseif ($du->role == 7)
                        <td>Dashboard Segmen</td>
                    @else
                        <td>Tidak Teridentifikasi</td>
                    @endif
                    @if($du->partner_id != NULL)
                        <td>{{ $du->partner->partner_name }}</td>
                    @else
                        <td><strong>User Internal ASC</strong></td>
                    @endif
                    <td>
                        <a href="#" class="btn btn-success btn-md">Edit</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Nama Mitra</th>
            <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
      <div class="float-right">
        {{ $data_user->links() }}
      </div>
</div>
