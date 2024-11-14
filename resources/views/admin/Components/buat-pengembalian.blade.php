@extends('layouts.app') 
{{-- @include('Admin.AdminDashboard._side') --}}

@section('main')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div id="app">
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h1>Riwayat Peminjaman</h1> <!-- Title for clarity -->
        </div>

        <div class="page-content">
            <section class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-primary">
                                <h4 class="alert-heading">Informasi Anggota: {{ $anggota->nama }}</h4>
                                <p>ID Anggota: {{ $anggota->id_anggota }}</p> <!-- Display member ID -->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Kode Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Jenis</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Denda</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($peminjaman as $pinjam)
                                        @php
                                        // Calculate the fine
                                        $tanggalPeminjaman = new \Carbon\Carbon($pinjam->tanggal_peminjaman);
                                        $tanggalSekarang = \Carbon\Carbon::now();
                                        $hariTerlambat = $tanggalSekarang->diffInDays($tanggalPeminjaman);

                                        // Get the overdue days according to the fine rules
                                        $hariTerlambatAturan = max(0, $hariTerlambat - $pinjam->hari_terlambat);
                                        
                                        // Calculate the fine based on the daily fine rate
                                        $denda = $hariTerlambatAturan * $pinjam->biaya_per_hari;
                                        @endphp
                                        <tr>
                                            <td>{{ $pinjam->kode_buku }}</td>
                                            <td>{{ $pinjam->judul }}</td>
                                            <td>{{ $pinjam->jenis }}</td>
                                            <td>{{ $pinjam->tanggal_peminjaman }}</td>
                                            <td>{{ "Rp " . number_format($denda, 0, ',', '.') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#returnModal{{ $pinjam->id_peminjaman }}">
                                                    <i class="bi bi-eye"></i> Pengembalian
                                                </button>

                                                <!-- Form for return -->
                                                <div class="modal fade text-left" id="returnModal{{ $pinjam->id_peminjaman }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-warning">
                                                                <h5 class="modal-title white" id="myModalLabel160">
                                                                    Pengembalian Buku
                                                                </h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <form method="post" action="{{ route('pengembalian.update', $pinjam->id_peminjaman) }}">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="id_peminjaman" value="{{ $pinjam->id_peminjaman }}">
                                                                            
                                                                            <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="form-group has-icon-left">
                                                                                            <label for="email-id-icon">Kode Buku</label>
                                                                                            <div class="position-relative">
                                                                                                <input type="text" name="judul" readonly
                                                                                                    class="form-control" value="{{ $pinjam->kode_buku }}"
                                                                                                    id="email-id-icon">
                                                                                                <div class="form-control-icon">
                                                                                                    <i class="bi bi-book"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="form-group has-icon-left">
                                                                                            <label for="first-name-icon">Nama</label>
                                                                                            <div class="position-relative">
                                                                                                <input type="text" name="nama" readonly
                                                                                                    class="form-control" value="{{ $anggota->nama }}"
                                                                                                    id="first-name-icon">
                                                                                                <div class="form-control-icon">
                                                                                                    <i class="bi bi-person"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                   
                                                                                    <div class="col-12">
                                                                                        <div class="form-group has-icon-left">
                                                                                            <label for="email-id-icon">Judul Buku</label>
                                                                                            <div class="position-relative">
                                                                                                <input type="text" name="judul" readonly
                                                                                                    class="form-control" value="{{ $pinjam->judul }}"
                                                                                                    id="email-id-icon">
                                                                                                <div class="form-control-icon">
                                                                                                    <i class="bi bi-book"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-12">
                                                                                        <div class="form-group has-icon-left">
                                                                                            <label for="tanggal-peminjaman">Tanggal Peminjaman</label>
                                                                                            <div class="position-relative">
                                                                                                <input type="text" readonly
                                                                                                    name="tanggal_peminjaman"
                                                                                                    value="{{ $pinjam->tanggal_peminjaman }}"
                                                                                                    class="form-control"
                                                                                                    id="tanggal-peminjaman">
                                                                                                <div class="form-control-icon">
                                                                                                    <i class="bi bi-window"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="form-group has-icon-left">
                                                                                            <label for="denda">Denda</label>
                                                                                            <div class="position-relative">
                                                                                                <!-- Field yang terlihat oleh user dengan format "Rp" -->
                                                                                                <input type="text" class="form-control" readonly
                                                                                                    value="{{ 'Rp ' . number_format($pinjam->denda, 0, ',', '.') }}" id="denda_formatted">
                                                                                                
                                                                                                <!-- Field hidden yang berisi nilai asli untuk dikirimkan -->
                                                                                                <input type="hidden" name="denda" value="{{ $pinjam->denda }}" id="denda">
                                                                                                
                                                                                                <div class="form-control-icon">
                                                                                                    <i class="bi bi-calculator"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    

                                                                                    <div class="col-12">
                                                                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End return form -->
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data peminjaman yang sesuai ditemukan.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
