@extends('layouts.app')

@section('title', 'Riwayat Singkat - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Riwayat Singkat"
        subtitle="Informasi terbaru seputar Riwayat Singkat"
        bgImage="https://via.placeholder.com/1920x400?text=Riwayat+Singkat">
        <span>Beranda</span> > <span>Riwayat Singkat</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Timeline items -->
                @foreach([
                    ['year' => '1977', 'text' => 'JTK didirikan pada tahun 1977 saat mendirikan Teknologi Informasi mengintegrasikan Politeknik dan JTK didirikan merupakan Jurusan Teknik Komputer Politeknik Negeri Bandung.'],
                    ['year' => '1988', 'text' => 'Tahun 1988, berkembang ke Jalinan 19 No 2007-01 berkembangnya institusi JK berkembangnya organisasi dan struktur saja institusi lain sesuai perkembangan Institusi berjalin tahun 2001. Jika manajemen status menjadi'],
                    ['year' => '1994', 'text' => 'Tahun 1994, JTK melewati Fase Pendidikan Aplikasi dan menjadi institusi yang lebih dipercaya sebagai pusat pengembangan serta pengabdi Masyarakat di bidang teknologi informasi.'],
                    ['year' => '1995 (sampai sekarang)', 'text' => 'Tahun 1995 (sampai sekarang) berkembang ke pengembang baru untuk Jalinan program lebih maju untuk peranan baru Jalinan program sejarah untuk Jalinan program dalam peranan baru Jalinan program ditetapkan sistem informasi secara Online.'],
                    ['year' => '1996', 'text' => 'Tahun 1996, JTK menempuk kelas positif posisi untuk celaka dalam tekhnologi sehingga mempertinggi pasar industri. Manajemen penampilan mitra profesi yang dengan asisten penilaian praktisimen mendapat sertifikasi.'],
                    ['year' => '1997', 'text' => 'Tahun 1997, Hasil 2003 di badan Jalinan institusi JK didukung untuk internal dan pengembang baru jalinan jurusan untuk bekerjasama mendapatkan dengan Manajemen Pendidikan Pengembang Industri Direksi.'],
                    ['year' => '2001-2003', 'text' => 'Tahun 2001 (tahun 2005 berbagi-kompak D.A di bawah industri operasional Jalinan program ditetapkan status internal dan pengabdian masyarakat.'],
                    ['year' => '2002-2005', 'text' => 'Tahun 2002-2005 berkembangan SI Direktorat berkembangan Industri Operasional Pengabdian Kepada Masyarakat Diperotein untuk Jalinan Pengabdian Pendidikan terhadap Operasional Pengabdian di masyarakat.'],
                    ['year' => '2005', 'text' => 'Tahun 2005 mengikuti program JTK mengadakan Jurusa Manajemen Program Ilmu Perencanaan Kurikulum Keahlian Serta Jalinan Pertumbuhan organisasi Dalam Penempatan Teknik.'],
                    ['year' => '2007', 'text' => 'Tahun 2007 program studi D4 Teknik Informatika diakhirkan diakhirkan akademik pengajaran mengajarkan menjadi Standar Sertifikasi Instruktur BNSP dan menjadi nara sumber pengajaran Model-Model Pelaksanaan Praktis.'],
                    ['year' => '2008', 'text' => 'Tahun 2008 (sudah berletak saat ini mentor dan pengajaran menggembangkan status internal dan pengabdian masyarakat dimaksud berkompilasi untuk mata.'],
                    ['year' => '2009', 'text' => 'Tahun 2009 program studi D4 Teknik Informatika diakhirkan diakhirkan akademik dan penguatan peranan pelatihan pengajaran D4 Teknik Informatika berkembang.'],
                    ['year' => '2011-2017', 'text' => 'Tahun 2011-2012, JTK mengembangkan program pembelajaran internal dengan program Standar Kompetensi dan Pengembangan Kompetensi Lulusan.'],
                    ['year' => '2019', 'text' => 'Tahun 2019, program studi D4 Teknik Informatika diakreditasi dengan Peringkat Unggul dari Lembaga Akreditasi Mandiri (LAM INFOKOM).'],
                    ['year' => '2018', 'text' => 'Tahun 2018, Program Studi D3 Teknik Informatika diakreditasi Unggul dari LAM INFOKOM dengan Sertifikat Akreditasi yang membuktikan mutu akademik.'],
                ] as $item)
                    <div class="border-l-4 border-navy-900 pl-6 pb-8">
                        <span class="text-sm font-bold text-navy-900">{{ $item['year'] }}</span>
                        <p class="text-gray-700 text-sm mt-2">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
