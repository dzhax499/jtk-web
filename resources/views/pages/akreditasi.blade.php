@extends('layouts.app')

@section('title', 'Akreditasi - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Akreditasi"
        subtitle="Informasi terbaru seputar Akreditasi! Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Akreditasi">
    </x-hero>

    <!-- Content Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="AKREDITASI PROGRAM STUDI"
                subtitle=""
                centered="true"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($accreditations as $accreditation)
                    <div class="bg-white rounded-lg border-2 border-gray-200 p-8 hover:shadow-card-hover transition">
                        <!-- Program Title -->
                        <h3 class="text-xl font-bold text-navy-900 mb-4">{{ $accreditation['program'] }}</h3>

                        <!-- Status Badge -->
                        <div class="mb-6">
                            <div class="inline-block">
                                <p class="text-sm text-gray-600 mb-1">STATUS AKREDITASI</p>
                                <p class="text-3xl font-bold text-navy-900">{{ $accreditation['status'] }}</p>
                            </div>
                        </div>

                        <!-- Accreditation Info -->
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <p class="text-sm text-gray-700 mb-2">{{ $accreditation['date'] }}</p>
                            <p class="text-xs text-gray-600">{{ $accreditation['noSk'] }}</p>
                        </div>

                        <!-- Certificate Info -->
                        <p class="text-sm text-gray-700 mb-6">
                            {{ $accreditation['certificate'] }}
                        </p>

                        <!-- Button -->
                        <x-button href="#" type="primary" class="w-full mb-3">
                            Unduh Sertifikat
                        </x-button>
                        <x-button href="#" type="outline" class="w-full border-navy-900 text-navy-900 hover:bg-navy-50">
                            Kunjungi LAM INFOKOM
                        </x-button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Additional Info -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="Tentang LAM INFOKOM"
                subtitle=""
                centered="true"
            />

            <div class="bg-white rounded-lg p-8 border border-gray-200">
                <h3 class="text-lg font-bold text-navy-900 mb-4">Apa itu LAM INFOKOM?</h3>
                <p class="text-gray-700 leading-relaxed mb-6">
                    LAM INFOKOM (Lembaga Akreditasi Mandiri Program Studi Informatika) adalah lembaga independen yang bertanggung jawab untuk melakukan akreditasi program studi di bidang informatika dan teknologi informasi. LAM INFOKOM memastikan bahwa program studi memenuhi standar kualitas yang telah ditetapkan.
                </p>

                <h3 class="text-lg font-bold text-navy-900 mb-4 mt-8">Mengapa Akreditasi Penting?</h3>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start space-x-3">
                        <span class="text-sky-light text-lg mt-1">✓</span>
                        <span>Menjamin kualitas pendidikan yang diberikan kepada mahasiswa</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-sky-light text-lg mt-1">✓</span>
                        <span>Meningkatkan kredibilitas dan reputasi program studi</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-sky-light text-lg mt-1">✓</span>
                        <span>Memfasilitasi pengakuan lulusan secara nasional dan internasional</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-sky-light text-lg mt-1">✓</span>
                        <span>Mendorong perbaikan berkelanjutan dalam mutu akademik</span>
                    </li>
                </ul>

                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        Untuk informasi lebih lengkap tentang akreditasi dan LAM INFOKOM, silakan kunjungi website resmi:
                    </p>
                    <a href="#" class="inline-flex items-center text-sky-light font-semibold hover:text-sky-bright mt-3">
                        Kunjungi Website LAM INFOKOM
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
