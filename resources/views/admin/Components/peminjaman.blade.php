@extends('layouts.app') 
{{-- @include('Admin.AdminDashboard._side', ['instansi' => $instansi]) Pass instansi to sidebar --}}
@section('main')

@if (session('error_message'))
    <div class="alert alert-danger">
        {{ session('error_message') }}
    </div>
@endif
<div id="app">
         <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">

            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-md-12">
                        <section class="section">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Peminjaman Buku
                                    </h5>
                                </div>
                                <div class="card-body">



                              <!-- Tampilkan formulir -->
<form class="form form-vertical" method="post" action="{{ route('check-anggota') }}">
    <div class="form-body">
        @csrf
        <div class="row">
            <div class="col-sm-10 mb-1">
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg">ANGGOTA</span>
                    <select name="id_anggota" id="id_anggota" class="form-control" required>
                        <option value="">-- Pilih  Anggota --</option>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->id_anggota }}">{{ $a->nama }}</option> <!-- Menampilkan ID dan nama anggota -->
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-outline-info btn-lg">Kirim</button>
            </div>
        </div>
    </div>
</form>



                                    
                                </div>
                            </div>
                            <div class="card">
                            <div class="card-header">
                                    <h5 class="card-title">
                                        Peminjaman Buku Hari ini
                                    </h5>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kode Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Tanggal </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @if ($peminjamans->count() > 0)
                                        @foreach ($peminjamans as $peminjaman)
                                            <tr>
                                                <td class="text-bold-500">{{ $peminjaman->anggota->nama }}</td>
                                                <td>{{ $peminjaman->buku->kode_buku }}</td>
                                                <td>{{ $peminjaman->buku->judul }}</td>
                                                <td class="text-bold-500">{{ $peminjaman->tanggal_peminjaman }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">Tidak ada data peminjaman pada tanggal  .</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>

                        </section>
                    </div>

                </section>
            </div>
              

        </div>
    </div>
 @endsection