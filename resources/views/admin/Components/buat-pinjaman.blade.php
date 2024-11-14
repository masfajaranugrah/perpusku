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
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-primary">
                                    <h4 class="alert-heading">Nama: {{ $anggota->nama }}</h4>
                                    <p>ID: {{ $anggota->id_anggota }}</p>
                                </div>

                                <!-- Form untuk menambahkan ID buku -->
                                <form id="peminjamanForm" method="POST" action="{{ route('peminjaman.store') }}">
                                    @csrf
                                    <input type="hidden" name="id_anggota" value="{{ $anggota->id_anggota }}">
                                    
                                    <!-- Dropdown untuk memilih Buku -->
                                    <div class="row">
                                        <div class="col-sm-10 mb-1">
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">Buku</span>
                                                <select name="id_buku" id="inputBookId" class="form-control">
                                                    <option value="">-- Pilih Buku --</option>
                                                    @foreach ($buku as $a)
                                                        <option value="{{ $a->id_buku }}">{{ $a->kode_buku }} - {{ $a->judul }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 mb-1">
                                            <button type="button" id="btnAddBook" class="btn btn-outline-info btn-lg">Tambah</button>
                                        </div>
                                    </div>

                                    <!-- List Buku yang akan dipinjam -->
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div id="bookList" class="mt-3"></div>
                                        </div>
                                    </div>

                                    <!-- Tombol Kirim untuk menyimpan data peminjaman -->
                                    <div class="mt-3">
                                        <button type="submit" class="btn icon icon-left btn-success btn-lg">
                                            <i data-feather="check-circle"></i> Buat Peminjaman
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk menangani penambahan buku ke dalam daftar -->
    <script>
        document.getElementById('btnAddBook').addEventListener('click', function() {
            const bookIdInput = document.getElementById('inputBookId');
            const bookList = document.getElementById('bookList');

            if (bookIdInput.value) {
                // Cek jika buku sudah ditambahkan sebelumnya
                const existingBooks = document.querySelectorAll('input[name="id_buku[]"]');
                let isDuplicate = false;
                existingBooks.forEach(function(book) {
                    if (book.value === bookIdInput.value) {
                        isDuplicate = true;
                    }
                });

                if (!isDuplicate) {
                    // Tambahkan ID buku ke dalam input hidden
                    const inputHidden = document.createElement('input');
                    inputHidden.type = 'hidden';
                    inputHidden.name = 'id_buku[]'; // Menyimpan ID buku sebagai array
                    inputHidden.value = bookIdInput.value;

                    document.getElementById('peminjamanForm').appendChild(inputHidden);

                    // Tambahkan buku ke dalam daftar tampilan
                    const listItem = document.createElement('div');
                    listItem.classList.add('alert', 'alert-secondary', 'mb-2');
                    listItem.innerText = `Buku ID:  ${bookIdInput.options[bookIdInput.selectedIndex].text}`;
                    bookList.appendChild(listItem);

                    // Reset dropdown setelah penambahan buku
                    bookIdInput.value = '';
                } else {
                    alert('Buku sudah ditambahkan ke daftar.');
                }
            }
        });
    </script>
@endsection
