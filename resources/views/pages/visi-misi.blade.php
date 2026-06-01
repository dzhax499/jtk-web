@extends('layouts.app')

@section('title', 'Visi dan Misi - JTK POLBAN')

@section('content')
    <x-hero
        title="Visi dan Misi"
        subtitle="Arah pengembangan, misi, dan tujuan Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://placehold.co/1920x400?text=Visi+Misi">
    </x-hero>

    <style>
        .db-page-content h1,
        .db-page-content h2,
        .db-page-content h3 {
            color: #000080;
            font-weight: 800;
            margin-top: 1.5rem;
            margin-bottom: .75rem;
        }
        .db-page-content h1 { font-size: 2rem; }
        .db-page-content h2 { font-size: 1.5rem; }
        .db-page-content h3 { font-size: 1.25rem; }
        .db-page-content p { margin-bottom: 1rem; line-height: 1.8; }
        .db-page-content ul,
        .db-page-content ol { margin-left: 1.5rem; margin-bottom: 1rem; line-height: 1.8; }
        .db-page-content ul { list-style-type: disc; }
        .db-page-content ol { list-style-type: decimal; }
        .db-page-content li { margin-bottom: .5rem; }
    </style>

    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(!empty($pageContent))
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8 md:p-10 text-gray-700 db-page-content">
                    {!! $pageContent !!}
                </div>
            @else
                <div class="bg-white border border-gray-200 rounded-lg p-8 mb-12">
                    <h2 class="text-2xl font-bold text-navy-900 mb-4">Visi</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi jurusan di bidang informatika yang unggul, bermutu, inovatif, serta adaptif terhadap perkembangan teknologi, berorientasi pada pendidikan vokasional, dan dikenal di tingkat nasional maupun internasional.
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-8 mb-12">
                    <h2 class="text-2xl font-bold text-navy-900 mb-4">Misi</h2>
                    <ol class="list-decimal list-inside space-y-3 text-gray-700">
                        <li>Menyelenggarakan pendidikan vokasional di bidang informatika yang berkualitas dan relevan dengan kebutuhan industri.</li>
                        <li>Mengembangkan penelitian terapan berbasis produk dan jasa di bidang informatika yang bermanfaat bagi masyarakat dan industri.</li>
                        <li>Melaksanakan pengabdian kepada masyarakat melalui pemanfaatan teknologi informatika yang relevan dan berdampak nyata.</li>
                    </ol>
                </div>
            @endif
        </div>
    </section>
@endsection
