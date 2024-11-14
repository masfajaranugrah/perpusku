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
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <center>
                                                Pedoman Penggunaan Aplikasi
                                            </center>
                                        </h5>
                                    </div>



                                    <div class="card-body">

                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        <b>Peminjaman Buku</b>
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ol>
                                                            <li> Pastikan untuk melakukan login terlebih dahulu sebelum
                                                                menggunakan fitur-fitur aplikasi.</li>
                                                            <li> Untuk melakukan peminjaman buku, pilih menu
                                                                " <a href="peminjaman.php" class='sidebar-link'>
                                                                    <i class="bi bi-server"></i>
                                                                    <span>Peminjaman </span>
                                                                </a>" di halaman utama.</li>
                                                            <li> Masukkan ID anggota pada kolom yang tersedia, kemudian
                                                                klik tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kirim</button>
                                                                ".</li>
                                                            <li> Jika ID anggota sesuai dan benar, Anda akan dialihkan
                                                                ke halaman "Buat Peminjaman".</li>
                                                            <li> Pada halaman "Buat Peminjaman", masukkan ID buku yang
                                                                ingin dipinjam, lalu klik tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kirim</button>
                                                                ".</li>
                                                            <li> Jika ID buku benar dan sesuai, akan ditampilkan daftar
                                                                nama buku yang akan dipinjam.</li>
                                                            <li> Setelah semua buku dipindai, klik tombol "Buat
                                                                Peminjaman" untuk menyelesaikan proses.</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                        <b>Pengembalian Buku</b>
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ol>
                                                            <li>Pilih menu " <a href="pengembalian.php"
                                                                    class='sidebar-link'>
                                                                    <i class="bi bi-clipboard-check"></i>
                                                                    <span>Pengembalian</span>
                                                                </a> " di aplikasi.</li>
                                                            <li>Masukkan ID pengguna pada kolom yang tersedia, kemudian
                                                                klik tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kirim</button>
                                                                ".</li>
                                                            <li>Jika ID pengguna sesuai dan benar, Anda akan dialihkan
                                                                ke halaman "Buat Pengembalian".</li>
                                                            <li>Pada halaman "Buat Pengembalian", akan ditampilkan tabel
                                                                data berisi informasi peminjaman buku yang belum
                                                                dikembalikan.</li>
                                                            <li>Jika ada buku yang belum dikembalikan, Anda dapat
                                                                melihat detailnya dan kemudian menekan tombol
                                                                "Kembalikan".</li>
                                                            <li>Setelah menekan tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kembalikan</button>
                                                                ", akan muncul pop-up
                                                                untuk menampilkan detail peminjaman tersebut.</li>
                                                            <li>Selanjutnya, tekan tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kembalikan</button>
                                                                " untuk
                                                                menyelesaikan proses pengembalian.</li>
                                                        </ol>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        <b>Tambah Buku</b>
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            <li>Pilih menu " <a href="data-buku.php"
                                                                    class='sidebar-link'>
                                                                    <i class="bi bi-inbox"></i>
                                                                    <span>Data Buku</span>
                                                                </a> " di aplikasi.</li>
                                                            <li>Pada bagian atas, klik tombol " <button type="button"
                                                                    class="btn btn-outline-success"
                                                                    data-bs-toggle="modal" data-bs-target="#success">
                                                                    <i class="bi bi-plus"></i> Tambah Buku
                                                                </button> ".</li>
                                                            <li>Setelah menekan tombol " <button type="button"
                                                                    class="btn btn-outline-success"
                                                                    data-bs-toggle="modal" data-bs-target="#success">
                                                                    <i class="bi bi-plus"></i> Tambah Buku
                                                                </button> ", akan muncul sebuah
                                                                formulir.</li>
                                                            <li>Isi formulir sesuai dengan ketentuan yang sudah ada,
                                                                seperti judul buku, pengarang, jenis buku, jumlah, tahun
                                                                terbit, dll.</li>
                                                            <li>Untuk jenis buku, pilih dari opsi yang sudah tersedia
                                                                atau tambahkan jenis baru dengan menekan tombol "Tambah
                                                                Jenis" atau edit jenis yang sudah ada dengan tombol
                                                                "Edit Jenis".</li>
                                                            <li>Kemudian, klik tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kirim</button> "
                                                                untuk menyimpan data buku
                                                                yang baru ditambahkan.</li>
                                                        </ul>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFor">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFor"
                                                        aria-expanded="false" aria-controls="collapseFor">
                                                        <b>Tambah Anggota</b>
                                                    </button>
                                                </h2>
                                                <div id="collapseFor" class="accordion-collapse collapse"
                                                    aria-labelledby="headingFor" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            <li>Pilih menu " <a href="anggota.php" class='sidebar-link'>
                                                                    <i class="bi bi-people"></i>
                                                                    <span>Anggota </span>
                                                                </a> " di aplikasi.</li>
                                                            <li>Pada halaman anggota, klik tombol " <button
                                                                    type="button" class="btn btn-outline-success"
                                                                    data-bs-toggle="modal" data-bs-target="#success">
                                                                    <i class="bi bi-plus"></i> Tambah Anggota
                                                                </button> ".</li>
                                                            <li>Setelah menekan tombol " <button type="button"
                                                                    class="btn btn-outline-success"
                                                                    data-bs-toggle="modal" data-bs-target="#success">
                                                                    <i class="bi bi-plus"></i> Tambah Anggota
                                                                </button> ", akan muncul
                                                                sebuah formulir.</li>
                                                            <li>Isi formulir dengan informasi anggota sesuai ketentuan,
                                                                seperti nama, email, telepon, angkatan, alamat, dll.
                                                            </li>
                                                            <li>Kemudian, klik tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kirim</button> "
                                                                untuk menyimpan data
                                                                anggota yang baru ditambahkan.</li>
                                                        </ul>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                        aria-expanded="false" aria-controls="collapseFive">
                                                        <b>Cetak Laporan</b>
                                                    </button>
                                                </h2>
                                                <div id="collapseFive" class="accordion-collapse collapse"
                                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            <li>Pilih menu " <a href="#" class='sidebar-link'>
                                                                    <i class="bi bi-memory"></i>
                                                                    <span>Laporan</span>
                                                                </a> " di aplikasi.</li>
                                                            <li>Pilih salah satu dari jenis laporan yang ingin dicetak:
                                                                peminjaman, data buku, atau denda.</li>
                                                            <li>Pada halaman laporan yang dipilih, akan ditampilkan
                                                                tabel dengan data yang sesuai.</li>
                                                            <li>Diatas tabel, akan ada tombol "<button
                                                                    onclick="cetakLaporan2()"
                                                                    class="btn icon icon-left btn-success"><i
                                                                        data-feather="check-circle"></i>Cetak Laporan
                                                                    PDF</button> ".</li>
                                                            <li>Klik tombol " <button onclick="cetakLaporan2()"
                                                                    class="btn icon icon-left btn-success"><i
                                                                        data-feather="check-circle"></i>Cetak Laporan
                                                                    PDF</button> " untuk memulai proses
                                                                pencetakan laporan.</li>
                                                            <li>Setelah menekan tombol, Anda akan diarahkan ke halaman
                                                                untuk mencetak laporan dalam format PDF.</li>
                                                            <li>Pada halaman tersebut, Anda dapat memilih opsi cetak
                                                                untuk mencetak laporan sesuai kebutuhan.</li>
                                                        </ul>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>



                    </div>


            </div>
 
        </div>
    </div>

 @endsection