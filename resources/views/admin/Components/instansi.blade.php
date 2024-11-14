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

            <div class="page-heading"></div>
            <div class="page-content">
                <section class="row">
                    <div class="col-md-12">
                        <section class="section">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body py-4 px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xl">
                                                    @if($instansi)
                                                    <img src="{{ $instansi->logo ? asset('storage/' . $instansi->logo) : asset('path/to/default/image.png') }}" alt="{{ $instansi->logo ?: 'Default Logo' }}" class="img-fluid chocolat-image" width="100">
                                                @else
                                                    <img src="{{ asset('path/to/default/image.png') }}" alt="Default Logo" class="img-fluid chocolat-image" width="100">
                                                @endif                                                </div>
                                                <div class="ms-3 name">
                                                    <h5 class="font-bold">{{ $instansi ? $instansi->nama : '' }}</h5>
                                                    <h6 class="text-muted mb-0">{{ $instansi ? $instansi->keterangan : '' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="list-group list-group-horizontal-sm mb-1 text-center" role="tablist">
                                                    <a class="list-group-item list-group-item-action active" id="list-sunday-list" data-bs-toggle="list" href="#list-sunday" role="tab">Identitas Instansi</a>
                                                    <a class="list-group-item list-group-item-action" id="list-monday-list" data-bs-toggle="list" href="#list-monday" role="tab">Edit Identitas Instansi</a>
                                                </div>
                                                <div class="tab-content text-justify">
                                                    <div class="tab-pane fade show active" id="list-sunday" role="tabpanel" aria-labelledby="list-sunday-list">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form class="form form-vertical">
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="first-name-icon">NAMA INSTANSI</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" class="form-control" readonly value="{{ $instansi ? $instansi->nama : '' }}" id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-pin"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="mobile-id-icon">KETERANGAN</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" class="form-control" readonly value="{{ $instansi ? $instansi->keterangan : '' }}" id="mobile-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-book"></i>
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

                                                    <div class="tab-pane fade" id="list-monday" role="tabpanel" aria-labelledby="list-monday-list">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form class="form form-vertical" method="post" action="{{ route('store') }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="first-name-icon">NAMA INSTANSI</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" hidden class="form-control" name="id_instansi" value="{{ $instansi ? $instansi->id_instansi : '' }}">
                                                                                        <input type="text" class="form-control" name="nama" value="{{ $instansi ? $instansi->nama : '' }}" id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-pin"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="mobile-id-icon">KETERANGAN</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" class="form-control" name="keterangan" value="{{ $instansi ? $instansi->keterangan : '' }}" id="mobile-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-book"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="formFileMultiple" class="form-label">Masukkan Foto Baru</label>
                                                                                    <input class="form-control" type="file" name="logo" id="formFileMultiple">
                                                                                    
                                                                                    <!-- Teks untuk gambar sebelumnya -->
                                                                                    <label for="foto" class="form-label mt-3">Gambar Sebelumnya</label>
                                                                                    
                                                                                    <!-- Menampilkan gambar sebelumnya atau gambar default -->
                                                                                    <div class="mt-2">
                                                                                        @if (isset($instansi) && $instansi->logo)
                                                                                        <img src="{{ asset('storage/' . $instansi->logo) }}" 
                                                                                             alt="Logo {{ $instansi->logo }}" 
                                                                                             class="img-fluid" 
                                                                                             style="max-width: 10%; border-radius: 10px;">
                                                                                    @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12 d-flex justify-content-end">
                                                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
