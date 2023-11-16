<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="{{ url('/beranda') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
            Beranda
            </p>
        </a>
      </li>
      <li class="nav-header"><strong>DOKUMEN SIRKULIR</strong></li>
      <li class="nav-item">
        <a href="{{ url('/buat-tiket') }}" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
            Submit Dokumen
            </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/list-sirkulir') }}" class="nav-link">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
            List Dokumen Sirkulir
            </p>
        </a>
      </li>
      <li class="nav-header"><strong>DAFTAR DOKUMEN SELESAI</strong></li>
      <li class="nav-item">
        <a href="{{ url('/list-done-signed') }}" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
            Selesai Proses TTD
            </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/list-done') }}" class="nav-link">
            <i class="nav-icon fas fa-clipboard-check"></i>
            <p>
            Dokumen Selesai
            </p>
        </a>
      </li>
      <li class="nav-header"><strong>NOMOR SURAT</strong></li>
      <li class="nav-item">
        <a href="{{ url('/') }}" class="nav-link">
            <i class="nav-icon fas fa-paperclip"></i>
            <p>
            Form Permintaan
            </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/') }}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
            Permintaan Diproses
            </p>
        </a>
      </li>
      <li class="nav-header"><strong>MASTER DATA</strong></li>
      <li class="nav-item">
        <a href="{{ route('master-dataMitra') }}" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
            Data Mitra
            </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('master-dataUser') }}" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
            Data User
            </p>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-folder"></i>
          <p>
            Dokumen
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="../layout/top-nav.html" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
              <p>Submit Dokumen</p>
            </a>
          </li>

        </ul>
      </li> --}}
    </ul>
  </nav>
