<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\Err\ErrController;
// admin 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\PanduanController;
use App\Http\Controllers\Admin\DataBukuController;
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\Admin\PengaturanBukuController;
use App\Http\Controllers\Admin\RiwayatPeminjamanController;
use App\Http\Controllers\Admin\RiwayatBukuController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\instansiController;
use App\Http\Controllers\Cetak\CetakPeminjamanController;
use App\Http\Controllers\Cetak\CetakLaporanRataController;
use App\Http\Controllers\Cetak\CetakJumlahBukuController;
use App\Http\Controllers\Cetak\CetakRataJenisController;
use App\Http\Controllers\Cetak\CetakLaporanDendaController;
use App\Http\Controllers\Cetak\CetakLaporanDendaAnggotaController;
use App\Http\Controllers\Petugas\PetugasController;


// petugas 
 
use App\Http\Controllers\Petugas\PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PetugasAnggotaController;
use App\Http\Controllers\Petugas\PetugasPengembalianController;
use App\Http\Controllers\Petugas\PetugasDataBukuController;
use App\Http\Controllers\Petugas\PetugasPanduanController;
use App\Http\Controllers\Petugas\PetugasRiwayatPeminjamanController;
use App\Http\Controllers\Petugas\PetugasRiwayatBukuController;
use App\Http\Controllers\Petugas\PetugasDendaController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', [DashboardController::class, 'index']) ;
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest')  ;
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest') ;
Route::get('/403', [ErrController::class, 'index'])->name('err403');

Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth','Role:Admin'])->group(function () {

// dasboard admin 
Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin-index');

