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
                                    jenis <button type="button" class="btn btn-outline-success"
                                            data-bs-toggle="modal" data-bs-target="#success">
                                            <i class="bi bi-plus"></i> Tambah jenis
                                        </button>

                                        <!-- form Tambah jenis -->
                                        <div class="modal fade text-left" id="success" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel160" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title white" id="myModalLabel160">
                                                            Tambah jenis
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>



                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form form-vertical" method="post"
                                                                    action="{{route('aturan-denda.store')}}">
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="first-name-icon">Nama
                                                                                    jenis</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="jenis"
                                                                                            class="form-control"
                                                                                            placeholder="Novel"
                                                                                            id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-book"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Lama
                                                                                        Peminjaman</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            name="hari_terlambat"
                                                                                            class="form-control"
                                                                                            placeholder="masukan angka berapa hari"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-calendar-event"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Biaya
                                                                                        Denda Perhari</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            name="biaya_per_hari"
                                                                                            class="form-control"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-currency-dollar"></i>
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
                                                <th>Nama jenis</th>
                                                <th>Batas Waktu Peminjaman</th>
                                                <th>Nominal Denda Perhari</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jenis as $data )
                                                <tr>
                                                <td>{{$data->jenis}}</td>
                                                <td>{{$data->hari_terlambat}}  Hari</td>
                                                <td>
                                          

                                                      Rp.  {{$data->biaya_per_hari}}

                                                <td>


                                                    <button type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#warning-{{$data->jenis}}"><i
                                                            class="bi bi-eye"></i> Edit</button>
                                                            {{-- <form action="{{ route('aturan-denda.destroy', $data->jenis) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form> --}}
                                                            <form id="delete-form-{{ $data->jenis }}" action="{{ route('aturan-denda.destroy', $data->jenis) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $data->jenis }}')">Delete</button>
                                                            </form>
                                                            
                                                        </td>
                                                    </tr>  
                                            @endforeach
 
                                          
        
                                                  
                                                </tbody>
 


                                                @foreach ($jenis as $data )

                                                    <!-- form edit jenis -->
                                                    <div class="modal fade text-left" id="warning-{{$data->jenis}}"
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-warning">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Edit jenis
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>



                                                                <div class="modal-body">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <form action="{{ route('aturan-denda.update', $data->jenis) }}" method="POST">
                                                                                @csrf
                                                                                @method('PUT')
                                                                          
                                                                                <div class="form-body">
                                                                                    <div class="row">
                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="first-name-icon">Nama
                                                                                                    jenis</label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text"
                                                                                                        name="jenis"
                                                                                                        class="form-control"
                                                                                                        value="{{$data->jenis}}"
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
                                                                                                    for="email-id-icon">Batas
                                                                                                    Waktu
                                                                                                    Peminjaman</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        name="hari_terlambat"
                                                                                                        value="{{$data->hari_terlambat}}"
                                                                                                        class="form-control"
                                                                                                        placeholder="Pengarang"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-calendar-heart"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Biaya
                                                                                                    Perhari</label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text"
                                                                                                        name="biaya_per_hari"
                                                                                                        value="{{$data->biaya_per_hari}}"
                                                                                                        class="form-control"
                                                                                                        placeholder="Biaya Perhari"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-window"></i>
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





 
                                    </table>

                                </div>

                        </section>
                    </div>

                </section>
            </div>
 
        </div>
    </div>
    @endsection
