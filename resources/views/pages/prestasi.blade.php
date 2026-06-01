@extends('layouts.app')

@section('title', 'Prestasi - JTK POLBAN')

@section('content')
    <x-hero
        title="Prestasi Mahasiswa"
        subtitle="Informasi tentang prestasi dan pencapaian mahasiswa Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://placehold.co/1920x400?text=Prestasi">
    </x-hero>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <p class="text-gray-700">
                    Data prestasi diambil dari tabel <strong>posts</strong> dengan filter prestasi.
                </p>
            </div>

            @if(empty($achievements))
                <div class="bg-white border border-gray-200 rounded-lg p-10 text-center text-gray-600">
                    Belum ada data prestasi yang tersedia.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($achievements as $achievement)
                        <x-card
                            image="{{ $achievement['image'] }}"
                            title="{{ $achievement['title'] }}"
                            href="/berita/{{ $achievement['id'] }}">
                            <div class="flex items-center space-x-4 text-xs text-gray-500 mb-3">
                                <span>📅 {{ $achievement['date'] }}</span>
                                <span>👁️ {{ $achievement['views'] }} Views</span>
                            </div>
                            @if(!empty($achievement['excerpt']))
                                <p class="text-gray-600">{{ $achievement['excerpt'] }}</p>
                            @endif
                        </x-card>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
