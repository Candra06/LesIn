<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{url('/')}}/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Admin Les.In
                            <span class="user-level">{{ session('email') }}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>


                </div>
            </div>
            <ul class="nav nav-primary">

                <li class="nav-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('/dashboard')}}" class="collapsed">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>

                </li>
                <li class="nav-section {{ Request::segment(1) == 'siswa' || Request::segment(1) == 'user' || Request::segment(1) == 'tentor' ? 'active' : '' }}">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master Data</h4>
                </li>
                <li class="nav-item {{ Request::segment(1) == 'siswa' ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-user-alt"></i>
                        <p>User</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::segment(1) == 'siswa' || Request::segment(1) == 'user' || Request::segment(1) == 'tentor' ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(1) == 'siswa' ? 'active' : '' }}">
                                <a href="{{ url('/siswa')}}">
                                    <span class="sub-item ">Data Siswa</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(1) == 'tentor' ? 'active' : '' }}">
                                <a href="{{ url('/tentor')}}">
                                    <span class="sub-item">Data Tentor</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ Request::segment(1) == 'mapel' ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-book-open"></i>
                        <p>Mata Pelajaran</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::segment(1) == 'mapel' || Request::segment(1) == 'dataMengajar' ? 'show' : '' }}" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(1) == 'mapel' ? 'active' : '' }}">
                                <a href="{{ url('/mapel')}}">
                                    <span class="sub-item ">Data Mapel</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(1) == 'dataMengajar' ? 'active' : '' }}">
                                <a href="{{ url('/dataMengajar')}}">
                                    <span class="sub-item">Data Mengajar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::segment(1) == 'rekening' ? 'active' : '' }}">
                    <a href="{{ url('/rekening') }}" class="collapsed">
                        <i class="fas fa-dollar-sign"></i>
                        <p>Data Rekening</p>
                    </a>

                </li>
                <li class="nav-section {{ Request::segment(1) == 'siswa' || Request::segment(1) == 'user' || Request::segment(1) == 'tentor' ? 'active' : '' }}">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kelas</h4>
                </li>
                <li class="nav-item {{ Request::segment(1) == 'jadwal' ? 'active' : '' }}">
                    <a href="{{ url('/jadwal') }}" class="collapsed">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Jadwal</p>
                    </a>

                </li>
                {{-- <li class="nav-item {{ Request::segment(1) == 'absensi' ? 'active' : '' }}">
                    <a href="{{ url('/absensi') }}" class="collapsed">
                        <i class="fas fa-book"></i>
                        <p>Absensi</p>
                    </a>

                </li> --}}

                <li class="nav-section {{ Request::segment(1) == 'siswa' || Request::segment(1) == 'user' || Request::segment(1) == 'tentor' ? 'active' : '' }}">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Finansial</h4>
                </li>
                <li class="nav-item {{ Request::segment(1) == 'pembayaran' ? 'active' : '' }}">
                    <a href="{{ url('/pembayaran') }}" class="collapsed">
                        <i class="fas fa-donate"></i>
                        <p>Pembayaran Kelas</p>
                    </a>

                </li>
                <li class="nav-item {{ Request::segment(1) == 'gajiTentor' ? 'active' : '' }}">
                    <a href="{{ url('/gajiTentor') }}" class="collapsed">
                        <i class="fas fa-dollar-sign"></i>
                        <p>Gaji Tentor</p>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</div>
