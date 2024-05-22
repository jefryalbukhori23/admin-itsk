
  <div class="sidebar p-2 py-md-3 @@cardClass">
    <div class="container-fluid">

      <div class="title-text d-flex align-items-center mb-4 mt-1">
        <h4 class="sidebar-title mb-0 flex-grow-1">
            <span class="sm-txt" style="max-height:70px;">
                <img src="{{ asset('style/assets/img/logo.png ') }}" style="max-height:50px;" alt=""></span>
            <span style="font-size: 15px;">Sugeng Hartono</span>
        </h4>
        {{-- <div class="dropdown morphing scale-left">
          <a class="dropdown-toggle more-icon" href="#" role="button" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
          <ul class="dropdown-menu shadow border-0 p-2 mt-2" data-bs-popper="none">
            <li class="fw-bold px-2">Quick Actions</li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="landing/index.html" aria-current="page">Landing page</a></li>
            <li><a class="dropdown-item" href="inventory/index.html">Inventory</a></li>
            <li><a class="dropdown-item" href="ecommerce/index.html">eCommerce</a></li>
            <li><a class="dropdown-item" href="hrms/index.html">HRMS</a></li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="account-invoices.html">Invoices List</a></li>
            <li><a class="dropdown-item" href="account-create-invoices.html">Create Invoices</a></li>
          </ul>
        </div> --}}
      </div>

      {{-- <div class="create-new py-3 mb-2">
        <div class="d-flex">
          <select class="form-select rounded-pill me-1">
            <option selected>Select Project</option>
            <option value="1">Luno University</option>
            <option value="2">Book Manager</option>
            <option value="3">Luno Sass App</option>
          </select>
          <button class="btn bg-primary text-white rounded-circle" data-bs-toggle="modal" data-bs-target="#CreateNew" type="button"><i class="fa fa-plus"></i></button>
        </div>
      </div> --}}

      {{-- menu --}}
        <div class="main-menu flex-grow-1">
        <ul class="menu-list">
            <li>
                <a class="m-link" href="{{url('dashboard')}}">
                    <i class="fa fa-tachometer"></i>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>
        </ul>
        @if(auth()->user()->role == "4")
            <ul class="menu-list">
                <li class="divider py-2 lh-sm"><span class="small">MASTER DATA</span><br></li><li class="collapsed">
                    <a class="m-link @if($menu == "master_pengurus") active @endif" data-bs-toggle="collapse" data-bs-target="#master_pengurus_menu" href="#">
                        <i class="fa fa-certificate"></i>
                        <span class="ms-2">Kepengurusan</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>
                    <ul class="sub-menu collapse  @if($menu == "master_pengurus") show @endif" id="master_pengurus_menu">
                        <li><a class="ms-link @if($submenu == "jabatan_pengurus") active @endif" href="{{route('jabatan_pengurus.index')}}">Jabatan Pengurus</a></li>
                        <li><a class="ms-link @if($submenu == "pengurus") active @endif" href="{{route('pengurus.index')}}">Pengurus</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link @if($menu == "master") active @endif" data-bs-toggle="collapse" data-bs-target="#master_data_menu" href="#">
                        <i class="fa fa-briefcase"></i>
                        <span class="ms-2">Fakultas</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>
                    <ul class="sub-menu collapse  @if($menu == "master") show @endif" id="master_data_menu">
                        <li><a class="ms-link @if($submenu == "fakultas") active @endif" href="{{route('fakultas.index')}}">Fakultas</a></li>
                        <li><a class="ms-link @if($submenu == "jenjang") active @endif" href="{{route('jenjang.index')}}">Jenjang</a></li>
                        <li><a class="ms-link @if($submenu == "prodi") active @endif" href="{{route('prodi.index')}}">Prodi</a></li>
                        <li><a class="ms-link @if($submenu == "sistem_kuliah") active @endif" href="{{route('sistem_kuliah.index')}}">Sistem Kuliah</a></li>
                        <li><a class="ms-link @if($submenu == "position") active @endif" href="{{route('position.index')}}">Jabatan Dosen</a></li>
                        <li><a class="ms-link @if($submenu == "pekerjaan_karyawan") active @endif" href="{{route('pekerjaan_karyawan.index')}}">Pekerjaan Karyawan</a></li>
                    </ul>
                </li>
                <li>
                    <a class="m-link @if($menu == "dosen") active @endif" href="{{route('lecture.index')}}">
                        <i class="fa fa-user-md"></i>
                        <span class="ms-2">Dosen</span>
                    </a>
                </li>
                <li>
                    <a class="m-link @if($menu == "karyawan") active @endif" href="{{route('karyawan.index')}}">
                        <i class="fa fa-users"></i>
                        <span class="ms-2">Karyawan</span>
                    </a>
                </li>
              
                <li class="collapsed">
                    <a class="m-link @if($menu == "master_pmb") active @endif" data-bs-toggle="collapse" data-bs-target="#master_pmb_menu" href="#">
                        <i class="fa fa-users"></i>
                        <span class="ms-2">PMB</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>
                    <ul class="sub-menu collapse  @if($menu == "master_pmb") show @endif" id="master_pmb_menu">
                        <li><a class="ms-link @if($submenu == "pendaftar") active @endif" href="{{url('pendaftar')}}">Pendaftar</a></li>
                        <li><a class="ms-link @if($submenu == "pindah") active @endif" href="{{url('pindah-pendaftar')}}">Pindah Prodi</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link @if($menu == "master2") active @endif" data-bs-toggle="collapse" data-bs-target="#master_data_menu2" href="#">
                        <i class="fa fa-building"></i>
                        <span class="ms-2">SARPRAS</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>

                    <ul class="sub-menu collapse  @if($menu == "master2") show @endif" id="master_data_menu2">
                        <li><a class="ms-link @if($submenu == "fungsi_ruangan") active @endif" href="{{route('building_room_function.index')}}">Fungsi Ruangan</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link @if($menu == "master4") active @endif" data-bs-toggle="collapse" data-bs-target="#master_data_menu4" href="#">
                        <i class="fa fa-money"></i>
                        <span class="ms-2">KEUANGAN</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>

                    <ul class="sub-menu collapse  @if($menu == "master4") show @endif" id="master_data_menu4">
                        <li><a class="ms-link @if($submenu == "kegiatan_berbayar") active @endif" href="{{route('kegiatan_berbayar.index')}}">Kegiatan Berbayar</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link @if($menu == "master3") active @endif" data-bs-toggle="collapse" data-bs-target="#master_data_menu3" href="#">
                        <i class="fa fa-book"></i>
                        <span class="ms-2">SIAKAD</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>

                    <ul class="sub-menu collapse  @if($menu == "master3") show @endif" id="master_data_menu3">
                        <li><a class="ms-link @if($submenu == "batch_year") active @endif" href="{{route('batch_year.index')}}">Tahun Akademik</a></li>
                        <li><a class="ms-link @if($submenu == "kalender_akademik") active @endif" href="{{url('kalender_akedemik')}}">Kalender Akademik</a></li>
                        <li><a class="ms-link @if($submenu == "hours") active @endif" href="{{route('hours.index')}}">Jam Pelajaran</a></li>
                        <li><a class="ms-link @if($submenu == "krs_date") active @endif" href="{{route('krs_date.index')}}">Tanggal KRS</a></li>
                        <li><a class="ms-link @if($submenu == "kuisioner_dosen") active @endif" href="{{route('kuisioner_dosen.index')}}">EDOM</a></li>
                    </ul>
                </li>
                <li>
                    <a class="m-link" href="{{url('pengguna')}}">
                        <i class="fa fa-user"></i>
                        <span class="ms-2">Pengguna</span>
                    </a>
                </li>
              <li>
                <a class="m-link @if($menu == " berita") active @endif" href="{{route('berita.index')}}">
                  <i class="fa fa-newspaper-o"></i>
                  <span class="ms-2">Berita</span>
                </a>
              </li>
              
                {{-- <li class="divider py-2 lh-sm"><span class="small">HALAMAN UTAMA</span><br></li>
                <li class="collapsed">
                    <a class="m-link @if($menu == "landing") active @endif" data-bs-toggle="collapse" data-bs-target="#landing_menu" href="#">
                        <i class="fa fa-th"></i>
                        <span class="ms-2">Landing Page</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>
                    <ul class="sub-menu collapse  @if($menu == "landing") show @endif" id="landing_menu">
                        <li><a class="ms-link @if($submenu == "slider") active @endif" href="{{route('slider.index')}}">Slider</a></li>
                        <li><a class="ms-link @if($submenu == "page") active @endif" href="{{route('landing_page.index')}}">Page</a></li>
                        <li><a class="ms-link @if($submenu == "menu") active @endif" href="{{route('landing_menu.index')}}">Menu</a></li>
                        <li><a class="ms-link @if($submenu == "kategori_konten") active @endif" href="{{route('kategori_konten.index')}}">Kategori Konten</a></li>
                        <li><a class="ms-link @if($submenu == "konten") active @endif" href="{{route('konten.index')}}">Konten</a></li>
                    </ul>
                </li> --}}

            </ul>
        @elseif(auth()->user()->role == "11")
            <ul class="menu-list">
                <li class="collapsed">
                    <a class="m-link @if($menu == "master_owner_pmb") active @endif" data-bs-toggle="collapse" data-bs-target="#master_owner_pmb" href="#">
                        <i class="fa fa-book"></i>
                        <span class="ms-2">PMB</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>

                    <ul class="sub-menu collapse  @if($menu == "master_owner_pmb") show @endif" id="master_owner_pmb">
                        <li><a class="ms-link @if($submenu == "daftar_ulang") active @endif" href="{{route('daftar-ulang-owner.index')}}">Approve Biaya Daftar Ulang</a></li>
                    </ul>
                </li>
            </ul>

        @endif
        </div>


      {{-- <ul class="menu-list nav navbar-nav flex-row text-center menu-footer-link">
        <li class="nav-item flex-fill p-2">
        <a class="d-inline-block w-100 color-400" href="#" data-bs-toggle="modal" data-bs-target="#ScheduleModal" title="My Schedule">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
        <path class="fill-secondary" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
        <path class="fill-secondary" d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
        </svg>
        </a>
        </li>
        <li class="nav-item flex-fill p-2">
        <a class="d-inline-block w-100 color-400" href="#" data-bs-toggle="modal" data-bs-target="#MynotesModal" title="My notes">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
        <path class="fill-secondary" d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5z" />
        <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293L10 14.793z" />
        </svg>
        </a>
        </li>
        <li class="nav-item flex-fill p-2">
        <a class="d-inline-block w-100 color-400" href="#" data-bs-toggle="modal" data-bs-target="#RecentChat">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
        <path class="fill-secondary" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
        </svg>
        </a>
        </li>
        <li class="nav-item flex-fill p-2">
        <a class="d-inline-block w-100 color-400" href="auth-signin.html" title="sign-out">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M7.5 1v7h1V1h-1z" />
        <path class="fill-secondary" d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
        </svg>
        </a>
        </li>
      </ul> --}}
    </div>
  </div>
