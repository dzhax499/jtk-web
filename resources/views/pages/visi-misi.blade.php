@extends('layouts.app')

@section('title', 'Visi dan Misi - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Visi dan Misi"
        subtitle="Informasi terbaru seputar Visi, Misi, Tujuan dan Nilai-Nilai Utama"
        bgImage="https://via.placeholder.com/1920x400?text=Visi+dan+Misi">
        <span>Beranda</span> > <span>Visi dan Misi</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Visi -->
            <div class="bg-white border border-gray-200 rounded-lg p-8 mb-6">
                <h2 class="text-2xl font-bold text-navy-900 mb-4">Visi</h2>
                <p class="text-gray-700 leading-relaxed">
                    JTK memiliki visi untuk menjadi <strong>"jurusan di bidang informatika yang unggul, bermutu, inovatif serta adaptif terhadap perkembangan teknologi, berorientasi pada pendidikan vokasional, yang sikat di tingkat nasional dan internasional"</strong>.
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white border border-gray-200 rounded-lg p-8 mb-6">
                <h2 class="text-2xl font-bold text-navy-900 mb-4">Misi</h2>
                <ol class="list-decimal list-inside space-y-3 text-gray-700">
                    <li>Jurusan di bidang informatika yang unggul, bermutu, inovatif serta adaptif terhadap perkembangan teknologi, berorientasi pada pendidikan vokasional, yang sikat di tingkat nasional dan internasional</li>
                    <li>Mengembangkan segaran penelitian berbasis produk dan jasa di bidang informatika yang bermanfaat bagi masyarakat dan industri.</li>
                    <li>Mengembangkan kemampuan akademik masyarakat melalui pemanfaatan teknologi informatika yang relevan dan berdampak nyata.</li>
                    <li>Memperkuat jalinan deri kerja sama strategis dengan dunia usaha, dunia industri, dan pemerintah dalam pengembangan pendidikan dan teknologi informatika.</li>
                    <li>Melaksanakan tata kelola organisasi yang profesional, akuntabel, dan berorientasi pada perolehan berkelanjutan.</li>
                </ol>
            </div>

            <!-- Tujuan -->
            <div class="bg-white border border-gray-200 rounded-lg p-8 mb-12">
                <h2 class="text-2xl font-bold text-navy-900 mb-4">Tujuan</h2>
                <ol class="list-decimal list-inside space-y-3 text-gray-700">
                    <li>Menghasilkan lulusan pendidikan vokasional yang relevan dengan kebutuhan industri serta adaptif terhadap perkembangan teknologi informatika.</li>
                    <li>Meningkatkan kompetensi dan kinerja sumber daya manusia melalui penelitian terapan dan pemanfaatan teknologi informatika.</li>
                    <li>Meningkatkan pendidikan di bidang teknik informatika melalui kolaborasi dengan institusi pendidikan nasional dan internasional.</li>
                    <li>Meningkatkan kualitas layanan akademik dan non akademik kepada semua stakeholder.</li>
                    <li>Mewujudkan tata kelola jurusan yang transparan, akuntabel, responsibel, dan berwawasan lingkungan.</li>
                </ol>
            </div>

            <!-- Nilai-Nilai Utama -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-navy-900 mb-8 text-center">Nilai-Nilai Utama</h2>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                    <div class="bg-white border-2 border-navy-900 rounded-lg p-6 text-center">
                        <div class="text-4xl mb-3">🛡️</div>
                        <h3 class="font-bold text-navy-900 mb-2">Jujur</h3>
                        <p class="text-sm text-gray-600">Menjunjung tinggi nilai kejujuran dan integritas dalam segala hal</p>
                    </div>
                    <div class="bg-white border-2 border-navy-900 rounded-lg p-6 text-center">
                        <div class="text-4xl mb-3">⚡</div>
                        <h3 class="font-bold text-navy-900 mb-2">Tanggap</h3>
                        <p class="text-sm text-gray-600">Cepat dan tanggap terhadap setiap perubahan dan tantangan global</p>
                    </div>
                    <div class="bg-white border-2 border-navy-900 rounded-lg p-6 text-center">
                        <div class="text-4xl mb-3">🎯</div>
                        <h3 class="font-bold text-navy-900 mb-2">Kompeten</h3>
                        <p class="text-sm text-gray-600">Memiliki kemampuan profesional dan pengetahuan yang mendalam</p>
                    </div>
                    <div class="bg-white border-2 border-navy-900 rounded-lg p-6 text-center">
                        <div class="text-4xl mb-3">💡</div>
                        <h3 class="font-bold text-navy-900 mb-2">Inovatif</h3>
                        <p class="text-sm text-gray-600">Mampu berinovasi menciptakan solusi baru yang berkualitas</p>
                    </div>
                    <div class="bg-white border-2 border-navy-900 rounded-lg p-6 text-center">
                        <div class="text-4xl mb-3">⭐</div>
                        <h3 class="font-bold text-navy-900 mb-2">Kualitas</h3>
                        <p class="text-sm text-gray-600">Berkomitmen memberikan kualitas terbaik dalam setiap layanan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
