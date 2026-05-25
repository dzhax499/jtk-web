@extends('layouts.app')

@section('title', 'Beranda - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Jurusan Teknik Komputer dan Informatika"
        subtitle="Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=JTK+POLBAN">
        <a href="#about" class="text-white hover:text-sky-light transition">Scroll untuk selengkapnya ↓</a>
    </x-hero>

    <!-- Quick Access Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="AKSES CEPAT"
                subtitle="Akses informasi penting JTK POLBAN"
            />
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <x-icon-card 
                    icon="🎓"
                    title="Calon Mahasiswa"
                    href="#">
                    Informasi untuk calon mahasiswa baru
                </x-icon-card>

                <x-icon-card 
                    icon="👤"
                    title="Mahasiswa Aktif"
                    href="#">
                    Informasi dan layanan untuk mahasiswa
                </x-icon-card>

                <x-icon-card 
                    icon="👨‍🏫"
                    title="Dosen & Tendik"
                    href="/profil-dosen">
                    Informasi dosen dan tenaga kependidikan
                </x-icon-card>

                <x-icon-card 
                    icon="🤝"
                    title="Alumni"
                    href="#">
                    Informasi jaringan alumni JTK POLBAN
                </x-icon-card>

                <x-icon-card 
                    icon="🏭"
                    title="Mitra Industri"
                    href="#">
                    Kerja sama dan informasi untuk mitra industri
                </x-icon-card>
            </div>
        </div>
    </section>

    <!-- Program Studi Section -->
    <section class="py-16" id="programs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="PROGRAM STUDI"
                subtitle="Dua program studi unggul dengan akreditasi internasional"
            />
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <x-card 
                    title="D3 Teknik Informatika"
                    image="https://via.placeholder.com/500x300?text=D3+Teknik+Informatika"
                    href="/program-studi/d3">
                    <div class="bg-blue-100 text-blue-900 px-3 py-1 rounded-full text-sm font-semibold mb-3 inline-block">
                        Akreditasi: UNGGUL
                    </div>
                    <p>Pendidikan selama 3 tahun yang menghasilkan mahasiswa dengan keterampatan di bidang teknik informatika dan pengembangan perangkat lunak.</p>
                </x-card>

                <x-card 
                    title="D4 Teknik Informatika"
                    image="https://via.placeholder.com/500x300?text=D4+Teknik+Informatika"
                    href="/program-studi/sarjana">
                    <div class="bg-blue-100 text-blue-900 px-3 py-1 rounded-full text-sm font-semibold mb-3 inline-block">
                        Akreditasi: UNGGUL
                    </div>
                    <p>Pendidikan selama 3 tahun yang membekali mahasiswa dengan keterampatan di bidang perangcangan dan implementasi sistem informatika.</p>
                </x-card>
            </div>

            <div class="text-center mt-8">
                <x-button href="/program-studi" type="primary">Lihat Semua Program →</x-button>
            </div>
        </div>
    </section>

    <!-- Accreditation Section -->
    <section class="bg-gradient-to-r from-navy-900 to-navy-800 py-16 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="AKREDITASI PROGRAM STUDI"
                subtitle="Program Studi Terakreditasi UNGGUL"
                centered="true"
                class="text-white">
            </x-section-title>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white/10 backdrop-blur rounded-lg p-8 border border-white/20">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl">🏆</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">D3 Teknik Informatika</h3>
                    <p class="text-gray-200 mb-4">Akreditasi: UNGGUL</p>
                    <p class="text-sm text-gray-300 mb-6">Berlaku sampai 31 Desember 2028</p>
                    <x-button href="/akreditasi" type="secondary" class="border-white text-white hover:bg-white/10">
                        Lihat Sertifikat →
                    </x-button>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-lg p-8 border border-white/20">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl">🏆</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">D4 Teknik Informatika</h3>
                    <p class="text-gray-200 mb-4">Akreditasi: UNGGUL</p>
                    <p class="text-sm text-gray-300 mb-6">Berlaku sampai 31 Desember 2030</p>
                    <x-button href="/akreditasi" type="secondary" class="border-white text-white hover:bg-white/10">
                        Lihat Sertifikat →
                    </x-button>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <x-section-title 
                    title="BERITA TERBARU"
                    centered="false"
                />
                <x-button href="/berita" type="ghost">Lihat Semua →</x-button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($latestNews as $news)
                    <x-card 
                        title="{{ $news['title'] }}"
                        image="{{ $news['image'] }}"
                        href="/berita/{{ $news['id'] }}">
                        <div class="flex items-center space-x-4 text-xs text-gray-500 mb-3">
                            <span>📅 {{ $news['date'] }}</span>
                            <span>👁️ {{ $news['views'] }} views</span>
                        </div>
                        <p>{{ $news['excerpt'] }}</p>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Student Achievements Section -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="PRESTASI MAHASISWA"
                subtitle="Pencapaian mahasiswa JTK di berbagai kompetisi"
            />
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-card>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-3xl">🥇</span>
                        <div>
                            <div class="font-bold text-navy-900">Juara Nasional KMIPN 2025</div>
                            <div class="text-xs text-gray-500">Kategori Game Development</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Mahasiswa JTK POLBAN meraih prestasi luar biasa di KMIPN 2025 di Padang.</p>
                </x-card>

                <x-card>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-3xl">🥈</span>
                        <div>
                            <div class="font-bold text-navy-900">Juara II Hackathon BuildOn</div>
                            <div class="text-xs text-gray-500">Build Indonesia 2020</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Obstetrik dari JTK sabet juara I Hackathon BuildOn Indonesia 2020.</p>
                </x-card>

                <x-card>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-3xl">🏅</span>
                        <div>
                            <div class="font-bold text-navy-900">Program Nyatakan.id</div>
                            <div class="text-xs text-gray-500">Kemenprakraf 2020</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Mahasiswa JTK raih prestasi dalam program Nyatakan.id Kemenprakraf.</p>
                </x-card>
            </div>

            <div class="text-center mt-8">
                <x-button href="/prestasi" type="primary">Lihat Semua Prestasi →</x-button>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-gradient-to-r from-sky-light to-sky-bright py-16 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Tertarik Bergabung dengan JTK POLBAN?</h2>
            <p class="text-lg mb-8 opacity-95">
                Raih kesempatan emas untuk belajar dan mengembangkan kompetensi di bidang teknik komputer dan informatika.
            </p>
            <x-button href="#" type="primary" class="bg-navy-900 text-white hover:bg-navy-800">
                Daftar Sekarang →
            </x-button>
        </div>
    </section>
@endsection
