@extends('layouts.app')

@section('title', 'Reputasi - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Reputasi"
        subtitle="Informasi terbaru seputar Reputasi"
        bgImage="https://via.placeholder.com/1920x400?text=Reputasi">
        <span>Beranda</span> > <span>Reputasi</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-navy-900 mb-2">Reputasi</h2>
                <p class="text-gray-700 text-sm">
                    Sejak tahun 1976, JTK telah menjadi salah satu pelopor rumpun pendidikan tinggi vokasi yang diakui.
                </p>
            </div>

            <!-- Timeline -->
            <div class="space-y-8">
                @foreach([
                    ['year' => '1986', 'title' => 'Pada Tahun 2005, JTK berkirkir sama dengan APTECH World-Wide (Global IT Education) membawa sertifikasi internasional yang berpusat di India, untuk meningkatkan keterampilan lunak bidang pemrograman, basis data, jaringan dan multimedia.'],
                    ['year' => '1997', 'title' => 'Pada tahun 2007, JTK Terakreditasi A dari BAN-PT (Badan Akreditasi Nasional – Perguruan Tinggi)', 'detail' => 'Program Studi D3 Teknik Informatika'],
                    ['year' => '1997', 'title' => 'Pada tahun 2007, JTK diminta oleh LSP-Telematika (Lembaga Sertifikasi Profesi Telekomunikasi, Multimedia dan Informatika) agar berfungsi sebagai assesor dalam menyelenggarakan uji kompetensi bnsp dan professional skill secara sertifikat profesi nasional.'],
                    ['year' => '1999', 'title' => 'Pada tahun 2009, JTK mendapat sertifikasi ISO 9001:2008 untuk Proses Belajar Mengajar'],
                ] as $item)
                    <div class="flex gap-6">
                        <div class="flex-shrink-0 w-24">
                            <div class="bg-navy-900 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold">
                                {{ $item['year'] }}
                            </div>
                        </div>
                        <div class="flex-1 pb-8 border-l-2 border-gray-300 pl-6">
                            <h3 class="font-bold text-navy-900 mb-2">{{ $item['title'] }}</h3>
                            @if(isset($item['detail']))
                                <p class="text-sm text-gray-600">{{ $item['detail'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
