@extends('layouts.app')

@section('title', 'Program Studi - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Program Studi"
        subtitle="Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Program+Studi">
        <span>Breadcrumb: <a href="/" class="underline hover:text-sky-light">Beranda</a> > <span class="text-current">Program Studi</span></span>
    </x-hero>

    <!-- Program Cards -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="PROGRAM STUDI"
                subtitle="JTK POLBAN menawarkan dua program studi dengan akreditasi unggulan"
            />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- D3 Card -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-8 border-2 border-navy-200 hover:shadow-card-hover transition">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-navy-900">D3 Teknik Informatika</h3>
                        <span class="text-4xl">💻</span>
                    </div>
                    <p class="text-sm text-blue-600 font-semibold mb-4">Akreditasi: UNGGUL</p>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Program Diploma 3 yang dirancang untuk menghasilkan lulusan kompeten dalam bidang teknik informatika dengan durasi pendidikan 3 tahun.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600 mb-6">
                        <li class="flex items-center"><span class="mr-2">✓</span> Kurikulum industri terkini</li>
                        <li class="flex items-center"><span class="mr-2">✓</span> Praktek langsung dengan teknologi terbaru</li>
                        <li class="flex items-center"><span class="mr-2">✓</span> Karir global yang terbuka lebar</li>
                    </ul>
                    <x-button href="/program-studi/d3" type="primary" class="w-full">
                        Lihat Detail →
                    </x-button>
                </div>

                <!-- D4 Card -->
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg p-8 border-2 border-orange-200 hover:shadow-card-hover transition">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-navy-900">Sarjana Terapan Teknik Informatika</h3>
                        <span class="text-4xl">🎓</span>
                    </div>
                    <p class="text-sm text-orange-600 font-semibold mb-4">Akreditasi: UNGGUL</p>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Program Sarjana Terapan (D4) yang menghasilkan engineer profesional dengan kompetensi tinggi dalam sistem dan teknologi informatika.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600 mb-6">
                        <li class="flex items-center"><span class="mr-2">✓</span> Fokus pada aplikasi praktis</li>
                        <li class="flex items-center"><span class="mr-2">✓</span> Penelitian terapan berkualitas</li>
                        <li class="flex items-center"><span class="mr-2">✓</span> Sertifikasi internasional</li>
                    </ul>
                    <x-button href="/program-studi/sarjana" type="primary" class="w-full bg-orange-600 hover:bg-orange-700">
                        Lihat Detail →
                    </x-button>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Section -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="Perbandingan Program Studi"
                centered="true"
            />

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-navy-900 text-white">
                            <th class="px-6 py-4 text-left">Aspek</th>
                            <th class="px-6 py-4 text-left">D3 Teknik Informatika</th>
                            <th class="px-6 py-4 text-left">Sarjana Terapan TI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-6 py-4 font-semibold">Durasi</td>
                            <td class="px-6 py-4">3 Tahun</td>
                            <td class="px-6 py-4">4 Tahun</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 bg-gray-50">
                            <td class="px-6 py-4 font-semibold">Jenjang</td>
                            <td class="px-6 py-4">Diploma III</td>
                            <td class="px-6 py-4">Sarjana (S1)</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-6 py-4 font-semibold">Akreditasi</td>
                            <td class="px-6 py-4">UNGGUL</td>
                            <td class="px-6 py-4">UNGGUL</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 bg-gray-50">
                            <td class="px-6 py-4 font-semibold">Fokus</td>
                            <td class="px-6 py-4">Teknik Praktis</td>
                            <td class="px-6 py-4">Teknik Terapan</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-6 py-4 font-semibold">Prospek Karir</td>
                            <td class="px-6 py-4">Operator, Programmer, Drafter</td>
                            <td class="px-6 py-4">Engineer, Team Lead, Analyst</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-navy-900 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Pilih Program Studi Sesuai Impian Mu</h2>
            <p class="text-lg text-gray-200 mb-8">
                Bergabunglah dengan ribuan alumni kami yang sukses berkarir di berbagai industri teknologi global.
            </p>
            <x-button href="#" type="primary" class="bg-sky-light text-navy-900 hover:bg-sky-bright">
                Daftar Sekarang →
            </x-button>
        </div>
    </section>
@endsection
