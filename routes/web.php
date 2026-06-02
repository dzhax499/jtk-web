<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

// Public Pages
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/program-studi', [PublicController::class, 'programStudi'])->name('program-studi');
Route::get('/program-studi/d3', [PublicController::class, 'd3TeknikInformatika'])->name('d3');
Route::get('/program-studi/sarjana', [PublicController::class, 'sarjanaTerapan'])->name('sarjana');
Route::get('/profil-dosen', [PublicController::class, 'profilDosen'])->name('profil-dosen');
Route::get('/profil-dosen/{id}', [PublicController::class, 'detailDosen'])->name('detail-dosen');

// Halaman bagian Dava: Blade fetch API
Route::get('/berita', [PublicController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [PublicController::class, 'detailBerita'])->name('detail-berita');
Route::get('/prestasi', [PublicController::class, 'prestasi'])->name('prestasi');
Route::get('/akademik', [PublicController::class, 'akademik'])->name('akademik');
Route::get('/akreditasi', [PublicController::class, 'akreditasi'])->name('akreditasi');
Route::get('/visi-misi', [PublicController::class, 'visiMisi'])->name('visi-misi');

Route::get('/arsip/berita', [PublicController::class, 'arsipBerita'])->name('arsip-berita');
Route::get('/arsip/prestasi', [PublicController::class, 'arsipPrestasi'])->name('arsip-prestasi');

// Tentang JTK Pages
Route::get('/tentang-jtk', [PublicController::class, 'tentangJTK'])->name('tentang-jtk');
Route::get('/fasilitas', [PublicController::class, 'fasilitas'])->name('fasilitas');
Route::get('/struktur-organisasi', [PublicController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
Route::get('/hasil-penelitian', [PublicController::class, 'hasilPenelitian'])->name('hasil-penelitian');
Route::get('/riwayat-singkat', [PublicController::class, 'riwayatSingkat'])->name('riwayat-singkat');
Route::get('/produk', [PublicController::class, 'produk'])->name('produk');
Route::get('/tenaga-kependidikan', [PublicController::class, 'tenagaKependidikan'])->name('tenaga-kependidikan');
Route::get('/reputasi', [PublicController::class, 'reputasi'])->name('reputasi');
Route::get('/kompetensi-lulusan', [PublicController::class, 'kompetensiLulusan'])->name('kompetensi-lulusan');
