@extends('layouts.app') 
{{-- @include('Petugas.PetugasDashboard._side') --}}
@section('main')
<div id="app">
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h2>Riwayat Peminjaman Anggota</h2>
        </div>
        
        <div class="page-content">
            <section class="row">
                <div class="col-md-12">
                    <section class="section">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Riwayat Peminjaman</h5>
                                <a href="{{ route('anggotapetugas') }}" class="btn icon icon-left btn-success">
                                    <i class="bi bi-back"></i>Kembali
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="alert alert-primary mb-4">
                                    <h4 class="alert-heading">{{ $anggota->nama }}</h4>
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                 
                                                <td class="text-white">ID {{ $anggota->id_anggota }}</td>
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>

                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Denda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($peminjaman->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data peminjaman untuk anggota ini.</td>
                                            </tr>
                                        @else
                                            @foreach ($peminjaman as $pinjam)
                                            <tr>
                                                <td>{{ $pinjam->buku->judul }}</td> <!-- Adjusted to use relationship -->
                                                <td>{{ $pinjam->tanggal_peminjaman }}</td> <!-- Formatting date -->
                                                <td>{{ $pinjam->tanggal_pengembalian ? $pinjam->tanggal_pengembalian : 'Belum Kembali' }}</td> <!-- Formatting date -->
                                                <td>
                                                    @if($pinjam->denda == 0)
                                                    <!-- Tombol Hijau Jika Denda 0 -->
                                                    <button class="btn btn-success">Rp. 0</button>
                                                @else
                                                    <!-- Tombol Merah Jika Denda Lebih dari 0 -->
                                                    <button class="btn btn-danger">Rp {{ number_format($pinjam->denda, 0, ',', '.') }}</button>
                                                @endif
                                            </td> 
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
