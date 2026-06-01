@extends('layouts.app')

@section('title', 'Struktur Organisasi - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Struktur Organisasi"
        subtitle="Informasi terbaru seputar Struktur Organisasi"
        bgImage="https://via.placeholder.com/1920x400?text=Struktur+Organisasi">
        <span>Beranda</span> > <span>Struktur Organisasi</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Accordion -->
            <div class="space-y-4">
                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>A. Manajemen Jurusan Periode 2023-2026</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-6 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center p-4 border border-gray-200 rounded-lg">
                                <div class="text-3xl mb-3">👤</div>
                                <h3 class="font-bold text-navy-900">Yadil Aditya Permana</h3>
                                <p class="text-sm text-gray-600">Ketua Jurusan</p>
                            </div>
                            <div class="text-center p-4 border border-gray-200 rounded-lg">
                                <div class="text-3xl mb-3">👤</div>
                                <h3 class="font-bold text-navy-900">Feri Chani</h3>
                                <p class="text-sm text-gray-600">Sekretaris Jurusan</p>
                            </div>
                        </div>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>B. Program Studi</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700">Program Studi D-3 dan D-4 Teknik Informatika</p>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>C. Kelompok Bidang Keahlian (KBK)</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700">Kelompok bidang keahlian dalam bidang informatika</p>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>D. Laboratorium</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700">Fasilitas laboratorium untuk mendukung pembelajaran praktis</p>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>E. Wali Kelas Program Studi Teknik Informatika D-III</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700">Daftar wali kelas untuk program D-III</p>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>F. Wali Kelas Program Studi Teknik Informatika D-IV</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700">Daftar wali kelas untuk program D-IV</p>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>G. Pembina Himpunan</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700">Pembina organisasi himpunan mahasiswa</p>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>H. Komisi Disiplin Mahasiswa</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700">Komisi untuk menangani disiplin mahasiswa</p>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>I. Bimbingan & Konseling Mahasiswa</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700">Layanan bimbingan dan konseling untuk mahasiswa</p>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>J. PAK Jurusan</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700">Program Pengembangan Akademik Kepemimpinan Jurusan</p>
                    </div>
                </details>
            </div>
        </div>
    </section>
@endsection
