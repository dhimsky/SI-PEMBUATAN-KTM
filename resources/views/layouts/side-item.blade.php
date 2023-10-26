<div class="quixnav">
  <div class="quixnav-scroll ps ps--active-y mm-active">
      <ul class="metismenu mm-show" id="menu">
        
        @if (Auth::user()->role_id == '1')
        <li><a href="{{ route('dashboard') }}" aria-expanded="false"><i
          class="icon icon-home"></i><span class="nav-text">Dashboard</span></a>
        </li>
          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Data Pengguna</span></a>
              <ul aria-expanded="false" class="mm-collapse">
                  <li><a href="/users/role">Role</a></li>
                  <li><a href="/users/account">Account</a></li>
              </ul>
          </li>
          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-chart-bar-33"></i><span class="nav-text">Data Form</span></a>
            <ul aria-expanded="false">
              <li><a href="{{route('jurusan.index')}}">Jurusan</a></li>
              <li><a href="{{route('prodi.index')}}">Prodi</a></li>
            </ul>
          </li>
          <li><a href="{{ route('data-mahasiswa.index') }}" aria-expanded="false"><i
            class="icon icon-users-mm"></i><span class="nav-text">Data Mahasiswa</span></a>
          </li>
          <li><a href="{{ route('kalender.index') }}" aria-expanded="false"><i class="fa fa-calendar"></i><span
            class="nav-text">Kalender</span></a></li>
          @endif

          @if (Auth::user()->role_id == '2')
          <li><a href="{{ route('home') }}" aria-expanded="false"><i class="icon icon-home"></i><span
            class="nav-text">Home</span></a></li>
          <li><a href="{{ route('mahasiswa.detail', ['nim' => Auth::user()->nim]) }}" aria-expanded="false"><i class="icon icon-layout-25"></i><span
            class="nav-text">Data Anda</span></a></li>
            <li><a href="{{ route('akun.index') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
              class="nav-text">Akun</span></a></li>
          @endif
      </ul>
  <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 537px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 389px;"></div></div></div>
</div>