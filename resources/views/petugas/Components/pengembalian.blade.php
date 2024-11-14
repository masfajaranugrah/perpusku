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

            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-md-12">
                        <section class="section">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Pengembalian Buku
                                    </h5>
                                </div>
                                <div class="card-body">



                                    <!-- Tampilkan formulir -->
                                    <form class="form form-vertical" method="post"
                                    action="{{ route('petugascheck-anggota-pengembalian') }}">
                                    @csrf
                                        <div class="form-body">
                                          
 

                                  
                                            <div class="row">
                                                <div class="col-sm-10 mb-1">
                                                    <div class="input-group input-group-lg">
                                                        <span class="input-group-text" id="inputGroup-sizing-lg">ID
                                                            ANGGOTA</span>
                                                            <select name="id_anggota" id="id_anggota" class="form-control" required>
                                                                <option value="">-- Pilih  Anggota --</option>
                                                                @foreach ($anggota as $a)
                                                                    <option value="{{ $a->id_anggota }}">{{ $a->id_anggota }} - {{ $a->nama }}</option> <!-- Menampilkan ID dan nama anggota -->
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit"
                                                        class="btn btn-outline-info btn-lg">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Anggota Yang Jatuh Tempo Belum Mengembalikan Buku
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        @if($peminjaman->isEmpty())
                                            <p>Tidak ada data peminjaman yang sesuai.</p>
                                        @else
                                            <table class="table table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Tanggal Peminjaman</th>
                                                        <th>Denda</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($peminjaman as $pinjam)
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
                                                            <td>{{ $pinjam->nama }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_peminjaman)->format('d/m/Y') }}</td>
                                                            <td>{{ "Rp " . number_format($denda, 0, ',', '.') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
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
