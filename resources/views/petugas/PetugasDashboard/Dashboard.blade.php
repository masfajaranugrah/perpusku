@extends('layouts.app')
{{-- @include('Petugas.PetugasDashboard._side', ['instansi' => $instansi])   --}}
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
               <div class="col-12 col-lg-9">
                   <div class="row">
  
                       <div class="col-6 col-lg-3 col-md-6">
                           <div class="card">
                               <div class="card-body px-4 py-4-5">
                                   <div class="row">
                                       <div
                                           class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                           <div class="stats-icon purple mb-2">
                                               <i class="iconly-boldShow"></i>
                                           </div>
                                       </div>
                                       <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                           <h6 class="text-muted font-semibold">Anggota</h6>
                                           <h6 class="font-extrabold mb-0">{{ $totalAnggota }}</h6>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <div class="col-6 col-lg-3 col-md-6">
                           <div class="card">
                               <div class="card-body px-4 py-4-5">
                                   <div class="row">
                                       <div
                                           class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                           <div class="stats-icon blue mb-2">
                                               <i class="iconly-boldProfile"></i>
                                           </div>
                                       </div>
                                       <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                           <h6 class="text-muted font-semibold">Pengurus</h6>
                                           <h6 class="font-extrabold mb-0">{{$totalAdmin}}</h6>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-6 col-lg-3 col-md-6">
                           <div class="card">
                               <div class="card-body px-4 py-4-5">
                                   <div class="row">
                                       <div
                                           class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                           <div class="stats-icon green mb-2">
                                               <i class="bi-book"></i>
                                           </div>
                                       </div>
                                       <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                           <h6 class="text-muted font-semibold">Jumlah Buku</h6>
                                           <h6 class="font-extrabold mb-0">{{$totalBuku}}</h6>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-6 col-lg-3 col-md-6">
                           <div class="card">
                               <div class="card-body px-4 py-4-5">
                                   <div class="row">
                                       <div
                                           class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                           <div class="stats-icon red mb-2">
                                               <i class="iconly-boldBookmark"></i>
                                           </div>
                                       </div>
                                       <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                           <h6 class="text-muted font-semibold">Kategori Buku</h6>
                                           <h6 class="font-extrabold mb-0">{{$jumlahKategori}}</h6>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-12">
                           <div class="card">
                               <div class="card-header">
                                   <h4>Grafik Peminjaman Buku</h4>
                               </div>
                               <div class="card-body">
                                   <canvas id="peminjamanChart" width="800" height="400"></canvas>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">

                       <div class="col-12 col-xl-12">
                           <div class="card">

                               <div class="card">
                                   <div class="card-header">
                                       <h5 class="card-title">
                                           Angggota Yang Jatoh tempo Belum Mengembalikan buku
                                       </h5>
                                   </div>
                                   <div class="card-body">
                                       <div class="table-responsive">
                                         
                                           <table class="table table-lg">
                                               <thead>
                                                   <tr>
                                                       <th>Nama</th>
                                                       <th>Tanggal Peminjaman</th>
                                                       <th>Denda</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   @forelse ($peminjaman as $row)
                                                       @php
                                                           $tanggalPeminjaman = \Carbon\Carbon::parse($row->tanggal_peminjaman);
                                                           $tanggalSekarang = \Carbon\Carbon::now();
                                                           $hariTerlambat = $tanggalSekarang->diffInDays($tanggalPeminjaman);
                                                           $hariTerlambatAturan = max(0, $hariTerlambat - optional($row->aturan_denda)->hari_terlambat);  
                                                           $denda = $hariTerlambatAturan * optional($row->aturan_denda)->biaya_per_hari;  
                                                       @endphp
                                                       <tr>
                                                           <td>{{ $row->anggota->nama }}</td>  
                                                           <td>{{ $tanggalPeminjaman->format('d-m-Y') }}</td>  
                                                           <td>{{ "Rp " . number_format($denda, 0, ',', '.') }}</td>
                                                       </tr>
                                                   @empty
                                                       <tr>
                                                           <td colspan="3">Tidak ada data peminjaman yang sesuai.</td>
                                                       </tr>
                                                   @endforelse
                                               </tbody>
                                               
                                           </table>
                                           
                                         
                                         

                                       </div>
                                   </div>
                               </div>

                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-12 col-lg-3">
                   <div class="card">
                       <div class="card-body py-4 px-4">
                           <div class="d-flex align-items-center">
                               <div class="avatar avatar-xl">
                                <img src="{{asset('assets/static/images/faces/user1.png')}}" alt="Face 1">                            </div>
                               <div class="ms-3 name">
                              
                            <h5>{{ $instansi ? $instansi->nama : '' }}</h5>
                            <h6>{{ $instansi ? $instansi->keterangan : '' }}</h6>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="card">
                       <div class="card-header">
                           <h4>Pengurus Perpus</h4>
                       </div>
                       <div class="card-content pb-4">
                           @foreach ($admins as $data)
                                 <div class="recent-message d-flex px-4 py-3">
                              <div class="avatar avatar-lg">
                                <img src="{{asset('assets/static/images/faces/user.png')}}">
                            </div>
                              <div class="name ms-4">
                              <h5 class="mb-1">{{$data->nama}}</h5>
                              <h6 class="text-muted mb-0">{{ '@' . $data->username }}</h6>
                           </div>
                              </div>
                           @endforeach
                        
</div>

                   </div>

               </div>
           </section>
       </div>
   

   </div>
</div>

<script>
   document.addEventListener("DOMContentLoaded", function () {
       // Ensure the chart's container exists
       const chartElement = document.getElementById('peminjamanChart');
       
       if (chartElement) {
           // Data from the controller
           const peminjamanData = @json($peminjamanData);

           // Preparing data for the chart
           const bulan = peminjamanData.map(data => `Bulan ${data.month}`);
           const jumlahPeminjaman = peminjamanData.map(data => data.count);

           const ctx = chartElement.getContext('2d');
           const chart = new Chart(ctx, {
               type: 'bar',
               data: {
                   labels: bulan,
                   datasets: [{
                       label: 'Jumlah Peminjaman Buku',
                       data: jumlahPeminjaman,
                       backgroundColor: 'skyblue'
                   }]
               },
               options: {
                   scales: {
                       y: {
                           beginAtZero: true
                       }
                   }
               }
           });

           console.log(peminjamanData);
       } else {
           console.error('Chart element not found.');
       }
   });
</script>

@endsection