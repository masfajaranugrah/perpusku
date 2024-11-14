{{-- @include('Admin.AdminDashboard._side') --}}
@extends('layouts.app') 

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
                                         <button type="button" class="btn btn-outline-success"
                                            data-bs-toggle="modal" data-bs-target="#success">
                                            <i class="bi bi-plus"></i>  Tambah Pengurus
                                        </button>

                                        <!-- form Tambah jenis -->
                                        <div class="modal fade text-left" id="success" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel160" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title white" id="myModalLabel160">
                                                            Tambah Pengurus
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>



                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form form-vertical" method="post" action="{{route('pengurus.store')}}">
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="first-name-icon">Nama</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-user"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Email</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="email" name="email" class="form-control" placeholder="@gmail.com" id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-envelope"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="username-icon">Username</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" id="username-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-regular fa-user"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="password-icon">Password</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" id="password-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-eye"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="phone-icon">Telepon</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="number" name="telepon" class="form-control" placeholder="Masukkan Nomor Telepon" id="phone-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-phone"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="address-icon">Alamat</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" id="address-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="fa-solid fa-map-pin"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="jabatan">Jabatan</label>
                                                                                    <div class="position-relative">
                                                                                        <select class="form-control" name="jabatan" id="jabatan" required>
                                                                                            <option value="Admin">Admin</option>
                                                                                            <option value="Petugas">Petugas</option>
                                                                                        </select>
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-people"></i>
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
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                
                                        <tbody>
                                            @foreach ($anggota as $data)
                                                <tr>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->username }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->telepon }}</td>
                                                    <td>{{ $data->alamat }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-warning"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#warning-{{ $data->id_pengurus }}">
                                                            <i class="bi bi-eye"></i> Edit
                                                        </button>
                                                        <form id="delete-form-{{ $data->id_pengurus }}" action="{{ route('admin.destroy', $data->id_pengurus) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn icon icon-left btn-danger delete-button" onclick="confirmDelete({{ $data->id_pengurus }})">
                                                                <i class="bi bi-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                      
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @foreach ($anggota as $data)
                                <!-- form edit jenis -->
                                <div class="modal fade" id="warning-{{ $data->id_pengurus }}" tabindex="-1" role="dialog" 
                                     aria-labelledby="myModalLabel160" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title white" id="myModalLabel160">Edit Pengurus</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                            
                                            <div class="modal-body">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update', $data->id_pengurus) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="first-name-icon">Nama</label>
                                                                            <div class="position-relative">
                                                                                <input type="hidden" name="id_anggota" class="form-control" value="{{ $data->id_pengurus }}" id="first-name-icon">
                                                                                <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" id="first-name-icon">
                                                                                <div class="form-control-icon">
                                                                                    <i class="bi bi-people"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                            
                                                                    <div class="col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="email-id-icon">Email</label>
                                                                            <div class="position-relative">
                                                                                <input type="text" name="email" class="form-control" value="{{ $data->email }}" id="email-id-icon">
                                                                                <div class="form-control-icon">
                                                                                    <i class="bi bi-envelope"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                            
                                                                    <div class="col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="username-icon">Username</label>
                                                                            <div class="position-relative">
                                                                                <input type="text" name="username" class="form-control" value="{{ $data->username }}" id="username-icon">
                                                                                <div class="form-control-icon">
                                                                                    <i class="bi bi-gear"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                            
                                                                    <div class="col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="password-icon">Password</label>
                                                                            <div class="position-relative">
                                                                                <input type="text" name="password" class="form-control" id="password-icon">
                                                                                <div class="form-control-icon">
                                                                                    <i class="bi bi-key"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                            
                                                                    <div class="col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="telepon-id-icon">Telepon</label>
                                                                            <div class="position-relative">
                                                                                <input type="number" name="telepon" class="form-control" value="{{ $data->telepon }}" id="telepon-id-icon">
                                                                                <div class="form-control-icon">
                                                                                    <i class="fa-solid fa-phone"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                            
                                                                    <div class="col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="alamat-id-icon">Alamat</label>
                                                                            <div class="position-relative">
                                                                                <input type="text" name="alamat" class="form-control" value="{{ $data->alamat }}" id="alamat-id-icon">
                                                                                <input type="text" name="jabatan" hidden class="form-control" value="{{ $data->jabatan }}" id="jabatan-id-icon">
                                                                                <div class="form-control-icon">
                                                                                    <i class="fa-solid fa-map-pin"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                            
                                                                    <div class="col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="jabatan">Jabatan</label>
                                                                            <div class="position-relative">
                                                                                <select class="form-control" name="jabatan" id="jabatan" required>
                                                                                    <option value="Admin">Admin</option>
                                                                                    <option value="Petugas">Petugas</option>
                                                                                </select>
                                                                                <div class="form-control-icon">
                                                                                    <i class="bi bi-people"></i>
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
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                












                        </section>
                    </div>

                </section>
            </div>
        

        </div>
    </div>

@endsection