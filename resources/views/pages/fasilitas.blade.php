@extends('layouts.app')

@section('title', 'Fasilitas - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Fasilitas"
        subtitle="Informasi terbaru seputar Fasilitas"
        bgImage="https://via.placeholder.com/1920x400?text=Fasilitas">
        <span>Beranda</span> > <span>Fasilitas</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-700 mb-12 max-w-2xl mx-auto">
                Fasilitas yang tersedia mencakup Gedung Jurusan, Ruang Kelas, Laboratorium Komputer, Ruang Seniogguna, Lapangan Olahraga, Taman, dan lainnya.
            </p>

            <!-- Facilities Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    ['title' => 'Gedung Jurusan', 'image' => 'https://via.placeholder.com/400x300?text=Gedung+Jurusan'],
                    ['title' => 'Sarana Kelas 1', 'image' => 'https://via.placeholder.com/400x300?text=Sarana+Kelas+1'],
                    ['title' => 'Sarana Kelas 2', 'image' => 'https://via.placeholder.com/400x300?text=Sarana+Kelas+2'],
                    ['title' => 'Sarana RSO', 'image' => 'https://via.placeholder.com/400x300?text=Sarana+RSO'],
                    ['title' => 'Visi dan Misi', 'image' => 'https://via.placeholder.com/400x300?text=Visi+dan+Misi'],
                    ['title' => 'Lapangan Olahraga', 'image' => 'https://via.placeholder.com/400x300?text=Lapangan+Olahraga'],
                    ['title' => 'Oman Jurusan', 'image' => 'https://via.placeholder.com/400x300?text=Oman+Jurusan'],
                    ['title' => 'Papan Jurusan', 'image' => 'https://via.placeholder.com/400x300?text=Papan+Jurusan'],
                    ['title' => 'Museing Mahasiswa', 'image' => 'https://via.placeholder.com/400x300?text=Museing+Mahasiswa'],
                ] as $facility)
                    <div class="relative overflow-hidden rounded-lg h-64 hover:shadow-lg transition group cursor-pointer">
                        <img src="{{ $facility['image'] }}" alt="{{ $facility['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition flex items-center justify-center">
                            <span class="text-white font-bold text-lg text-center px-4">{{ $facility['title'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
