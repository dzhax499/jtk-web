@extends('layouts.app')

@section('title', 'Profil Dosen - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Profil Dosen"
        subtitle="Berkenalan dengan para dosen Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="true">
        <span class="text-sm opacity-90"><a href="/" class="hover:underline">Beranda</a> &gt; <span class="font-semibold text-sky-light">Profil Dosen</span></span>
    </x-hero>

    <!-- Content Section -->
    <section class="py-16 bg-[#FAFAFA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Filter Sidebar -->
                <div class="lg:col-span-1">
                    <form action="{{ route('profil-dosen') }}" method="GET" class="bg-white border border-gray-200 rounded-2xl p-6 sticky top-24 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-navy-900">Filter Dosen</h3>
                            <span class="text-xs bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full font-medium">Dinamis</span>
                        </div>

                        <!-- Search -->
                        <div class="mb-6">
                            <label class="text-xs font-bold text-navy-900 uppercase tracking-wider block mb-2">Pencarian</label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="search"
                                    value="{{ $selected['search'] }}"
                                    placeholder="Cari nama dosen..."
                                    class="w-full pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-navy-900/20 focus:border-navy-900 text-sm transition"
                                >
                                <span class="absolute right-3 top-3.5 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </span>
                            </div>
                        </div>

                        <!-- Program Filter -->
                        @if(count($filters['program']) > 0)
                        <div class="mb-6">
                            <label class="text-xs font-bold text-navy-900 uppercase tracking-wider block mb-3">Program Studi</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto pr-1">
                                @foreach($filters['program'] as $program)
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input 
                                            type="checkbox" 
                                            name="program[]" 
                                            value="{{ $program }}"
                                            {{ in_array($program, $selected['program']) ? 'checked' : '' }}
                                            class="w-4 h-4 text-navy-900 border-gray-300 rounded focus:ring-navy-900 focus:ring-2 transition"
                                        >
                                        <span class="text-sm text-gray-600 group-hover:text-navy-900 transition">{{ $program }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Education Filter -->
                        @if(count($filters['education']) > 0)
                        <div class="mb-6">
                            <label class="text-xs font-bold text-navy-900 uppercase tracking-wider block mb-3">Pendidikan Terakhir</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto pr-1">
                                @foreach($filters['education'] as $edu)
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input 
                                            type="checkbox" 
                                            name="education[]" 
                                            value="{{ $edu }}"
                                            {{ in_array($edu, $selected['education']) ? 'checked' : '' }}
                                            class="w-4 h-4 text-navy-900 border-gray-300 rounded focus:ring-navy-900 focus:ring-2 transition"
                                        >
                                        <span class="text-sm text-gray-600 group-hover:text-navy-900 transition">{{ $edu }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Position Filter -->
                        @if(count($filters['position']) > 0)
                        <div class="mb-6">
                            <label class="text-xs font-bold text-navy-900 uppercase tracking-wider block mb-3">Jabatan Fungsional</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto pr-1">
                                @foreach($filters['position'] as $pos)
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input 
                                            type="checkbox" 
                                            name="position[]" 
                                            value="{{ $pos }}"
                                            {{ in_array($pos, $selected['position']) ? 'checked' : '' }}
                                            class="w-4 h-4 text-navy-900 border-gray-300 rounded focus:ring-navy-900 focus:ring-2 transition"
                                        >
                                        <span class="text-sm text-gray-600 group-hover:text-navy-900 transition">{{ $pos }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Filter Buttons -->
                        <div class="space-y-3 pt-2">
                            <button type="submit" class="w-full bg-navy-900 text-white font-semibold py-2.5 rounded-xl hover:bg-navy-800 focus:ring-4 focus:ring-navy-900/20 transition text-sm">
                                Terapkan Filter
                            </button>
                            <a href="{{ route('profil-dosen') }}" class="w-full block text-center border-2 border-gray-200 text-navy-900 font-semibold py-2 rounded-xl hover:bg-gray-50 transition text-sm">
                                Reset Filter
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Lecturer List -->
                <div class="lg:col-span-3">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-navy-900">Daftar Dosen</h2>
                        <div class="flex items-center space-x-2">
                            <label class="text-sm text-gray-500 font-medium">Urutkan:</label>
                            <select class="px-3 py-1.5 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-navy-900/20 text-sm text-gray-700">
                                <option>Nama A - Z</option>
                            </select>
                        </div>
                    </div>

                    <p class="text-gray-500 text-sm mb-6">Menampilkan <span class="font-semibold text-navy-900">{{ count($lecturers) }}</span> Dosen</p>

                    <!-- Table -->
                    <div class="overflow-x-auto bg-white rounded-2xl border border-gray-200 shadow-sm">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-gray-700">
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-navy-900">Nama Dosen</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-navy-900">Jenis Kelamin</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-navy-900">Pendidikan Terakhir</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-navy-900">Jabatan Fungsional</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-navy-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($lecturers as $lecturer)
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="px-6 py-4 text-sm text-navy-900 font-semibold">{{ $lecturer['name'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $lecturer['gender'] == 'L' ? 'Laki-laki' : ($lecturer['gender'] == 'P' ? 'Perempuan' : $lecturer['gender']) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $lecturer['position'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $lecturer['functional'] }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="/profil-dosen/{{ $lecturer['id'] }}" class="inline-flex items-center text-sky-light hover:text-sky-bright font-bold text-sm transition">
                                                Lebih Lanjut
                                                <svg class="w-4 h-4 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">
                                            Tidak ada data dosen yang sesuai dengan kriteria filter.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PDDikti Integration -->
    <section class="bg-blue-50/50 py-16 border-t border-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-start space-x-5">
                <div class="text-4xl bg-blue-100/80 p-3 rounded-2xl shadow-sm">📊</div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-navy-900 mb-2">Data Terintegrasi dengan PDDikti</h3>
                    <p class="text-gray-600 mb-4 max-w-xl leading-relaxed text-sm">
                        Informasi profil dosen, riwayat mengajar, dan riwayat pendidikan diambil langsung dari PDDikti (Pangkalan Data Pendidikan Tinggi) secara real-time.
                    </p>
                    <a href="https://pddikti.kemdikbud.go.id" target="_blank" class="inline-flex items-center text-sky-light font-bold hover:text-sky-bright transition text-sm">
                        Kunjungi PDDikti
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
