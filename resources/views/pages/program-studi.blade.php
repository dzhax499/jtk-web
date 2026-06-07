@extends('layouts.app')

@section('title', 'Program Studi - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Program Studi"
        subtitle="Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="true">
        <span>
            <a href="/" class="underline">Beranda</a> > 
            <span>Program Studi</span>
        </span>
    </x-hero>

    <!-- Program Cards Section -->
    <section class="py-20 bg-white font-['Poppins']">
        <div class="max-w-5xl mx-auto px-6 sm:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-[#00008B] tracking-wider mb-5">PROGRAM STUDI</h2>
                <p class="text-gray-700 max-w-3xl mx-auto leading-relaxed font-semibold text-[15px] md:text-[16px]">
                    Jurusan Teknik Komputer dan Informatika memiliki dua program studi yang dirancang untuk menghasilkan lulusan yang kompeten dan siap bersaing di industri
                </p>
            </div>

            <!-- Loading State -->
            <div id="program-loading" class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                @for($i = 0; $i < 2; $i++)
                    <div class="animate-pulse bg-gray-100 border border-gray-200 rounded-2xl h-56"></div>
                @endfor
            </div>

            <!-- Program Container -->
            <div id="program-container" class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto hidden">
                <!-- Data from API will be rendered here -->
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('program-container');
            const loading = document.getElementById('program-loading');

            fetch('/api/study-programs')
                .then(response => response.json())
                .then(response => {
                    const programs = response.data;
                    loading.classList.add('hidden');
                    container.classList.remove('hidden');

                    if (programs.length === 0) {
                        container.innerHTML = '<p class="text-center col-span-2 text-gray-500 font-semibold">Data program studi belum tersedia.</p>';
                        return;
                    }

                    // Render cards according to Mockup
                    container.innerHTML = programs
                        .filter(program => program.degree === 'D3' || program.degree === 'D4')
                        .map(program => {
                            const isD4 = program.degree === 'D4' || program.name.toLowerCase().includes('sarjana');
                            const displayName = isD4 ? 'D4 Teknik Informatika' : 'D3 Teknik Informatika';
                            
                            let detailUrl = `/program-studi/${program.slug}`;
                            if (program.slug === 'd3-teknik-informatika') {
                                detailUrl = '/program-studi/d3';
                            } else if (program.slug === 'sarjana-terapan-teknik-informatika') {
                                detailUrl = '/program-studi/sarjana';
                            }

                            return `
                                <div class="bg-white border border-gray-200 rounded-2xl p-10 md:p-12 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300 flex flex-col items-center justify-center text-center">
                                    <h3 class="text-xl md:text-2xl font-black text-[#00008B] mb-8 leading-snug">${displayName}</h3>
                                    <a href="${detailUrl}" class="inline-block text-center px-10 py-3 bg-[#00008B] text-white font-bold rounded-xl hover:bg-blue-900 transition duration-300 text-sm tracking-wide shadow-md shadow-blue-900/10">
                                        Selengkapnya
                                    </a>
                                </div>
                            `;
                        }).join('');
                })
                .catch(error => {
                    console.error('Error fetching programs:', error);
                    loading.innerHTML = '<p class="text-red-500 font-bold text-center col-span-2">Gagal mengambil data dari API.</p>';
                });
        });
    </script>
@endsection