// anggota 
 Route::get('/admin/anggota', [AnggotaController::class, 'index'])->name('anggota');
 Route::post('/admin/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
 Route::put('/admin/anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
 Route::delete('/admin/anggota/delete/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
 Route::get('/admin/riwayat-peminjaman-anggota/{id_anggota}', [AnggotaController::class, 'riwayat'])->name('peminjaman.anggota');


//  denda 
Route::get('/admin/denda', [DendaController::class, 'index'])->name('denda');


Route::get('/admin/panduan', [PanduanController::class, 'index'])->name('panduan');


// pengembalian 
Route::get('/admin/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian');
Route::get('/admin/pengembalian/create/{id_anggota}', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::post('/admin/pengembalian/check-anggota', [PengembalianController::class, 'checkAnggota'])->name('check-anggota-pengembalian');
Route::patch('/admin/pengembalian/{id_peminjaman}', [PengembalianController::class, 'update'])->name('pengembalian.update');



// pengaturan buku 
Route::get('/admin/pengaturan-buku', [PengaturanBukuController::class, 'index'])->name('pengaturan');
Route::post('/admin/aturan-denda', [PengaturanBukuController::class, 'store'])->name('aturan-denda.store');
Route::put('/admin/aturan-denda/{jenis}', [PengaturanBukuController::class, 'update'])->name('aturan-denda.update');
Route::delete('/admin/aturan-denda/{jenis}', [PengaturanBukuController::class, 'destroy'])->name('aturan-denda.destroy');



Route::get('/admin/riwayat-peminjaman', [RiwayatPeminjamanController::class, 'index'])->name('riwayat-peminjaman');
Route::get('/admin/riwayat-buku', [RiwayatBukuController::class, 'index'])->name('riwayat-buku');
Route::get('/admin/admin', [PengurusController::class, 'index'])->name('admin');
Route::get('/admin/instansi', [instansiController::class, 'index'])->name('instansi');


// peminjaman 
Route::get('/admin/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman');
Route::post('/admin/peminjaman/check-anggota', [PeminjamanController::class, 'checkAnggota'])->name('check-anggota');
Route::get('/admin/peminjaman/create/{id_anggota}', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/admin/peminjaman/check-book', [PeminjamanController::class, 'checkBook'])->name('check-book');
Route::post('/admin/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');


 
// data buku
Route::get('/admin/data-buku', [DataBukuController::class, 'index'])->name('databuku');
Route::post('/admin/buku/store', [DataBukuController::class, 'store'])->name('buku.store');
Route::delete('/admin/buku/{id_buku}', [DataBukuController::class, 'destroy'])->name('buku.destroy');
Route::post('/admin/buku/update/{id_buku}', [DataBukuController::class, 'update'])->name('buku.update');

Route::post('/admin/instansi/store', [InstansiController::class, 'store'])->name('store');

Route::post('/admin/pengurus/create', [PengurusController::class, 'store'])->name('pengurus.store');
Route::put('/admin/admin/update/{id_admin}', [PengurusController::class, 'update'])->name('admin.update');
Route::delete('/admin/admin/{id_admin}', [PengurusController::class, 'destroy'])->name('admin.destroy');

Route::post('/admin/peminjaman/hapus', [RiwayatPeminjamanController::class, 'destroy'])->name('peminjaman.destroy');


});

Route::middleware(['auth', 'Role:Admin,Petugas'])->group(function () {
    // cetak pdf
    Route::get('/admin/laporan-peminjaman', [CetakPeminjamanController::class, 'generateReport'])->name('cetakpeminjaman');
    Route::get('/admin/laporan-rata-rata', [CetakLaporanRataController::class, 'generateReport'])->name('cetakrata');
    Route::get('/admin/laporan-cetakratabuku', [CetakJumlahBukuController::class, 'generateReport'])->name('cetakratabuku');
    Route::get('/admin/laporan-cetakratajenis', [CetakRataJenisController::class, 'generateReport'])->name('cetakratajenis');
    Route::get('/admin/laporan-cetakdenda', [CetakLaporanDendaController::class, 'generatePDF'])->name('cetakanggota');
    Route::get('/admin/laporan-cetakdendaanggota', [CetakLaporanDendaAnggotaController::class, 'generatePdf'])->name('cetakdendaanggota');
});


Route::middleware(['auth','Role:Petugas'])->group(function () {
// Pertugas route 
Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('dashboardpetugas');

//anggota 
Route::get('/petugas/anggota', [PetugasAnggotaController::class, 'index'])->name('anggotapetugas');
Route::post('/petugas/anggota/store', [PetugasAnggotaController::class, 'store'])->name('petugasanggota.store');
Route::put('/petugas/anggota/update/{id}', [PetugasAnggotaController::class, 'update'])->name('petugasanggota.update');
Route::delete('/petugas/anggota/delete/{id}', [PetugasAnggotaController::class, 'destroy'])->name('petugasanggota.destroy');
Route::get('/petugas/riwayat-peminjaman-anggota/{id_anggota}', [PetugasAnggotaController::class, 'riwayat'])->name('petugaspeminjaman.anggota');


// peminjaman 
Route::get('/petugas/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('petugaspeminjaman');
Route::post('/petugas/peminjaman/check-anggota', [PetugasPeminjamanController::class, 'checkAnggota'])->name('petugascheck-anggota');
Route::get('/petugas/peminjaman/create/{id_anggota}', [PetugasPeminjamanController::class, 'create'])->name('petugaspeminjaman.create');
Route::post('/petugas/peminjaman/check-book', [PetugasPeminjamanController::class, 'checkBook'])->name('petugascheck-book');
Route::post('/petugas/peminjaman/store', [PetugasPeminjamanController::class, 'store'])->name('petugaspeminjaman.store');
Route::get('/petugas/riwayat-peminjaman', [PetugasRiwayatPeminjamanController::class, 'index'])->name('petugasriwayat-peminjaman');


// pengembalian 
Route::get('/petugas/pengembalian', [PetugasPengembalianController::class, 'index'])->name('petugaspengembalian');
Route::get('/petugas/pengembalian/create/{id_anggota}', [PetugasPengembalianController::class, 'create'])->name('petugaspengembalian.create');
Route::post('/petugas/pengembalian/check-anggota', [PetugasPengembalianController::class, 'checkAnggota'])->name('petugascheck-anggota-pengembalian');
Route::patch('/petugas/pengembalian/{id_peminjaman}', [PetugasPengembalianController::class, 'update'])->name('petugaspengembalian.update');


 
// data buku
Route::get('/petugas/data-buku', [PetugasDataBukuController::class, 'index'])->name('petugasdatabuku');
Route::post('/petugas/buku/store', [PetugasDataBukuController::class, 'store'])->name('petugasbuku.store');
Route::delete('/petugas/buku/{id_buku}', [PetugasDataBukuController::class, 'destroy'])->name('petugasbuku.destroy');
Route::post('/petugas/buku/update/{id_buku}', [PetugasDataBukuController::class, 'update'])->name('petugasbuku.update');
Route::get('/petugas/riwayat-buku', [PetugasRiwayatBukuController::class, 'index'])->name('petugasriwayat-buku');

// panduan 
Route::get('/petugas/panduan', [PetugasPanduanController::class, 'index'])->name('petugaspanduan');


Route::get('/petugas/denda', [PetugasDendaController::class, 'index'])->name('petugasdenda');


// cetak pdf
// Route::get('/petugas/laporan-peminjaman', [CetakPeminjamanController::class, 'generateReport'])->name('cetakpeminjaman');
// Route::get('/petugas/laporan-rata-rata', [CetakLaporanRataController::class, 'generateReport'])->name('cetakrata');
// Route::get('/petugas/laporan-cetakratabuku', [CetakJumlahBukuController::class, 'generateReport'])->name('cetakratabuku');
// Route::get('/petugas/laporan-cetakratajenis', [CetakRataJenisController::class, 'generateReport'])->name('cetakratajenis');
// Route::get('/petugas/laporan-cetakdenda', [CetakLaporanDendaController::class, 'generatePDF'])->name('cetakanggota');
// Route::get('/petugas/laporan-cetakdendaanggota', [CetakLaporanDendaAnggotaController::class, 'generatePdf'])->name('cetakdendaanggota');
});