@extends('layouts.app')

@section('title', 'Profil Dosen - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Profil Dosen"
        subtitle="Berkenalan dengan para dosen Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Profil+Dosen">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> > <span>Profil Dosen</span></span>
    </x-hero>

    <!-- Content Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Filter Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white border border-gray-200 rounded-lg p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-navy-900 mb-6">Filter Dosen</h3>

                        <!-- Search -->
                        <div class="mb-6">
                            <input 
                                type="text" 
                                placeholder="Cari Dosen, Bidang Keahlian"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-sky-light"
                            >
                        </div>

                        <!-- Program Filter -->
                        <div class="mb-6">
                            <label class="text-sm font-semibold text-navy-900 block mb-3">Program Studi</label>
                            @foreach($filters['program'] as $program)
                                <label class="flex items-center space-x-2 mb-2 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 rounded">
                                    <span class="text-sm text-gray-700">{{ $program }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Education Filter -->
                        <div class="mb-6">
                            <label class="text-sm font-semibold text-navy-900 block mb-3">Pendidikan Terakhir</label>
                            @foreach($filters['education'] as $edu)
                                <label class="flex items-center space-x-2 mb-2 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 rounded">
                                    <span class="text-sm text-gray-700">{{ $edu }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Position Filter -->
                        <div class="mb-6">
                            <label class="text-sm font-semibold text-navy-900 block mb-3">Jabatan Fungsional</label>
                            @foreach($filters['position'] as $pos)
                                <label class="flex items-center space-x-2 mb-2 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 rounded">
                                    <span class="text-sm text-gray-700">{{ $pos }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Filter Buttons -->
                        <div class="space-y-3">
                            <button class="w-full bg-navy-900 text-white font-semibold py-2 rounded-lg hover:bg-navy-800 transition">
                                Terapkan Filter
                            </button>
                            <button class="w-full border-2 border-gray-300 text-navy-900 font-semibold py-2 rounded-lg hover:bg-gray-50 transition">
                                Reset Filter
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Lecturer List -->
                <div class="lg:col-span-3">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-navy-900">Daftar Dosen</h2>
                        <div class="flex items-center space-x-2">
                            <label class="text-sm text-gray-600">Urutkan:</label>
                            <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none">
                                <option>Nama A - Z</option>
                                <option>Nama Z - A</option>
                                <option>Terbaru</option>
                            </select>
                        </div>
                    </div>

                    <p class="text-gray-600 text-sm mb-6">Menampilkan {{ count($lecturers) }} Dosen</p>

                    <!-- Table -->
                    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-navy-900">Nama Dosen</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-navy-900">Jenis Kelamin</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-navy-900">Pendidikan Terakhir</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-navy-900">Jabatan Fungsional</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-navy-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lecturers as $lecturer)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-navy-900 font-medium">{{ $lecturer['name'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $lecturer['gender'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $lecturer['position'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $lecturer['functional'] }}</td>
                                        <td class="px-6 py-4">
                                            <a href="/profil-dosen/{{ $lecturer['id'] }}" class="inline-flex items-center text-sky-light hover:text-sky-bright font-semibold">
                                                Lihat Detail
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center items-center space-x-2 mt-8">
                        <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">←</button>
                        <button class="px-3 py-2 bg-navy-900 text-white rounded-lg">1</button>
                        <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                        <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">→</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PDDikti Integration -->
    <section class="bg-blue-50 py-16 border-t border-blue-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-start space-x-4">
                <div class="text-3xl">📊</div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-navy-900 mb-2">Data Terintegrasi dengan PDDikti</h3>
                    <p class="text-gray-700 mb-4">
                        Informasi dosen gambil langsung dari PDDikti (Pangkalan Data Pendidikan Tinggi)
                    </p>
                    <a href="#" class="inline-flex items-center text-sky-light font-semibold hover:text-sky-bright">
                        Kunjungi PDDikti
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
