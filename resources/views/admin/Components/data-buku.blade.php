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
                        <section class="section">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Data Buku <button type="button" class="btn btn-outline-success"
                                            data-bs-toggle="modal" data-bs-target="#success">
                                            <i class="bi bi-plus"></i> Tambah Buku
                                        </button>
 
                                        <!-- form Tambah buku -->
                                        <div class="modal fade text-left" id="success" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel160" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title white" id="myModalLabel160">
                                                            Tambah Buku
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>



                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form form-vertical" method="post" action="{{ route('buku.store') }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="judul">Kode Buku</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="kode_buku" class="form-control" placeholder="Masukkan Kode Buku" id="judul" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-book"></i>
                                                                                        </div>
                                                                                 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="judul">Judul</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="judul" class="form-control" placeholder="Masukkan Judu Buku" id="judul" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-book"></i>
                                                                                        </div>
                                                                                        @error('judul')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="pengarang">Pengarang</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="pengarang" class="form-control" placeholder="Pengarang" id="pengarang" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-person"></i>
                                                                                        </div>
                                                                                        @error('pengarang')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="jenis">Jenis</label>
                                                                                    <div class="position-relative">
                                                                                        <select class="form-control" name="jenis" id="jenis" required>
                                                                                            <option value="">Pilih Jenis</option>
                                                                                            @foreach($jenis as $jenisbuku)
                                                                                                <option value="{{ $jenisbuku->jenis }}" {{ old('jenis') == $jenisbuku->jenis ? 'selected' : '' }}>
                                                                                                    {{ $jenisbuku->jenis }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-window"></i>
                                                                                        </div>
                                                                                        @error('jenis')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="jumlah">Jumlah</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" id="jumlah" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-calculator"></i>
                                                                                        </div>
                                                                                        @error('jumlah')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="tahun_terbit">Tahun Terbit</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="number" name="tahun_terbit" class="form-control" placeholder="Tahun Terbit" id="tahun_terbit" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-calendar"></i>
                                                                                        </div>
                                                                                        @error('tahun_terbit')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="tersedia">Jumlah Tersedia</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="number" name="tersedia" class="form-control" placeholder="Jumlah Tersedia" id="tersedia" required>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-tag"></i>
                                                                                        </div>
                                                                                        @error('tersedia')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group ">
                                                                                    <label for="foto" class="form-label">Masukkan Foto Buku</label>
                                                                                    <div class="position-relative">
                                                                                        <input class="form-control" name="foto" type="file" id="foto" required>
                                                                                        @error('foto')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
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
                                        <!--end tambah buku -->

                                    </h5>
                                </div>
                                <div class="card-body">
                                   

                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Kode Buku</th>
                                                <th>Nama</th>
                                                <th>Pengarang</th>
                                                <th>jenis</th>
                                                <th>Jumlah</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                               
                                        @foreach ( $buku as  $data)
                                            <tr>
                                            <td class="col-4" >
                                                <img src="{{ $data->foto ? asset('storage/' . $data->foto) : asset('path/to/default/image.png') }}" alt="{{ $data->foto ?: 'Default Logo' }}" class="img-fluid chocolat-image" width="100">

                                            </td>
                                            <td>{{$data->kode_buku}}</td>
                                                <td>{{$data->judul}}</td>
                                                <td>{{$data->pengarang}} </td>
                                                <td>{{$data->jenis}}</td>
                                                <td>{{$data->jumlah}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-primary view-button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#primary-{{$data->id_buku}}"
                                                        data-book-id=" "><i class="bi bi-eye"></i>
                                                        Lihat</button>

                                                
                                                    <button type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#warning-{{$data->id_buku}}"><i
                                                            class="bi bi-eye"></i> Edit</button>

                                                           
                                                            </form>   
                                                            <form id="delete-form-{{ $data->id_buku }}" action="{{ route('buku.destroy', $data->id_buku) }}"  method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $data->id_buku }}')">Delete</button>
                                                            </form>

                                                        
                                                </td>
                                                
                                            </tr>

  @endforeach
 
                                        </tbody>
                                      

                                            
                                        @foreach ( $buku as  $data)


                                                    <!-- lihat detail buku -->
                                                    <div class="modal fade text-left" id="primary-{{$data->id_buku}}"
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Detail Buku
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>



                                                                <div class="modal-body">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <form class="form form-vertical">
                                                                                <div class="form-body">
                                                                                    <div class="row">
                                                                           
                                                                                        <div class="col-12">
                                                                                            <center>
                                                                                             
                                                                                                    <img src="{{ $data->foto ? asset('storage/' . $data->foto) : asset('path/to/default/image.png') }}" alt="{{ $data->foto ?: 'Default Logo' }}" style="max-width: 50%; border-radius: 10px;"  >

                                                                                            </center>
                                                                                            <div class="col-12">

                                                                                                <div
                                                                                                    class="form-group has-icon-left">
                                                                                                    <label
                                                                                                        for="email-id-icon">Kode Buku</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input type="text"
                                                                                                            readonly
                                                                                                            value="{{$data->kode_buku}}"
                                                                                                            class="form-control"
                                                                                                            placeholder="Kode Buku"
                                                                                                            id="email-id-icon">
                                                                                                        <div
                                                                                                            class="form-control-icon">
                                                                                                            <i
                                                                                                                class="bi bi-person"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="first-name-icon">Judul</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        class="form-control"
                                                                                                        value="{{$data->judul}}"
                                                                                                        id="first-name-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-book"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
             
                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Pengarang</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        value="{{$data->pengarang}}"
                                                                                                        class="form-control"
                                                                                                        placeholder="Pengarang"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-person"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">jenis</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        value="{{$data->jenis}}"
                                                                                                        class="form-control"
                                                                                                        placeholder="jenis"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-window"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Jumlah</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        value="{{$data->jumlah}}"
                                                                                                        class="form-control"
                                                                                                        placeholder="Jumlah"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-calculator"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                       

                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Tahun
                                                                                                    Terbit</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        value="{{$data->tahun_terbit}}"
                                                                                                        class="form-control"
                                                                                                        placeholder="Tahun Terbit"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-calendar"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Tersedia</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        class="form-control"
                                                                                                        placeholder="Tersedia"
                                                                                                        id="email-id-icon"
                                                                                                        value="{{$data->tersedia}}">

                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-folder"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

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



                                                    @foreach ($buku as $data)
                                                    <!-- Form Edit Buku -->
                                                    <div class="modal fade text-left" id="warning-{{$data->id_buku}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-warning">
                                                                    <h5 class="modal-title white" id="myModalLabel160">Edit Buku</h5>
                                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                    
                                                                <div class="modal-body">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <form class="form form-vertical" method="POST" action="{{ route('buku.update', $data->id_buku) }}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="form-body">
                                                                                    <div class="row">
                                                                                        <div class="col-12 text-center">
                                                                                            <img src="{{ $data->foto ? asset('storage/' . $data->foto) : asset('path/to/default/image.png') }}" alt="{{ $data->foto ?: 'Default Logo' }}" class="img-fluid chocolat-image" width="100">
                                                                                        </div>
                                                    
                                                                                      
                                                                                        <div class="col-12">
                                                                                            <div class="form-group has-icon-left">
                                                                                                <label for="pengarang-{{$data->id_buku}}">Kode Buku</label>
                                                                                                <div class="position-relative">
                                                                                                    <input type="text" name="kode_buku" value="{{$data->kode_buku}}" class="form-control" placeholder="Pengarang" id="pengarang-{{$data->id_buku}}">
                                                                                                    <div class="form-control-icon">
                                                                                                        <i class="bi bi-person"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12">
                                                                                            <div class="form-group has-icon-left">
                                                                                                <label for="judul-{{$data->id_buku}}">Judul</label>
                                                                                                <div class="position-relative">
                                                                                                    <input type="hidden" name="id_buku" value="{{$data->id_buku}}">
                                                                                                    <input type="text" name="judul" class="form-control" value="{{$data->judul}}" id="judul-{{$data->id_buku}}">
                                                                                                    <div class="form-control-icon">
                                                                                                        <i class="bi bi-book"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    
                                                                                        <div class="col-12">
                                                                                            <div class="form-group has-icon-left">
                                                                                                <label for="pengarang-{{$data->id_buku}}">Pengarang</label>
                                                                                                <div class="position-relative">
                                                                                                    <input type="text" name="pengarang" value="{{$data->pengarang}}" class="form-control" placeholder="Pengarang" id="pengarang-{{$data->id_buku}}">
                                                                                                    <div class="form-control-icon">
                                                                                                        <i class="bi bi-person"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    
                                                                                        <div class="col-12">
                                                                                            <div class="form-group has-icon-left">
                                                                                                <label for="jenis-{{$data->id_buku}}">Jenis</label>
                                                                                                <div class="position-relative">
                                                                                                    <input type="text" name="jenis" value="{{$data->jenis}}" class="form-control" placeholder="Jenis" id="jenis-{{$data->id_buku}}">
                                                                                                    <div class="form-control-icon">
                                                                                                        <i class="bi bi-window"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    
                                                                                        <div class="col-12">
                                                                                            <div class="form-group has-icon-left">
                                                                                                <label for="jumlah-{{$data->id_buku}}">Jumlah</label>
                                                                                                <div class="position-relative">
                                                                                                    <input type="number" name="jumlah" value="{{$data->jumlah}}" class="form-control" placeholder="Jumlah" id="jumlah-{{$data->id_buku}}">
                                                                                                    <div class="form-control-icon">
                                                                                                        <i class="bi bi-calculator"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    
                                                                                        <div class="col-12">
                                                                                            <div class="form-group has-icon-left">
                                                                                                <label for="tahun_terbit-{{$data->id_buku}}">Tahun Terbit</label>
                                                                                                <div class="position-relative">
                                                                                                    <input type="number" name="tahun_terbit" value="{{$data->tahun_terbit}}" class="form-control" placeholder="Tahun Terbit" id="tahun_terbit-{{$data->id_buku}}">
                                                                                                    <div class="form-control-icon">
                                                                                                        <i class="bi bi-calendar"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    
                                                                                        <div class="col-12">
                                                                                            <div class="form-group has-icon-left">
                                                                                                <label for="tersedia-{{$data->id_buku}}">Tersedia</label>
                                                                                                <div class="position-relative">
                                                                                                    <input type="number" name="tersedia" class="form-control" placeholder="Tersedia" id="tersedia-{{$data->id_buku}}" value="{{$data->tersedia}}">
                                                                                                    <div class="form-control-icon">
                                                                                                        <i class="bi bi-folder"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    
                                                                                        <div class="col-12">
                                                                                            <div class="form-group  ">
                                                                                                <label for="foto-{{$data->id_buku}}" class="form-label">Masukkan Foto Buku Baru</label>
                                                                                                <div class="position-relative">
                                                                                                    <input class="form-control" name="foto" type="file" id="foto-{{$data->id_buku}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    
                                                                                        <div class="col-12 text-end">
                                                                                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Close</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Edit Buku Modal -->
                                                    @endforeach
                                                    




                                    </table>





                                     <!-- form edit buku -->
                                    <div class="modal fade text-left" id="warning" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                        Edit Buku
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>



                                                <div class="modal-body">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <form class="form form-vertical">
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <center>
 
                                                                            </center>
                                                                            <div class="form-group has-icon-left">
                                                                                <labelfor="first-name-icon">Judul</labelfor=>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                    name="judul"
                                                                                        class="form-control"
                                                                                        value=" "
                                                                                        placeholder="Belajar Coding"
                                                                                        id="first-name-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-book"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label
                                                                                    for="email-id-icon">Pengarang</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Pengarang"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-person"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label for="email-id-icon">jenis</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="jenisv"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-window"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label
                                                                                    for="email-id-icon">Jumlah</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Jumlah"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-calculator"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label for="email-id-icon">Jenis</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Jenis"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-tag"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label for="email-id-icon">Tahun
                                                                                    Terbit</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Tahun Terbit"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-calendar"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label
                                                                                    for="email-id-icon">Tersedia</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Tersedia"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-folder"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
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
                                    <!--end lihat detail buku -->

                                </div>
                            </div>

                        </section>
                    </div>

                </section>
            </div>
        

        </div>
    </div>

 @endsection