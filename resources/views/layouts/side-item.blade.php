<div class="quixnav">
  <div class="quixnav-scroll ps ps--active-y mm-active">
      <ul class="metismenu mm-show" id="menu">
        
        @if (Auth::user()->role_id == '1')
        <br>
        <li><a href="{{ route('dashboard') }}" aria-expanded="false"><i
          class="icon icon-home"></i><span class="nav-text">Dashboard</span></a>
        </li>
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Data Pengguna</span></a>
            <ul aria-expanded="false" class="mm-collapse">
                <li><a href="{{route('role.index')}}">Role</a></li>
                <li><a href="{{route('account.index')}}">Account</a></li>
            </ul>
        </li>
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-file-o"></i><span class="nav-text">Data Form</span></a>
          <ul aria-expanded="false">
            <li><a href="{{route('jurusan.index')}}">Jurusan</a></li>
            <li><a href="{{route('prodi.index')}}">Prodi</a></li>
            <li><a href="{{route('tahunangkatan.index')}}">Tahun Angkatan</a></li>
            <li><a href="{{route('agama.index')}}">Agama</a></li>
          </ul>
        </li>
        <li><a href="{{ route('data-mahasiswa.index') }}" aria-expanded="false"><i
          class="icon icon-users-mm"></i><span class="nav-text">Data Mahasiswa</span></a>
        </li>
        <li><a href="{{ route('pengajuan.index') }}" aria-expanded="false"><i class="fa fa-id-card">
          </i><span class="nav-text">Pengajuan KTM</span></a>
        </li>
        <li><a href="{{ route('kalender.index') }}" aria-expanded="false"><i class="fa fa-calendar">
          </i><span class="nav-text">Kalender</span></a>
        </li>
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-settings"></i><span class="nav-text">Kelola Akun</span></a>
          <ul aria-expanded="false">
            <li><a href="{{ route('kelolaakun.index') }}">Profile</a></li>
            <li><a data-toggle="modal" data-target=".logoutmode">Keluar Akun</a></li>
          </ul>
        </li>
        @endif

        @if (Auth::user()->role_id == '2')
        <br>
        <li><a href="{{ route('home') }}" aria-expanded="false"><i class="icon icon-home"></i><span
          class="nav-text">Home</span></a></li>
        <li><a href="{{ route('mahasiswa.detail', ['nim' => Crypt::encryptString(Auth::user()->no_identitas)]) }}" aria-expanded="false"><i class="icon icon-form">
          </i><span class="nav-text">Data Saya</span></a>
        </li>
        <li><a href="{{ route('pengajuanktm.index', ['nim' => Crypt::encryptString(Auth::user()->no_identitas)]) }}" aria-expanded="false"><i class="fa fa-id-card">
        </i><span class="nav-text">Pengajuan KTM</span></a>
      </li>
        <li><a href="{{ route('kalender.index') }}" aria-expanded="false">
          <i class="fa fa-calendar"></i><span class="nav-text">Kalender</span></a>
        </li>
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-settings"></i><span class="nav-text">Kelola Akun</span></a>
          <ul aria-expanded="false">
            <li><a href="{{ route('akun.index') }}">Profile</a></li>
            <li><a data-toggle="modal" data-target=".logoutmode">Keluar Akun</a></li>
          </ul>
        </li>
        @endif

        @if (Auth::user()->role_id == '3')
        <br>
        <li><a href="{{ route('dashboard') }}" aria-expanded="false"><i
          class="icon icon-home"></i><span class="nav-text">Dashboard</span></a>
        </li>
        <li><a href="{{ route('pengajuan.index') }}" aria-expanded="false"><i class="fa fa-id-card">
        </i><span class="nav-text">Pengajuan KTM</span></a>
      </li>
        <li><a href="{{ route('kalender.index') }}" aria-expanded="false"><i class="fa fa-calendar"></i><span
          class="nav-text">Kalender</span></a></li>
          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-settings"></i><span class="nav-text">Kelola Akun</span></a>
            <ul aria-expanded="false">
              <li><a href="{{ route('kelolaakun.index') }}">Profile</a></li>
              <li><a data-toggle="modal" data-target=".logoutmode">Keluar Akun</a></li>
            </ul>
          </li>
        @endif
      </ul>
  <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 537px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 389px;"></div></div></div>
</div>

<div class="modal fade logoutmode" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Keluar Akun</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">Yakin ingin keluar dari akun ini?</div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <form action="{{ url('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-danger">Keluar</button>
              </form>
          </div>
      </div>
  </div>
</div>