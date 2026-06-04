@extends('layouts.app')

@section('title', 'Detail Program Studi - JTK POLBAN')

@section('content')
    <div id="detail-loading" class="py-20 text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#00008B] mx-auto"></div>
        <p class="mt-4 text-gray-600 font-['Poppins']">Memuat informasi program studi...</p>
    </div>

    <div id="detail-container" class="hidden font-['Poppins'] bg-[#FAFAFA]">
        <!-- Hero Section -->
        <x-hero 
            title="D3 Teknik Informatika"
            subtitle=""
            bgImage="true">
            <span>
                <a href="/" class="underline hover:text-white transition">Beranda</a> > 
                <a href="/program-studi" class="underline hover:text-white transition">Program Studi</a> > 
                <span id="breadcrumb-current" class="text-gray-300">D3 Teknik Informatika</span>
            </span>
        </x-hero>

        <!-- Program Overview for D3 -->
        <section id="layout-d3" class="py-16 bg-white hidden">
            <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12 space-y-10">
                
                <!-- Visi Program Studi -->
                <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300">
                    <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Visi Program Studi</h2>
                    <p id="vision-text-d3" class="text-gray-700 leading-relaxed text-[16px] font-medium"></p>
                </div>

                <!-- Misi Program Studi -->
                <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300">
                    <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Misi Program Studi</h2>
                    <ul id="mission-list-d3" class="space-y-4 text-[15px] font-medium text-gray-700">
                        <!-- Items via JS -->
                    </ul>
                </div>

                <!-- Tujuan Program Studi -->
                <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300">
                    <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Tujuan Program Studi</h2>
                    <ul id="objective-list-d3" class="space-y-4 text-[15px] font-medium text-gray-700">
                        <!-- Items via JS -->
                    </ul>
                </div>

                <!-- Profil Lulusan -->
                <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300">
                    <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Profil Lulusan</h2>
                    <p id="profile-intro-d3" class="text-gray-700 mb-6 leading-relaxed text-[15px] font-medium"></p>
                    
                    <div id="profil-lulusan-grid-d3" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Items via JS -->
                    </div>
                </div>

                <!-- Posisi Pekerjaan Yang Tersedia -->
                <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300">
                    <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Posisi Pekerjaan Yang Tersedia</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed text-[15px] font-medium">
                        Hampir semua bidang memerlukan keahlian TI, dengan berbagai kriteria dan kompetensi. Pekerjaan yang Tersedia diantaranya:
                    </p>
                    
                    <div id="pekerjaan-grid-d3" class="grid grid-cols-1 md:grid-cols-3 gap-8 border-t border-blue-100/50 pt-8">
                        <!-- Columns via JS -->
                    </div>
                </div>

                <!-- Akreditasi -->
                <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300">
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-navy-900 mb-3 tracking-tight">Akreditasi</h2>
                            <p id="akreditasi-text-d3" class="text-gray-700 leading-relaxed text-[15px] font-medium"></p>
                        </div>
                        <div class="flex flex-col sm:flex-row lg:flex-col gap-4 w-full lg:w-auto shrink-0">
                            <a id="download-cert-btn-d3" href="#" target="_blank" rel="noopener noreferrer" class="px-6 py-3.5 bg-[#00008B] text-white font-bold rounded-xl hover:bg-blue-900 transition text-center shadow-lg shadow-blue-900/20 text-sm tracking-wide">
                                Unduh Sertifikat Akreditasi
                            </a>
                            <a id="visit-lam-btn-d3" href="#" target="_blank" rel="noopener noreferrer" class="px-6 py-3.5 border-2 border-[#00008B] text-[#00008B] font-bold rounded-xl hover:bg-blue-50 transition text-center text-sm tracking-wide">
                                Kunjungi LAM INFOKOM
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Program Overview for D4 -->
        <section id="layout-d4" class="py-16 bg-white hidden">
            <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12 space-y-10">
                
                <!-- Tentang Program Studi -->
                <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300">
                    <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Tentang Program Studi</h2>
                    <div id="about-text-d4" class="text-gray-700 leading-relaxed text-[15px] font-medium space-y-4">
                        <!-- Paragraphs via JS -->
                    </div>
                </div>

                <!-- Grid 3 Kolom: Visi, Misi, Tujuan -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Visi Program Studi -->
                    <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300 flex flex-col">
                        <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Visi Program Studi</h2>
                        <p id="vision-text-d4" class="text-gray-700 leading-relaxed text-[15px] font-medium flex-1"></p>
                    </div>

                    <!-- Misi Program Studi -->
                    <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300 flex flex-col">
                        <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Misi Program Studi</h2>
                        <p id="mission-text-d4" class="text-gray-700 leading-relaxed text-[15px] font-medium flex-1"></p>
                    </div>

                    <!-- Tujuan Program Studi -->
                    <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300 flex flex-col">
                        <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Tujuan Program Studi</h2>
                        <div class="flex-1 flex flex-col justify-between">
                            <p class="text-gray-700 leading-relaxed text-[15px] font-bold mb-3">Menjalankan program pendidikan secara konsisten dan utuh sehingga menghasilkan lulusan yang mampu:</p>
                            <ul id="objective-list-d4" class="space-y-3.5 text-[15px] font-medium text-gray-700 flex-1">
                                <!-- Items via JS -->
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Grid 3 Kolom: Kualifikasi Dosen, Fasilitas Penunjang, Prospek Lulusan -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Kualifikasi Dosen -->
                    <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300 flex flex-col">
                        <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Kualifikasi Dosen</h2>
                        <p id="lecturer-qualification-d4" class="text-gray-700 leading-relaxed text-[15px] font-medium flex-1"></p>
                    </div>

                    <!-- Fasilitas Penunjang -->
                    <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300 flex flex-col">
                        <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Fasilitas Penunjang</h2>
                        <ul id="facilities-list-d4" class="space-y-2 text-[15px] font-medium text-gray-700 flex-1">
                            <!-- Items via JS -->
                        </ul>
                    </div>

                    <!-- Prospek Lulusan -->
                    <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300 flex flex-col">
                        <h2 class="text-2xl font-bold text-navy-900 mb-4 tracking-tight border-b border-blue-100 pb-2">Prospek Lulusan</h2>
                        <div class="flex-1 flex flex-col justify-between">
                            <p id="career-prospects-intro-d4" class="text-gray-700 leading-relaxed text-[15px] font-medium mb-3"></p>
                            <ul id="career-prospects-list-d4" class="space-y-2 text-[15px] font-medium text-gray-700 flex-1">
                                <!-- Items via JS -->
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Akreditasi -->
                <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300">
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-navy-900 mb-3 tracking-tight">Akreditasi</h2>
                            <p id="akreditasi-text-d4" class="text-gray-700 leading-relaxed text-[15px] font-medium"></p>
                        </div>
                        <div class="flex flex-col sm:flex-row lg:flex-col gap-4 w-full lg:w-auto shrink-0">
                            <a id="download-cert-btn-d4" href="#" target="_blank" rel="noopener noreferrer" class="px-6 py-3.5 bg-[#00008B] text-white font-bold rounded-xl hover:bg-blue-900 transition text-center shadow-lg shadow-blue-900/20 text-sm tracking-wide">
                                Unduh Sertifikat Akreditasi
                            </a>
                            <a id="visit-lam-btn-d4" href="#" target="_blank" rel="noopener noreferrer" class="px-6 py-3.5 border-2 border-[#00008B] text-[#00008B] font-bold rounded-xl hover:bg-blue-50 transition text-center text-sm tracking-wide">
                                Kunjungi LAM INFOKOM
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slug = "{{ $slug }}";
            let dbSlug = slug;
            
            // Map web route slugs to database study program slugs
            if (slug === 'd3') {
                dbSlug = 'd3-teknik-informatika';
            } else if (slug === 'sarjana') {
                dbSlug = 'sarjana-terapan-teknik-informatika';
            }

            const container = document.getElementById('detail-container');
            const loading = document.getElementById('detail-loading');

            // Hardcoded specific metadata for D3 and D4 based on Figma Mockups
            const programDetails = {
                'D3': {
                    tujuan: [
                        'Menghasikan tenaga di bidang perancangan dan implementasi perangkat lunak bisnis serta perancangan solusi bisnis berbasis teknologi informasi untuk menunjang kebutuhan masyarakat dan industri di lingkup nasional dan internasional, yang memiliki sikap dan kemampuan sebagai berikut: <ul class="list-disc pl-6 mt-3 space-y-1.5 text-gray-600 font-normal"><li>beradaptasi terhadap perkembangan teknologi informasi</li><li>belajar sepanjang hayat dan ulet</li><li>berpikir kreatif, analitis dan sistematis</li><li>berwirausaha</li><li>bermoral</li><li>berkomunikasi dalam bahasa internasional</li></ul>',
                        'Menghasilkan lulusan dengan kompetensi yang diakui pada tingkat nasional maupun internasional.',
                        'Mendorong mahasiswa untuk menghasilkan produk terapan di bidang perangkat lunak bisnis yang bermanfaat bagi masyarakat dan industri baik nasional maupun internasional.',
                        'Menghasikan produk pelayanan dan produk penelitian terapan di bidang teknologi informasi yang bermanfaat bagi masyarakat dan industri baik di tingkat nasional maupun internasional.'
                    ],
                    profilLulusan: [
                        { title: 'Pengembangan Perangkat Lunak dan aplikasi' },
                        { title: 'Konsultan Industri Teknologi Informasi' },
                        { title: 'Pengembangan Perangkat Lunak multimedia' },
                        { title: 'Pemeliharaan Teknologi Jaringan' }
                    ],
                    pekerjaan: [
                        {
                            kategori: 'OPERATOR',
                            items: ['Drafter', 'Tester', 'Office Automation']
                        },
                        {
                            kategori: 'PROGRAMMER',
                            items: ['Documenter', 'Administrator', 'Programmer']
                        },
                        {
                            kategori: 'ANALIS & DESIGNER',
                            items: ['Testing Engineer', 'Requirement Analyst', 'Designer']
                        }
                    ],
                    akreditasi: {
                        text: 'Terakreditasi "Unggul" tahun 2023. Berlaku hingga 2028-08-07, berdasarkan No. SK. 073/SK/LAM-INFOKOM/Ak/D3/VIII/2023. Sertifikat Akreditasi dapat di unduh melalui tautan ini. Informasi lebih lanjut dapat dilihat melalui Web LAM INFOKOM.',
                        downloadUrl: 'https://www.polban.ac.id/wp-content/uploads/2024/01/24.-Sertifikat-Akreditasi-D3-Teknik-Informatika_073-2023-2028.pdf',
                        lamUrl: 'https://laminfokom.or.id/official/data-akreditasi-1.html'
                    }
                },
                'D4': {
                    tentang: "Perkembangan perekonomian global secara positif telah menjadi tantangan dan peluang bagi semua negara termasuk Indonesia. Selaras dengan perkembangan industri khususnya dibidang Teknologi Informasi dan Komunikasi, serta kebijakan otonomi daerah di Indonesia, setiap institusi dituntut untuk mampu memanfaatkan teknologi dan kebijakan ini secara optimal. Oleh karena itu setiap institusi secara maksimal perlu mempersiapkan sumber daya manusianya sehingga memadai, baik dari segi kuantitas maupun kualitasnya.\n\nInstitusi pendidikan tinggi merupakan lembaga utama dalam menciptakan para calon praktisi dalam di industri.\n\nSalah satu program pendidikan yang turut berperan adalah program pendidikan jalur vokasi, Politeknik Negeri Bandung sebagai lembaga pendidikan jalur vokasi memiliki potensi dan kesempatan yang memadai dalam mendukung tuntutan penyediaan sumber daya manusia (SDM) dibidang Teknologi Informasi dan Komunikasi.\n\nSeiring dengan pemanfaatan perangkat lunak diberbagai bidang kehidupan dan KEPMEN 232/U/2000, maka Indonesia banyak memerlukan tenaga ahli yang mampu melaksanakan pekerjaan yang kompleks berdasarkan kemampuan profesional dibidang informatika.\n\nUntuk itu, pada Juli 2009 didirikanlah program pendidikan D IV (Sarjana Terapan) bidang informatika di Jurusan Teknik Komputer dan Informatika untuk menjawab kebutuhan terhadap penyediaan SDM yang berkaitan dengan produksi dan pemanfaatan perangkat lunak. Program studi ini dikukuhkan melalui SK Penyelenggaraan Program Studi dari Dikti dengan nomor 1265/D/T/2009.",
                    tujuan: [
                        'Menunjukkan keunggulan keahlian dan pengetahuan, serta memiliki sikap profesionalisme yang dibutuhkan untuk menjadi seorang software engineer.',
                        'Bekerja secara individu dan menjadi bagian dari suatu tim untuk membangun, menyajikan dan memelihara perangkat lunak yang berkualitas.',
                        'Mengelola proyek pembangunan perangkat lunak.'
                    ],
                    kualifikasiDosen: 'Dosen program studi ini berkualifikasi S2 dan S3 dari perguruan tinggi ternama dari dalam negeri (ITB, UI), maupun dari luar negeri (Inggris, Jepang, Amerika, Australia). Mayoritas dosen telah tersertifikasi (sertifikasi dosen).',
                    fasilitas: [
                        'Laboratorium Rekayasa Perangkat Lunak',
                        'Laboratorium Sistem Informasi dan Basis Data',
                        'Laboratorium Multimedia',
                        'Laboratorium Project-Based Learning',
                        'Laboratorium Artificial Intelligence',
                        'Laboratorium Teknologi Informasi'
                    ],
                    prospekKerja: 'Lulusan dari program studi ini berpotensi untuk bekerja pada kelompok bidang pekerjaan berikut:',
                    prospekKerjaList: [
                        'Senior Analyst',
                        'System Developer',
                        'Software Testing Professional',
                        'Manager IT'
                    ],
                    akreditasi: {
                        text: 'Terakreditasi "Unggul" tahun 2025. Berlaku hingga 2030-08-15, berdasarkan No. SK. 146/SK/LAM-INFOKOM/Ak/STr/VIII/2025. Sertifikat Akreditasi dapat di unduh melalui tautan ini. Informasi lebih lanjut dapat dilihat melalui Web LAM INFOKOM.',
                        downloadUrl: 'https://www.polban.ac.id/wp-content/uploads/2025/08/file_sertifikat_25051520395200500455301_1755423415.pdf',
                        lamUrl: 'https://laminfokom.or.id/official/data-akreditasi-1.html'
                    }
                }
            };

            fetch(`/api/study-programs/${dbSlug}`)
                .then(response => {
                    if (!response.ok) throw new Error('Program tidak ditemukan');
                    return response.json();
                })
                .then(response => {
                    const program = response.data;
                    // Determine degree (fallback to D3 if not D4)
                    const degree = (program.degree && program.degree.toUpperCase() === 'D4') ? 'D4' : 'D3';
                    const data = programDetails[degree];

                    loading.classList.add('hidden');
                    container.classList.remove('hidden');

                    // Update Page Title
                    document.title = `${program.name} - JTK POLBAN`;
                    
                    // Update Hero
                    const heroTitle = container.querySelector('h1');
                    if (heroTitle) heroTitle.innerText = program.name;
                    
                    const heroSubtitle = container.querySelector('p');
                    if (heroSubtitle) heroSubtitle.innerText = program.description || '';

                    const breadcrumb = document.getElementById('breadcrumb-current');
                    if (breadcrumb) breadcrumb.innerText = program.name;

                    // Helper to safely extract string from either direct string or simple repeater object
                    const textOf = (item) => {
                        if (typeof item === 'string') return item;
                        if (!item) return '';
                        return item.objective || item.profile || item.item || item.value || Object.values(item)[0] || '';
                    };

                    if (degree === 'D4') {
                        document.getElementById('layout-d4').classList.remove('hidden');
                        document.getElementById('layout-d3').classList.add('hidden');

                        // 1. Tentang
                        const aboutContainer = document.getElementById('about-text-d4');
                        const aboutText = program.about || data.tentang;
                        aboutContainer.innerHTML = aboutText.split(/\n\n+/).map(pText => {
                            return `<p class="mb-4 text-gray-700 leading-relaxed text-[15px] font-medium last:mb-0">${pText.replace(/\n/g, '<br>')}</p>`;
                        }).join('');

                        // 2. Visi
                        document.getElementById('vision-text-d4').innerText = program.vision || 'Visi belum tersedia.';

                        // 3. Misi
                        document.getElementById('mission-text-d4').innerHTML = (program.mission || 'Misi belum tersedia.').replace(/\n/g, '<br>');

                        // 4. Tujuan
                        const objectiveList = document.getElementById('objective-list-d4');
                        const objectives = (program.objectives && program.objectives.length > 0) ? program.objectives : data.tujuan;
                        objectiveList.innerHTML = objectives.map((t, idx) => `
                            <li class="flex items-start space-x-2.5">
                                <span class="text-[#00008B] font-extrabold text-[15px] mt-0.5">${idx + 1}.</span>
                                <span class="text-gray-700 leading-relaxed">${textOf(t)}</span>
                            </li>
                        `).join('');

                        // 5. Kualifikasi Dosen
                        document.getElementById('lecturer-qualification-d4').innerText = program.lecturer_qualification || data.kualifikasiDosen;

                        // 6. Fasilitas Penunjang
                        const facilitiesList = document.getElementById('facilities-list-d4');
                        const facilities = (program.facilities && program.facilities.length > 0) ? program.facilities : data.fasilitas;
                        facilitiesList.innerHTML = facilities.map(f => `
                            <li class="flex items-start space-x-2">
                                <span class="text-[#00008B] font-extrabold text-[15px] mt-0.5">•</span>
                                <span class="text-gray-700 leading-relaxed">${textOf(f)}</span>
                            </li>
                        `).join('');

                        // 7. Prospek Lulusan
                        document.getElementById('career-prospects-intro-d4').innerText = program.career_prospects || data.prospekKerja;
                        const prospectsList = document.getElementById('career-prospects-list-d4');
                        const prospects = (program.career_prospects_list && program.career_prospects_list.length > 0) ? program.career_prospects_list : data.prospekKerjaList;
                        prospectsList.innerHTML = prospects.map(p => `
                            <li class="flex items-start space-x-2">
                                <span class="text-[#00008B] font-extrabold text-[15px] mt-0.5">•</span>
                                <span class="text-gray-700 leading-relaxed">${textOf(p)}</span>
                            </li>
                        `).join('');

                        // 8. Akreditasi
                        document.getElementById('akreditasi-text-d4').innerText = program.accreditation_text || data.akreditasi.text;
                        document.getElementById('download-cert-btn-d4').href = program.accreditation_certificate_url || data.akreditasi.downloadUrl;
                        document.getElementById('visit-lam-btn-d4').href = program.accreditation_website_url || data.akreditasi.lamUrl;

                    } else {
                        document.getElementById('layout-d3').classList.remove('hidden');
                        document.getElementById('layout-d4').classList.add('hidden');

                        // Update Visi
                        document.getElementById('vision-text-d3').innerText = program.vision || 'Visi belum tersedia.';
                        
                        // Update Misi
                        const missionList = document.getElementById('mission-list-d3');
                        if (program.mission) {
                            const missions = program.mission.split('\n').filter(m => m.trim().length > 0);
                            missionList.innerHTML = missions.map((m, idx) => `
                                <li class="flex items-start space-x-3.5">
                                    <span class="text-[#00008B] font-extrabold text-[16px] mt-0.5">${idx + 1}.</span>
                                    <span class="text-gray-700 leading-relaxed">${m}</span>
                                </li>
                            `).join('');
                        } else {
                            missionList.innerHTML = '<li class="text-gray-500 italic">Misi belum tersedia.</li>';
                        }

                        // Update Tujuan
                        const objectiveList = document.getElementById('objective-list-d3');
                        const objectives = (program.objectives && program.objectives.length > 0) ? program.objectives : data.tujuan;
                        objectiveList.innerHTML = objectives.map((t, idx) => `
                            <li class="flex items-start space-x-3.5">
                                <span class="text-[#00008B] font-extrabold text-[16px] mt-0.5">${idx + 1}.</span>
                                <span class="text-gray-700 leading-relaxed">${textOf(t)}</span>
                            </li>
                        `).join('');

                        // Update Profil Lulusan
                        const graduateProfiles = (program.graduate_profiles && program.graduate_profiles.length > 0) ? program.graduate_profiles : data.profilLulusan;
                        document.getElementById('profile-intro-d3').innerText = `Lulusan program studi ${program.name} dibekali dengan pengetahuan teoritis dan pengalaman praktek sehingga siap masuk ke dunia kerja. Lulusan akan mampu bekerja pada bidang, misalnya seperti :`;
                        
                        const profilGrid = document.getElementById('profil-lulusan-grid-d3');
                        profilGrid.innerHTML = graduateProfiles.map(p => {
                            const title = typeof p === 'string' ? p : (p.title || p.profile || Object.values(p)[0] || '');
                            return `
                                <div class="bg-white border border-blue-100 rounded-xl p-6 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-300 flex items-center justify-center text-center min-h-[90px]">
                                    <p class="font-extrabold text-navy-900 text-[15px] leading-snug tracking-tight">${title}</p>
                                </div>
                            `;
                        }).join('');

                        // Update Pekerjaan
                        const jobPositions = (program.job_positions && program.job_positions.length > 0) ? program.job_positions : data.pekerjaan;
                        const pekerjaanGrid = document.getElementById('pekerjaan-grid-d3');
                        pekerjaanGrid.innerHTML = jobPositions.map(p => {
                            const category = p.category || '';
                            const items = p.items || [];
                            return `
                                <div class="flex flex-col items-center">
                                    <h4 class="font-black text-[#00008B] text-base tracking-widest mb-5 w-full text-center border-b border-blue-100 pb-2.5">${category}</h4>
                                    <ul class="space-y-3.5 text-center w-full">
                                        ${items.map(item => `
                                            <li class="text-gray-700 font-semibold text-[14px]">
                                                <span class="text-[#00008B] mr-2">•</span>${textOf(item)}
                                            </li>
                                        `).join('')}
                                    </ul>
                                </div>
                            `;
                        }).join('');

                        // Update Akreditasi
                        document.getElementById('akreditasi-text-d3').innerText = program.accreditation_text || data.akreditasi.text;
                        document.getElementById('download-cert-btn-d3').href = program.accreditation_certificate_url || data.akreditasi.downloadUrl;
                        document.getElementById('visit-lam-btn-d3').href = program.accreditation_website_url || data.akreditasi.lamUrl;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading.innerHTML = `
                        <div class="p-20 text-center font-['Poppins']">
                            <p class="text-red-500 mb-4 font-bold">Oops! ${error.message}</p>
                            <p class="text-gray-600 mb-6">Pastikan slug program studi ("${slug}") sudah benar di database.</p>
                            <a href="/program-studi" class="text-navy-900 underline font-semibold">Kembali ke Daftar Program Studi</a>
                        </div>
                    `;
                });
        });
    </script>
@endsection
