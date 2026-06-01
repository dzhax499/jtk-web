@extends('layouts.app')

@section('title', 'Akreditasi - JTK POLBAN')

@section('content')
    <x-hero
        title="Akreditasi"
        subtitle="Informasi akreditasi program studi Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://placehold.co/1920x400?text=Akreditasi">
    </x-hero>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title
                title="AKREDITASI PROGRAM STUDI"
                subtitle="{{ $pageSummary ?? 'Status akreditasi program studi di lingkungan Jurusan Teknik Komputer dan Informatika' }}"
                centered="true"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($accreditations as $accreditation)
                    <div class="bg-white rounded-lg border-2 border-gray-200 p-8 hover:shadow-card-hover transition">
                        <h3 class="text-xl font-bold text-navy-900 mb-4">{{ $accreditation['program'] }}</h3>

                        <div class="mb-6">
                            <p class="text-sm text-gray-600 mb-1">STATUS AKREDITASI</p>
                            <p class="text-3xl font-bold text-navy-900">{{ $accreditation['status'] }}</p>
                        </div>

                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <p class="text-sm text-gray-700 mb-2">{{ $accreditation['date'] }}</p>
                            <p class="text-xs text-gray-600">{{ $accreditation['noSk'] }}</p>
                        </div>

                        <p class="text-sm text-gray-700 mb-6">
                            {{ $accreditation['certificate'] }}
                        </p>

                        <a href="{{ $accreditation['certificateUrl'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="block w-full text-center px-6 py-3 rounded-lg bg-navy-900 text-white font-semibold hover:bg-navy-800 transition mb-3">
                            Unduh Sertifikat
                        </a>
                        <a href="{{ $accreditation['lamUrl'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="block w-full text-center px-6 py-3 rounded-lg border-2 border-navy-900 text-navy-900 font-semibold hover:bg-navy-50 transition">
                            Kunjungi LAM INFOKOM
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title
                title="Tentang LAM INFOKOM"
                subtitle="Lembaga akreditasi mandiri untuk bidang informatika dan komputer"
                centered="true"
            />

            <div class="bg-white rounded-lg p-8 border border-gray-200">
                <h3 class="text-lg font-bold text-navy-900 mb-4">Apa itu LAM INFOKOM?</h3>
                <p class="text-gray-700 leading-relaxed mb-6">
                    LAM INFOKOM adalah lembaga yang melakukan akreditasi program studi bidang informatika dan komputer. Informasi akreditasi resmi dapat dicek melalui laman LAM INFOKOM.
                </p>

                <a href="https://laminfokom.or.id/official/data-akreditasi-1.html" target="_blank" rel="noopener noreferrer" class="inline-block px-6 py-2 bg-navy-900 text-white rounded-lg hover:bg-navy-800 transition">
                    Cek Data Akreditasi →
                </a>
            </div>
        </div>
    </section>
@endsection
