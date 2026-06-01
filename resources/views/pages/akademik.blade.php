@extends('layouts.app')

@section('title', 'Akademik - JTK POLBAN')

@section('content')
    <x-hero
        title="Akademik"
        subtitle="Informasi akademik Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://placehold.co/1920x400?text=Akademik">
        <span><a href="/" class="underline">Beranda</a> &gt; Akademik</span>
    </x-hero>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                    <p class="text-gray-700 leading-relaxed">
                        {{ $pageSummary ?? 'Informasi akademik Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung.' }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-8 text-center border border-gray-100">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-6">
                        <svg class="h-8 w-8 text-navy-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 2v2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2h-2V2h-2v2H9V2H7zm12 8H5v10h14V10z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-900 mb-4">Kalender Akademik</h3>
                    <p class="text-gray-600 mb-6">
                        Jadwal kegiatan akademik setiap semester seperti perkuliahan, ujian, libur akademik, dan agenda penting lainnya.
                    </p>
                    <a href="{{ $links['calendar'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="inline-block px-6 py-2 border-2 border-navy-900 text-navy-900 font-semibold rounded-full hover:bg-navy-900 hover:text-white transition">
                        Lihat Kalender Akademik →
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-8 text-center border border-gray-100">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-6">
                        <svg class="h-8 w-8 text-navy-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 2h9l5 5v15a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2zm8 1.5V8h4.5L14 3.5zM8 13h8v-2H8v2zm0 4h8v-2H8v2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-900 mb-4">Peraturan Akademik</h3>
                    <p class="text-gray-600 mb-6">
                        Pedoman dan kebijakan akademik resmi yang mengatur penyelenggaraan pendidikan di Politeknik Negeri Bandung.
                    </p>
                    <a href="{{ $links['rules'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="inline-block px-6 py-2 border-2 border-navy-900 text-navy-900 font-semibold rounded-full hover:bg-navy-900 hover:text-white transition">
                        Lihat Peraturan Akademik →
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
