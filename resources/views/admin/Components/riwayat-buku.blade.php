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
                                            Laporan Rata-rata Durasi Peminjaman Buku Berdasarkan Jenis
                                        </center>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    
                                    <form action="{{route('cetakrata')}}" method="get">
@csrf
                                         <button  class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button>  
                                    </form>
                                 
 
 
<div class="table-responsive3"> 
<table class="table" id="table3"> 
<thead> 
<tr>
<th>Jenis Buku</th> 
<th>Rata-rata Lamanya Dipinjam (hari)</th>
</tr>
</thead>
@foreach($jenisRataRata as $jenis => $rataRata)
<tr>
    <td>{{ $jenis }}</td>
    <td>{{ $rataRata }}</td>
</tr>
@endforeach
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
                                            Laporan Jumlah Total Peminjaman Buku

                                        </center>
                                    </h5>
                                </div>
                                <div class="card-body">
                                     <form action="{{route('cetakratabuku')}}" method="get">
                                        @csrf
                                    <button   class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button>
                                    </form>
                                   
 <div class="table-responsive"> 
 <table class="table" id="table2"> 
 <thead> 
 <tr> 
 <th>Bulan Peminjaman</th> 
 <th>Total Peminjaman Buku</th> 
 </tr> 
 </thead> 
 @foreach ($data_per_bulan as $item)
 <tr>
     <td>{{ $item->bulan_peminjaman }}</td>
     <td>{{ $item->total_peminjaman }}</td>
 </tr>
@endforeach
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
                                            Laporan Rata-rata Durasi Peminjaman Buku Berdasarkan Jenis
                                        </center>
                                    </h5>
                                </div>
 
                                <div class="card-body">
                                    <form action="{{route('cetakratajenis')}}" method="get">
                                        @csrf
                                    <button   class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button>
                                    </form>
 <div class="table-responsive">
 <table class="table" id="table1">
 <thead>
 <tr>
 <th>Judul Buku</th>
 <th>Jumlah Total Peminjaman</th>
 </tr>
 </thead>
 @foreach ($datariwayat as $item)
 <tr>
     <td>{{ $item->judul }}</td>
     <td>{{ $item->total_peminjaman }}</td>
 </tr>
@endforeach
 </table>
 </div>
 


                                </div>
                            </div>
                        </section>

                    </div>


            </div>
 
        </div>
    </div>

 @endsection