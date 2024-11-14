@extends('layouts.app') 
{{-- @include('Admin.AdminDashboard._side') --}}
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
                            <div class="card-header"> 
                                    <h5 class="card-title">
                                        <center>
                                        Laporan Jumlah Total Denda per Bulan/Tahun
                                        </center>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    
                                    <form action="{{route('cetakanggota')}}" method="get">  @csrf  
                                        <button  class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button></form>
                                 
                                    <div class="table-responsive datatable-minimal">
 
                                        <table class="table" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>Bulan/Tahun</th>
                                                    <th>Total PIOJODenda</th>
                                                    <th>Jumlah Orang yang Kena Denda</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_denda as $item)
                                                    <tr>
                                                        <td>{{ $item->bulan_peminjaman }}</td>
                                                        <td>{{ number_format($item->total_denda, 2, ',', '.') }}</td>
                                                        <td>{{ $item->jumlah_orang_denda }}</td>
                                                    </tr>
                                                @endforeach
                                        
                                                <tr>
                                                    <td><strong>Total</strong></td>
                                                    <td><strong>Rp {{ number_format($total_semua_denda, 0, ',', '.') }}</strong></td>
                                                    <td><strong>{{ $total_orang_denda }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        


                                    </div>

                                </div>
                            </div>

                        </section>

                        <section class="row">
                            <div class="card">

                            <div class="card-header">
                                    <h5 class="card-title">
                                        <center>
                                        Laporan Daftar Anggota dengan Total Denda

                                        </center>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    
                                    <form action="{{route('cetakdendaanggota')}}" method="get">
                                             <button onclick="cetakLaporan2()" class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button> 
                                    </form>
                              

 

                                    <table class="table" id="table1">
                                        <thead>
                                            <tr>
                                                <th>ID Anggota</th>
                                                <th>Nama Anggota</th>
                                                <th>Angkatan</th>
                                                <th>Total Denda</th>
                                                <th>Total Uang Denda</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                                @foreach ($data_anggota_denda as $anggota)
                <tr>
                    <td>{{ $anggota->id_anggota }}</td>
                    <td>{{ $anggota->nama_anggota }}</td>
                    <td>{{ $anggota->angkatan }}</td>
                    <td>{{ $anggota->total_denda }}</td>
                    <td>{{ number_format($anggota->total_uang_denda, 0, ',', '.') }}</td>
                </tr>
            @endforeach
                                            </tr>
                                       
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </section>



                    </div>


            </div>

        </div>
    </div>

@endsection