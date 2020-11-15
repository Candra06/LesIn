<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Admin Les.In
                            <span class="user-level">{{session('username')}}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                   
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a data-toggle="collapse" href="{{ url('/dashboard')}}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        {{-- <span class="caret"></span> --}}
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
                            <li class="{{ Request::segment(1) == 'user' ? 'active' : '' }}">
                                <a href="{{ url('/user')}}">
                                    <span class="sub-item">Admin</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
