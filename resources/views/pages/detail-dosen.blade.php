@extends('layouts.app')

@section('title', $lecturer['name'] . ' - JTK POLBAN')

@section('content')
    <!-- Hero Section with Profile -->
    <div class="bg-gradient-to-r from-navy-900 to-navy-950 text-white pt-24 pb-12 shadow-sm">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-6">
                <div class="w-24 h-24 bg-white text-navy-900 rounded-full flex items-center justify-center shadow-lg font-extrabold text-3xl select-none">
                    {{ $lecturer['initials'] }}
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold mb-1 tracking-tight">{{ $lecturer['name'] }}</h1>
                    <p class="text-blue-200 text-sm font-medium">{{ $lecturer['position'] }}</p>
                </div>
            </div>
            <div class="mt-8 pt-4 border-t border-white/10 text-xs text-blue-200/85 flex items-center space-x-2">
                <a href="/" class="hover:text-white transition">Beranda</a> 
                <span>&gt;</span>
                <a href="/profil-dosen" class="hover:text-white transition">Profil Dosen</a> 
                <span>&gt;</span>
                <span class="text-white font-medium">{{ $lecturer['name'] }}</span>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <section class="py-16 bg-[#FAFAFA]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Informasi Utama -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 mb-12 shadow-sm">
                <h2 class="text-lg font-bold text-navy-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-sky-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Informasi Utama
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                    <div class="border-b border-gray-100 pb-3 md:pb-4">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                        <p class="text-sm font-semibold text-navy-900">{{ $lecturer['fullName'] }}</p>
                    </div>
                    <div class="border-b border-gray-100 pb-3 md:pb-4">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jenis Kelamin</p>
                        <p class="text-sm font-semibold text-navy-900">{{ $lecturer['gender'] == 'L' ? 'Laki-laki' : ($lecturer['gender'] == 'P' ? 'Perempuan' : $lecturer['gender']) }}</p>
                    </div>
                    <div class="border-b border-gray-100 pb-3 md:pb-4">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pendidikan Terakhir</p>
                        <p class="text-sm font-semibold text-navy-900">{{ $lecturer['education'] }}</p>
                    </div>
                    <div class="border-b border-gray-100 pb-3 md:pb-4">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jabatan Fungsional</p>
                        <p class="text-sm font-semibold text-navy-900">{{ $lecturer['functional'] }}</p>
                    </div>
                    <div class="border-b border-gray-100 pb-3 md:pb-4">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Perguruan Tinggi</p>
                        <p class="text-sm font-semibold text-navy-900">Politeknik Negeri Bandung</p>
                    </div>
                    <div class="border-b border-gray-100 pb-3 md:pb-4">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status Ikatan Kerja</p>
                        <p class="text-sm font-semibold text-navy-900">Dosen Tetap</p>
                    </div>
                    <div class="col-span-1 md:col-span-2 pt-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Status Aktivitas</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ strtolower($lecturer['activityStatus']) == 'aktif' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-100 text-gray-700' }}">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ strtolower($lecturer['activityStatus']) == 'aktif' ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                            {{ $lecturer['activityStatus'] }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Education & Teaching History Section -->
            <div class="mb-12">
                <h2 class="text-xl font-bold text-navy-900 mb-6">Riwayat Dosen</h2>
                
                <!-- Tabs -->
                <div class="flex space-x-2 border-b border-gray-200 mb-6">
                    <button id="btn-edu" onclick="switchRiwayat('edu')" class="px-5 py-3 font-semibold text-sm text-navy-900 border-b-2 border-navy-900 transition-all">
                        Riwayat Pendidikan
                    </button>
                    <button id="btn-teach" onclick="switchRiwayat('teach')" class="px-5 py-3 font-semibold text-sm text-gray-500 hover:text-navy-900 border-b-2 border-transparent transition-all">
                        Riwayat Mengajar
                    </button>
                </div>

                <!-- Education Content -->
                <div id="content-edu" class="block bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                    @if(count($lecturer['educationList']) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200">
                                        <th class="px-6 py-4 text-left font-bold text-navy-900 text-xs uppercase tracking-wider">Perguruan Tinggi</th>
                                        <th class="px-6 py-4 text-left font-bold text-navy-900 text-xs uppercase tracking-wider">Gelar Akademik</th>
                                        <th class="px-6 py-4 text-left font-bold text-navy-900 text-xs uppercase tracking-wider">Tahun Lulus</th>
                                        <th class="px-6 py-4 text-left font-bold text-navy-900 text-xs uppercase tracking-wider">Jenjang</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($lecturer['educationList'] as $edu)
                                        <tr class="hover:bg-gray-50/50 transition">
                                            <td class="px-6 py-4 text-sm text-navy-900 font-semibold">{{ $edu['institution'] }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $edu['degree'] }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $edu['year'] }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $edu['duration'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="px-6 py-12 text-center text-gray-500 text-sm">
                            Tidak ada data riwayat pendidikan.
                        </div>
                    @endif
                </div>

                <!-- Teaching History Content -->
                <div id="content-teach" class="hidden bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                    @if(count($lecturer['teachingHistoryList']) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200">
                                        <th class="px-6 py-4 text-left font-bold text-navy-900 text-xs uppercase tracking-wider">Mata Kuliah</th>
                                        <th class="px-6 py-4 text-left font-bold text-navy-900 text-xs uppercase tracking-wider">Tahun Akademik</th>
                                        <th class="px-6 py-4 text-left font-bold text-navy-900 text-xs uppercase tracking-wider">Semester</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($lecturer['teachingHistoryList'] as $history)
                                        <tr class="hover:bg-gray-50/50 transition">
                                            <td class="px-6 py-4 text-sm text-navy-900 font-semibold">{{ $history['course'] }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $history['year'] }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $history['semester'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="px-6 py-12 text-center text-gray-500 text-sm">
                            Tidak ada data riwayat mengajar.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Portfolio Section -->
            <div class="mb-12">
                <h2 class="text-xl font-bold text-navy-900 mb-6">Portofolio Dosen</h2>
                
                <!-- Tabs for Portfolio -->
                <div class="flex space-x-1 border-b border-gray-200 mb-6 overflow-x-auto">
                    <button id="btn-research" onclick="switchPortofolio('research')" class="px-5 py-3 font-semibold text-sm text-navy-900 border-b-2 border-navy-900 transition-all whitespace-nowrap">
                        Penelitian
                    </button>
                    <button id="btn-service" onclick="switchPortofolio('service')" class="px-5 py-3 font-semibold text-sm text-gray-500 hover:text-navy-900 border-b-2 border-transparent transition-all whitespace-nowrap">
                        Pengabdian Masyarakat
                    </button>
                    <button id="btn-pub" onclick="switchPortofolio('pub')" class="px-5 py-3 font-semibold text-sm text-gray-500 hover:text-navy-900 border-b-2 border-transparent transition-all whitespace-nowrap">
                        Publikasi Karya
                    </button>
                    <button id="btn-hki" onclick="switchPortofolio('hki')" class="px-5 py-3 font-semibold text-sm text-gray-500 hover:text-navy-900 border-b-2 border-transparent transition-all whitespace-nowrap">
                        HKI/Paten
                    </button>
                </div>

                <!-- Penelitian Content -->
                <div id="content-research" class="block space-y-4">
                    @forelse($lecturer['researchList'] as $research)
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-sm transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-semibold text-navy-900 mb-2 leading-relaxed text-sm md:text-base">{{ $research['title'] }}</p>
                                    <p class="text-xs text-gray-400">Tahun Penelitian: {{ $research['year'] }}</p>
                                </div>
                                <span class="text-xs font-semibold bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full whitespace-nowrap ml-4 shadow-sm border border-blue-100">
                                    {{ $research['year'] }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center text-gray-500 text-sm">
                            Tidak ada riwayat penelitian.
                        </div>
                    @endforelse
                </div>

                <!-- Pengabdian Content -->
                <div id="content-service" class="hidden space-y-4">
                    @forelse($lecturer['communityServiceList'] as $service)
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-sm transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-semibold text-navy-900 mb-2 leading-relaxed text-sm md:text-base">{{ $service['title'] }}</p>
                                    <p class="text-xs text-gray-400">Tahun Pengabdian: {{ $service['year'] }}</p>
                                </div>
                                <span class="text-xs font-semibold bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full whitespace-nowrap ml-4 shadow-sm border border-blue-100">
                                    {{ $service['year'] }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center text-gray-500 text-sm">
                            Tidak ada riwayat pengabdian masyarakat.
                        </div>
                    @endforelse
                </div>

                <!-- Publikasi Content -->
                <div id="content-pub" class="hidden space-y-4">
                    @forelse($lecturer['publicationList'] as $pub)
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-sm transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-semibold text-navy-900 mb-2 leading-relaxed text-sm md:text-base">{{ $pub['title'] }}</p>
                                    <p class="text-xs text-gray-400">Tahun Publikasi: {{ $pub['year'] }}</p>
                                </div>
                                <span class="text-xs font-semibold bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full whitespace-nowrap ml-4 shadow-sm border border-blue-100">
                                    {{ $pub['year'] }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center text-gray-500 text-sm">
                            Tidak ada riwayat publikasi karya.
                        </div>
                    @endforelse
                </div>

                <!-- HKI/Paten Content -->
                <div id="content-hki" class="hidden space-y-4">
                    @forelse($lecturer['hkiList'] as $hki)
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-sm transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-semibold text-navy-900 mb-2 leading-relaxed text-sm md:text-base">{{ $hki['title'] }}</p>
                                    <p class="text-xs text-gray-400">Tahun HKI/Paten: {{ $hki['year'] }}</p>
                                </div>
                                <span class="text-xs font-semibold bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full whitespace-nowrap ml-4 shadow-sm border border-blue-100">
                                    {{ $hki['year'] }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center text-gray-500 text-sm">
                            Tidak ada data HKI/Paten/Penghargaan.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- PDDikti Info -->
            <div class="bg-blue-50/50 border border-blue-100 p-6 rounded-2xl shadow-sm flex items-start space-x-4">
                <span class="text-3xl">📊</span>
                <div>
                    <h3 class="font-bold text-navy-900 mb-1 text-sm">Data Terintegrasi dengan PDDikti</h3>
                    <p class="text-xs text-gray-600 mb-3 leading-relaxed">
                        Informasi riwayat dosen dan portofolio disinkronkan secara berkala dengan Pangkalan Data Pendidikan Tinggi (PDDikti) Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi.
                    </p>
                    <a href="https://pddikti.kemdikbud.go.id" target="_blank" class="inline-flex items-center text-sky-light font-bold hover:text-sky-bright transition text-xs">
                        Kunjungi PDDikti
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Script for interactive tabs -->
    <script>
        function switchRiwayat(type) {
            const btnEdu = document.getElementById('btn-edu');
            const btnTeach = document.getElementById('btn-teach');
            const contentEdu = document.getElementById('content-edu');
            const contentTeach = document.getElementById('content-teach');

            if (type === 'edu') {
                btnEdu.classList.remove('text-gray-500', 'border-transparent');
                btnEdu.classList.add('text-navy-900', 'border-navy-900');
                btnTeach.classList.remove('text-navy-900', 'border-navy-900');
                btnTeach.classList.add('text-gray-500', 'border-transparent');

                contentEdu.classList.remove('hidden');
                contentEdu.classList.add('block');
                contentTeach.classList.remove('block');
                contentTeach.classList.add('hidden');
            } else {
                btnTeach.classList.remove('text-gray-500', 'border-transparent');
                btnTeach.classList.add('text-navy-900', 'border-navy-900');
                btnEdu.classList.remove('text-navy-900', 'border-navy-900');
                btnEdu.classList.add('text-gray-500', 'border-transparent');

                contentTeach.classList.remove('hidden');
                contentTeach.classList.add('block');
                contentEdu.classList.remove('block');
                contentEdu.classList.add('hidden');
            }
        }

        function switchPortofolio(type) {
            const tabs = ['research', 'service', 'pub', 'hki'];
            
            tabs.forEach(tab => {
                const btn = document.getElementById('btn-' + tab);
                const content = document.getElementById('content-' + tab);
                
                if (tab === type) {
                    btn.classList.remove('text-gray-500', 'border-transparent');
                    btn.classList.add('text-navy-900', 'border-navy-900');
                    content.classList.remove('hidden');
                    content.classList.add('block');
                } else {
                    btn.classList.remove('text-navy-900', 'border-navy-900');
                    btn.classList.add('text-gray-500', 'border-transparent');
                    content.classList.remove('block');
                    content.classList.add('hidden');
                }
            });
        }
    </script>
@endsection
