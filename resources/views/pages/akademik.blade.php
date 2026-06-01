@extends('layouts.app')

@section('title', 'Akademik - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Akademik"
        subtitle="Informasi terbaru seputar kegiatan, prestasi, dan pengumuman Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Akademik">
        <span>Beranda</span> > <span>Akademik</span>
    </x-hero>

    <!-- Content Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Info Box -->
            <div class="bg-blue-50 border-l-4 border-navy-900 rounded-lg p-6 mb-12 flex gap-4">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-navy-900 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-navy-900 mb-2">Informasi Akademik</h3>
                    <p class="text-gray-700">
                        Halaman ini menyediakan akses menuju kalender akademik dan peraturan akademik resmi Politeknik Negeri Bandung (POLBAN). Informasi terbaru dari dokumen resmi dapat diakses langsung pada website POLBAN.
                    </p>
                </div>
            </div>

            <!-- Academic Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-8 text-center">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-6">
                        <svg class="h-8 w-8 text-navy-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2zm0 2v4h12V4H6zm0 6v10h12V8H6z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-900 mb-4">Kalender Akademik</h3>
                    <p class="text-gray-600 mb-6">Jadwal kegiatan akademik setiap semester seperti perkuliahan, ujian, libur akademik, dan kegiatan penting lainnya yang diselenggarakan oleh Politeknik Negeri Bandung</p>
                    <a href="#" class="inline-block px-6 py-2 border-2 border-navy-900 text-navy-900 font-semibold rounded-full hover:bg-navy-900 hover:text-white transition">
                        Lihat Kalender Akademik →
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-8 text-center">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-6">
                        <svg class="h-8 w-8 text-navy-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54h3.58v-3.54zm3.04-2.29h-3.58l2.75-3.54v3.54z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-900 mb-4">Peraturan Akademik</h3>
                    <p class="text-gray-600 mb-6">Kumpulan peraturan, pedoman, dan kebijakan akademik yang mengatur penyelenggaraan pendidikan di Politeknik Negeri Bandung</p>
                    <a href="#" class="inline-block px-6 py-2 border-2 border-navy-900 text-navy-900 font-semibold rounded-full hover:bg-navy-900 hover:text-white transition">
                        Lihat Peraturan Akademik →
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
