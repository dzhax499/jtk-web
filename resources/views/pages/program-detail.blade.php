@extends('layouts.app')

@section('title', '{{ $program["title"] }} - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="{{ $program['title'] }}"
        subtitle="{{ $program['shortName'] }}"
        bgImage="https://via.placeholder.com/1920x400?text={{ urlencode($program['title']) }}">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> > <a href="/program-studi" class="underline">Program Studi</a> > <span>{{ $program['shortName'] }}</span></span>
    </x-hero>

    <!-- Program Overview -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Accreditation Info -->
            <div class="bg-blue-50 border-l-4 border-sky-light p-6 rounded mb-8">
                <div class="flex items-center space-x-2 mb-2">
                    <span class="text-2xl">🏆</span>
                    <h3 class="text-lg font-bold text-navy-900">Status Akreditasi</h3>
                </div>
                <p class="text-navy-700 font-semibold mb-2">{{ $program['accreditation'] }}</p>
                <p class="text-sm text-gray-600">{{ $program['accreditationDate'] }}</p>
                <p class="text-xs text-gray-500 mt-3">Sertifikat akreditasi dapat diakses melalui Web LAM INFOKOM</p>
            </div>

            <!-- Vision -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-navy-900 mb-4">Visi Program Studi</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $program['vision'] }}
                </p>
            </div>

            <!-- Mission -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-navy-900 mb-4">Misi Program Studi</h2>
                <ul class="space-y-3">
                    @foreach($program['mission'] as $item)
                        <li class="flex items-start space-x-3">
                            <span class="text-sky-light text-2xl mt-1">✦</span>
                            <span class="text-gray-700 leading-relaxed">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Objectives -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-navy-900 mb-4">Tujuan Program Studi</h2>
                <ul class="space-y-3">
                    @foreach($program['objectives'] as $item)
                        <li class="flex items-start space-x-3">
                            <span class="text-sky-light text-2xl mt-1">•</span>
                            <span class="text-gray-700 leading-relaxed">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Program Highlights -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <x-icon-card 
                    icon="🎓"
                    title="Kurikulum Terkini">
                    Dirancang berdasarkan kebutuhan industri dan standar internasional terbaru.
                </x-icon-card>

                <x-icon-card 
                    icon="💻"
                    title="Laboratorium Modern">
                    Fasilitas lengkap untuk praktik dan pengembangan teknologi informatika.
                </x-icon-card>

                <x-icon-card 
                    icon="🌍"
                    title="Karir Global">
                    Lulusan kami diakui secara internasional dan tersebar di berbagai negara.
                </x-icon-card>
            </div>

            <!-- CTA -->
            <div class="mt-12 bg-gradient-to-r from-navy-900 to-navy-800 text-white p-8 rounded-lg text-center">
                <h3 class="text-2xl font-bold mb-4">Tertarik Bergabung?</h3>
                <p class="text-gray-200 mb-6">Daftarkan diri Anda sekarang dan mulai perjalanan menuju karir cemerlang di bidang informatika.</p>
                <x-button href="#" type="primary" class="bg-sky-light text-navy-900 hover:bg-sky-bright">
                    Daftar Sekarang →
                </x-button>
            </div>
        </div>
    </section>

    <!-- Additional Sections -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="Kompetensi Lulusan"
                subtitle="Keterampilan dan pengetahuan yang akan Anda kuasai"
                centered="true"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-card">
                    <h4 class="font-bold text-navy-900 mb-4">Hard Skills</h4>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-center"><span class="mr-2 text-sky-light">✓</span>Pemrograman dan pengembangan aplikasi</li>
                        <li class="flex items-center"><span class="mr-2 text-sky-light">✓</span>Sistem basis data</li>
                        <li class="flex items-center"><span class="mr-2 text-sky-light">✓</span>Jaringan komputer</li>
                        <li class="flex items-center"><span class="mr-2 text-sky-light">✓</span>Keamanan informasi</li>
                    </ul>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-card">
                    <h4 class="font-bold text-navy-900 mb-4">Soft Skills</h4>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-center"><span class="mr-2 text-sky-light">✓</span>Komunikasi profesional</li>
                        <li class="flex items-center"><span class="mr-2 text-sky-light">✓</span>Teamwork dan kolaborasi</li>
                        <li class="flex items-center"><span class="mr-2 text-sky-light">✓</span>Problem solving</li>
                        <li class="flex items-center"><span class="mr-2 text-sky-light">✓</span>Leadership</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
