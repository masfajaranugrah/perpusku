<div class="main-sidebar" id="sidebar">
    <div class="sidebar-wrapper main-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    @if($instansi)
                        <img src="{{ $instansi->logo ? asset('storage/' . $instansi->logo) : asset('path/to/default/image.png') }}" alt="{{ $instansi->logo ?: 'Default Logo' }}" class="img-fluid chocolat-image" width="100" height="60">
                    @else
                        <img src="{{ asset('path/to/default/image.png') }}" alt="Default Logo" class="img-fluid chocolat-image" width="100">
                    @endif
                    <h5>{{ $instansi ? $instansi->nama : '' }}</h5>
                    <h6>{{ $instansi ? $instansi->keterangan : '' }}</h6>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <!-- Your theme toggle SVG and checkbox here -->
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <!-- Add your icons here -->
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                
                <li class="sidebar-item">
                    <a href="{{route('dashboardpetugas')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{route('petugaspeminjaman')}}" class='sidebar-link'>
                        <i class="bi bi-server"></i>
                        <span>Peminjaman </span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{route('petugaspengembalian')}}" class='sidebar-link'>
                        <i class="bi bi-clipboard-check"></i>
                        <span>Pengembalian</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{route('petugasdatabuku')}}" class='sidebar-link'>
                        <i class="bi bi-inbox"></i>
                        <span>Data Buku</span>
                    </a>
                </li>
 

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-memory"></i>
                        <span>Laporan</span>
                    </a>

                    <ul class="submenu ">

                        <li class="submenu-item  ">
                            <a href="{{route('petugasriwayat-peminjaman')}}" class="submenu-link">Peminjaman</a>

                        </li>

                        <li class="submenu-item  ">
                            <a href="{{route('petugasriwayat-buku')}}" class="submenu-link">Data Buku</a>

                        </li>

                        <li class="submenu-item  ">
                            <a href="{{route('petugasdenda')}}" class="submenu-link">Denda</a>

                        </li>
                        

                    </ul>


                </li>

                <li class="sidebar-item">
                    <a href="{{route('petugaspanduan')}}" class='sidebar-link'>
                        <i class="bi bi-book"></i>
                        <span>Panduan </span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{route('anggotapetugas')}}" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>Anggota </span>
                    </a>
                </li>

                <li class="sidebar-title">Authentication</li>
 
                <form action="{{ route('logout') }}" method="POST" class='sidebar-link'>
                    @csrf   
                    <button type="submit" class="btn btn-danger w-full">logout</button>

                </form>
            </ul>
        </div>
    </div>
</div>
 