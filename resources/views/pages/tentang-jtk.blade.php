@extends('layouts.app')

@section('title', 'Tentang JTK - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Tentang JTK"
        subtitle="Informasi terbaru seputar JTK"
        bgImage="https://via.placeholder.com/1920x400?text=Tentang+JTK">
        <span>Beranda</span> > <span>Tentang JTK</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-lg p-8">
                <h2 class="text-2xl font-bold text-navy-900 mb-6">Tentang JTK</h2>
                
                <div class="space-y-6 text-gray-700 leading-relaxed">
                    @if(!empty($pageContent))
                        {!! $pageContent !!}
                    @else
                        <p>
                            Jurusan Teknik Komputer dan Informatika, Politeknik Negeri Bandung (lebih dikenal dengan singkatan JTK) merupakan jurusan penyelenggara pendidikan diploma bidang teknologi informasi pertama di Indonesia. Jurusan ini telah menyelenggarakan pendidikan D-3 (Diploma Tiga) dan D-4 (Diploma Empat) sejak tahun 1977 untuk pendidikan D-3 saat 2007 untuk pendidikan D-4.
                        </p>
                        
                        <p>
                            Dengan daya tampung sekitar 96 mahasiswa per tahun, sampai saat ini JTK telah menghasilkan lebih dari 2,900 alumni yang bekerja pada berbagai sektor industri, baik di dalam maupun di luar negeri.
                        </p>
                        
                        <p>
                            Selain menjalankan pendidikan, JTK juga menyelenggarakan penelitian dan pengabdian kepada masyarakat dalam bidang teknologi informasi. Sebagai jurusan pertama yang menyelenggarakan pendidikan profesional bidang teknologi informasi, JTK selalu dijadikan tolok ukur untuk tolok ukur telah banyak memberikan bantuan teknis kepada institusi lain guna bersiap menerima masyarakat umum. Berkaitan dengan upaya mengintegrasikan pendidikan dengan perkembangan industri, JTK telah banyak melakukan kerjasama dengan pihak lain untuk kegiatan kerja, pengembangan sistem informasi, dan sebaliknya konsultasi pemanfaatan TI untuk menunjang kegiatan kerja, pengembangan sistem informasi, dan sebaliknya konsultasi pemanfaatan TI untuk menunjang kegiatan kerja, pengembangan sistem informasi, dan sebaliknya konsultasi pemanfaatan TI untuk menunjang kegiatan kerja.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
