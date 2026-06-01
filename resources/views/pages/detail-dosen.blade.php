@extends('layouts.app')

@section('title', '{{ $lecturer["name"] }} - JTK POLBAN')

@section('content')
    <!-- Hero Section with Profile -->
    <div class="bg-gradient-to-r from-navy-900 to-navy-800 text-white pt-20 pb-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end space-x-6">
                <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-6xl font-bold text-navy-900">{{ substr($lecturer['initials'], 0, 1) }}</span>
                </div>
                <div class="pb-4">
                    <h1 class="text-3xl font-bold mb-2">{{ $lecturer['name'] }}</h1>
                    <p class="text-gray-200">{{ $lecturer['position'] }}</p>
                </div>
            </div>
            <div class="mt-6 text-sm text-gray-200">
                <a href="/" class="underline hover:text-sky-light">Beranda</a> > 
                <a href="/profil-dosen" class="underline hover:text-sky-light">Profil Dosen</a> > 
                <span>{{ $lecturer['name'] }}</span>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- General Information -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 mb-12">
                <h2 class="text-2xl font-bold text-navy-900 mb-6">Informasi Umum</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Nama Lengkap</p>
                        <p class="text-lg font-semibold text-navy-900">{{ $lecturer['fullName'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Jenis Kelamin</p>
                        <p class="text-lg font-semibold text-navy-900">{{ $lecturer['gender'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Pendidikan Terakhir</p>
                        <p class="text-lg font-semibold text-navy-900">{{ $lecturer['education'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Jabatan Fungsional</p>
                        <p class="text-lg font-semibold text-navy-900">{{ $lecturer['functional'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Perguruan Tinggi</p>
                        <p class="text-lg font-semibold text-navy-900">Politeknik Negeri Bandung</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">{{ $lecturer['institutionalStatus'] }}</p>
                        <p class="text-lg font-semibold text-navy-900">Dosen Tetap</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Status Aktivitas</p>
                        <p class="text-lg font-semibold text-green-600">{{ $lecturer['activityStatus'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Education History -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-navy-900 mb-6">Riwayat Dosen</h2>
                
                <!-- Tabs -->
                <div class="flex space-x-4 mb-6 border-b border-gray-300">
                    <button class="px-4 py-3 font-semibold text-navy-900 border-b-2 border-navy-900">
                        Riwayat Pendidikan
                    </button>
                    <button class="px-4 py-3 font-semibold text-gray-600 hover:text-navy-900">
                        Riwayat Mengajar
                    </button>
                </div>

                <!-- Education Content -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="px-6 py-4 text-left font-semibold text-navy-900">Perguruan Tinggi</th>
                                <th class="px-6 py-4 text-left font-semibold text-navy-900">Gelar Akademik</th>
                                <th class="px-6 py-4 text-left font-semibold text-navy-900">Tahun</th>
                                <th class="px-6 py-4 text-left font-semibold text-navy-900">Jenjang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lecturer['educationList'] as $edu)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-700">{{ $edu['institution'] }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $edu['degree'] }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $edu['year'] }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $edu['duration'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Publications -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-navy-900 mb-6">Portofolio Dosen</h2>
                
                <!-- Tabs for Portfolio -->
                <div class="flex space-x-4 mb-6 border-b border-gray-300">
                    <button class="px-4 py-3 font-semibold text-navy-900 border-b-2 border-navy-900">
                        Penelitian
                    </button>
                    <button class="px-4 py-3 font-semibold text-gray-600 hover:text-navy-900">
                        Pengabdian Masyarakat
                    </button>
                    <button class="px-4 py-3 font-semibold text-gray-600 hover:text-navy-900">
                        Publikasi Karya
                    </button>
                    <button class="px-4 py-3 font-semibold text-gray-600 hover:text-navy-900">
                        HKI/Paten
                    </button>
                </div>

                <!-- Publications List -->
                <div class="space-y-4">
                    @foreach($lecturer['publications'] as $pub)
                        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-card-hover transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-semibold text-navy-900 mb-2">{{ $pub['title'] }}</p>
                                    <p class="text-sm text-gray-600">Tahun: {{ $pub['year'] }}</p>
                                </div>
                                <span class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full whitespace-nowrap ml-4">
                                    {{ $pub['year'] }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- PDDikti Info -->
            <div class="bg-blue-50 border-l-4 border-sky-light p-6 rounded">
                <h3 class="font-semibold text-navy-900 mb-2">Data Terintegrasi dengan PDDikti</h3>
                <p class="text-sm text-gray-700 mb-4">
                    Informasi dosen diambil langsung dari PDDikti (Pangkalan Data Pendidikan Tinggi)
                </p>
                <a href="#" class="inline-flex items-center text-sky-light font-semibold hover:text-sky-bright">
                    Kunjungi PDDikti
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
