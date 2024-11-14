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


                        <section class="row">
                            <div class="card">
                                <div class="card-body">
                                   


                                    <div class="table-responsive datatable-minimal">
                                        <form action="{{route('cetakpeminjaman')}}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn icon icon-left btn-success">
                                                <i data-feather="check-circle"></i>Cetak Laporan PDF
                                            </button>
                                            <table class="table" id="table1">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Judul Buku</th>
                                                        <th>Nama</th>
                                                        <th>Angkatan</th>
                                                        <th>Tanggal Peminjaman</th>
                                                        <th>Tanggal Pengembalian</th>
                                                        <th>Denda</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($peminjaman as $data)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="peminjaman_ids[]" value="{{ $data->id_peminjaman }}">
                                                            </td>
                                                            <td>{{ $data->buku->judul }}</td>
                                                            <td>{{ $data->anggota->nama }}</td>
                                                            <td>{{ $data->anggota->angkatan }}</td>
                                                            <td>{{ $data->tanggal_peminjaman }}</td>
                                                            <td>{{ $data->tanggal_pengembalian ? $data->tanggal_pengembalian : '-'}}</td>
                                                            <td>{{ "Rp " . number_format($data->denda, 0, ',', '.') }}</td>
                                                        </tr> 
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </form>



                                    </div>

                                </div>
                            </div>

                        </section>


                    </div>


            </div>


        </div>
    </div>
    @endsection
