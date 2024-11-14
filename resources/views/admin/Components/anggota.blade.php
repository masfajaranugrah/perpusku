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

            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-md-12">
                        <section class="section">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                    Anggota <button type="button" class="btn btn-outline-success"
                                            data-bs-toggle="modal" data-bs-target="#success">
                                            <i class="bi bi-plus"></i> Tambah Anggota
                                        </button>

                                        <!-- form Tambah jenis -->
                                        <div class="modal fade text-left" id="success" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel160" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title white" id="myModalLabel160">
                                                            Tambah Anggota
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>



                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form form-vertical" method="post" action="{{ route('anggota.store') }}">
                                                                    @csrf <!-- Add CSRF token for security -->
                                                                
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="nama">Nama</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" id="nama" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-user"></i>                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email">Email</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email" id="email" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-envelope"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="telepon">Telepon</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="tel" name="telepon" class="form-control" placeholder="Masukkan Nomor Telepon" id="telepon" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-mobile"></i>                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="angkatan">Angkatan</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="angkatan" class="form-control" placeholder="Masukkan Angkatan" id="angkatan" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-ranking-star"></i>                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="alamat">Alamat</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" id="alamat" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-map-pin"></i>                                                                                        </div>
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
                                        <!--end tambah jenis -->
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                            <th>Nomor Anggota</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Angkatan</th>
                                                <th>Alamat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $anggota as $data )
                                            <tr>
                                                <td>{{$data->id_anggota}}</td>
                                                    <td>{{$data->nama}}</td>
                                                    <td>{{$data->email}}</td>
                                                    <td>{{$data->telepon}}</td>
                                                    <td>{{$data->angkatan}}</td>
                                                    <td>{{$data->alamat}}</td>
                                                    <td>
                                                    <a href="{{route('peminjaman.anggota', $data->id_anggota)}}" class="btn icon icon-left btn-success"><i class="bi bi-eye"></i>
                                    Riwayat  </a>  
                                                        <button type="button" class="btn btn-outline-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#warning-{{$data->id_anggota}}"><i
                                                                class="bi bi-eye"></i> Edit
                                                        </button>
                                                             
                                                                    <form id="delete-form-{{ $data->id_anggota }}" action="{{ route('petugasanggota.destroy', $data->id_anggota) }}" method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn icon icon-left btn-danger delete-button" onclick="confirmDelete('{{ $data->id_anggota }}')">
                                                                            <i class="bi bi-trash"></i> Hapus
                                                                        </button>
                                                                    </form>
                                                                  
                                            </tr>

                                          @endforeach
                                        </tbody>
                                    </table>
                                         
                                            
                                                @foreach ( $anggota as $data)
                                                           <!-- form edit jenis -->
                                                    <div class="modal fade text-left" id="warning-{{$data->id_anggota}}"
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-warning">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Edit Anngota
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>



                                                                <div class="modal-body">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <form action="{{ route('anggota.update', $data->id_anggota) }}" method="POST">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="form-body">
                                                                                    <div class="row">
                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="first-name-icon">Nama
                                                                                                    </label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text" hidden
                                                                                                        name="id_anggota"
                                                                                                        class="form-control"
                                                                                                        value="{{$data->id_anggota}}"
                                                                                                        id="first-name-icon">

                                                                                                    <input type="text"
                                                                                                        name="nama"
                                                                                                        class="form-control"
                                                                                                        value="{{$data->nama}}"
                                                                                                        id="first-name-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i class="fa-solid fa-user"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        </div>

                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Email</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        name="email"
                                                                                                        value="{{$data->email}}"
                                                                                                        class="form-control"
                                                                                                        placeholder="Pengarang"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i class="fa-solid fa-envelope"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Telepon</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="number"
                                                                                                        name="telepon"
                                                                                                         value="{{$data->telepon}}"
                                                                                                        class="form-control"
                                                                                                       
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i class="fa-solid fa-mobile"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12">
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Angkatan</label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text"
                                                                                                        name="angkatan"
                                                                                                        value="{{$data->angkatan}}"
                                                                                                        class="form-control"
                                                                                                       
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i class="fa-solid fa-ranking-star"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Alamat</label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text"
                                                                                                        name="alamat"
                                                                                                        value="{{$data->alamat}}"
                                                                                                        class="form-control"
                                                                                                       
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i class="fa-solid fa-map-pin"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        


                                                                                        <button type="submit"
                                                                                            class="btn btn-primary me-1 mb-1">Simpan</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Close</span>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end lihat detail buku -->
                                                @endforeach
                                             







                                </div>

                        </section>
                    </div>

                </section>
            </div>
 

        </div>
    </div>


    @endsection