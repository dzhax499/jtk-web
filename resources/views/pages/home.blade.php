@extends('layouts.app')

@section('title', 'Beranda - JTK POLBAN')

@section('content')
    <!-- Hero Section khusus -->
    <div class="relative w-full h-[380px] md:h-[300px] overflow-hidden group font-['Poppins']">
        <div id="hero-slider" class="flex h-full w-full transition-transform duration-500 ease-in-out">           
            <div class="w-full h-full flex-shrink-0 relative" style="background-image: url('{{ asset('img/gedungh.png') }}'); background-size: cover; background-position: right center;">
                <div class="absolute inset-0 bg-gradient-to-r from-[#00008B] from-[15%] to-transparent"></div>             
                <div class="relative h-full max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16 w-full flex flex-col md:flex-row justify-between items-end pb-8 pt-8">  
                    <div class="flex-1 pr-4 mb-6 md:mb-2">
                        <h1 class="text-3xl md:text-5xl font-bold text-white mb-3 leading-tight ">
                            Jurusan Teknik Komputer dan Informatika
                        </h1>
                        <p class="text-sm md:text-base text-gray-200 max-w-2xl mb-4">
                            <span class="font-semibold">Politeknik Negeri Bandung</span><br>
                            Pusat pendidikan vokasi bidang teknologi informasi yang inovatif, kompeten, dan berorientasi industri.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto justify-end mb-2">
                        <a href="/program-studi" class="bg-[#00008B] text-white text-sm md:text-base px-6 py-2.5 rounded-[15px] hover:bg-blue-900 transition flex items-center justify-center gap-2">
                            Lihat Program Studi
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="/akreditasi" class="bg-white/30 text-white text-sm md:text-base px-6 py-2.5 rounded-[15px] hover:bg-white/40 transition flex items-center justify-center gap-2 backdrop-blur-sm border border-white/20">
                            Informasi Akreditasi
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full h-full flex-shrink-0 relative" style="background-image: url('{{ asset('img/tamanjtk.png') }}'); background-size: cover; background-position: right center;">
                <div class="absolute inset-0 bg-gradient-to-r from-[#00008B] from-[15%] to-transparent"></div>
                <div class="relative h-full max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16 w-full flex flex-col md:flex-row justify-between items-end pb-8 pt-8">
                    <div class="flex-1 pr-4 mb-6 md:mb-2">
                        <h1 class="text-3xl md:text-5xl font-bold text-white mb-3 leading-tight">Jurusan Teknik Komputer dan Informatika</h1>
                        <p class="text-sm md:text-base text-gray-200 max-w-2xl mb-4"><span class="font-semibold">Politeknik Negeri Bandung</span><br>Mencetak talenta digital vokasi yang kompeten, inovatif, dan siap memberikan solusi teknologi nyata.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto justify-end mb-2">
                        <a href="/program-studi" class="bg-[#00008B] text-white text-sm md:text-base px-6 py-2.5 rounded-[15px] hover:bg-blue-900 transition flex items-center justify-center gap-2">
                            Lihat Program Studi
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="/akreditasi" class="bg-white/30 text-white text-sm md:text-base px-6 py-2.5 rounded-[15px] hover:bg-white/40 transition flex items-center justify-center gap-2 backdrop-blur-sm border border-white/20">
                            Informasi Akreditasi
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full h-full flex-shrink-0 relative" style="background-image: url('{{ asset('img/papanjtk.png') }}'); background-size: cover; background-position: right center;">
                <div class="absolute inset-0 bg-gradient-to-r from-[#00008B] from-[15%] to-transparent"></div>
                <div class="relative h-full max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16 w-full flex flex-col md:flex-row justify-between items-end pb-8 pt-8">
                    <div class="flex-1 pr-4 mb-6 md:mb-2">
                        <h1 class="text-3xl md:text-5xl font-bold text-white mb-3 leading-tight">Jurusan Teknik Komputer dan Informatika</h1>
                        <p class="text-sm md:text-base text-gray-200 max-w-2xl mb-4"><span class="font-semibold">Politeknik Negeri Bandung</span><br>Wujudkan karier profesional di bidang rekayasa perangkat lunak dan infrastruktur IT melalui ekosistem pembelajaran yang kolaboratif.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto justify-end mb-2">
                        <a href="/program-studi" class="bg-[#00008B] text-white text-sm md:text-base px-6 py-2.5 rounded-[15px] hover:bg-blue-900 transition flex items-center justify-center gap-2">
                            Lihat Program Studi
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="/akreditasi" class="bg-white/30 text-white text-sm md:text-base px-6 py-2.5 rounded-[15px] hover:bg-white/40 transition flex items-center justify-center gap-2 backdrop-blur-sm border border-white/20">
                            Informasi Akreditasi
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="absolute bottom-6 left-0 right-0 flex justify-center items-center space-x-3">
            <button class="slider-dot w-3 h-3 rounded-full bg-white transition-all duration-300" data-index="0"></button>
            <button class="slider-dot w-2 h-2 rounded-full bg-white/50 hover:bg-white/80 transition-all duration-300" data-index="1"></button>
            <button class="slider-dot w-2 h-2 rounded-full bg-white/50 hover:bg-white/80 transition-all duration-300" data-index="2"></button>
        </div>
    </div>

    <!-- Quick Access Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="AKSES CEPAT"
                subtitle="Akses informasi penting JTK POLBAN"
            />
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <x-icon-card 
                    icon="🎓"
                    title="Calon Mahasiswa"
                    href="#">
                    Informasi untuk calon mahasiswa baru
                </x-icon-card>

                <x-icon-card 
                    icon="👤"
                    title="Mahasiswa Aktif"
                    href="#">
                    Informasi dan layanan untuk mahasiswa
                </x-icon-card>

                <x-icon-card 
                    icon="👨‍🏫"
                    title="Dosen & Tendik"
                    href="/profil-dosen">
                    Informasi dosen dan tenaga kependidikan
                </x-icon-card>

                <x-icon-card 
                    icon="🤝"
                    title="Alumni"
                    href="#">
                    Informasi jaringan alumni JTK POLBAN
                </x-icon-card>

                <x-icon-card 
                    icon="🏭"
                    title="Mitra Industri"
                    href="#">
                    Kerja sama dan informasi untuk mitra industri
                </x-icon-card>
            </div>
        </div>
    </section>

    <!-- Program Studi Section -->
    <section class="py-16" id="programs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="PROGRAM STUDI"
                subtitle="Dua program studi unggul dengan akreditasi internasional"
            />
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <x-card 
                    title="D3 Teknik Informatika"
                    image="https://via.placeholder.com/500x300?text=D3+Teknik+Informatika"
                    href="/program-studi/d3">
                    <div class="bg-blue-100 text-blue-900 px-3 py-1 rounded-full text-sm font-semibold mb-3 inline-block">
                        Akreditasi: UNGGUL
                    </div>
                    <p>Pendidikan selama 3 tahun yang menghasilkan mahasiswa dengan keterampatan di bidang teknik informatika dan pengembangan perangkat lunak.</p>
                </x-card>

                <x-card 
                    title="D4 Teknik Informatika"
                    image="https://via.placeholder.com/500x300?text=D4+Teknik+Informatika"
                    href="/program-studi/sarjana">
                    <div class="bg-blue-100 text-blue-900 px-3 py-1 rounded-full text-sm font-semibold mb-3 inline-block">
                        Akreditasi: UNGGUL
                    </div>
                    <p>Pendidikan selama 3 tahun yang membekali mahasiswa dengan keterampatan di bidang perangcangan dan implementasi sistem informatika.</p>
                </x-card>
            </div>

            <div class="text-center mt-8">
                <x-button href="/program-studi" type="primary">Lihat Semua Program →</x-button>
            </div>
        </div>
    </section>

    <!-- Accreditation Section -->
    <section class="bg-gradient-to-r from-navy-900 to-navy-800 py-16 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="AKREDITASI PROGRAM STUDI"
                subtitle="Program Studi Terakreditasi UNGGUL"
                centered="true"
                class="text-white">
            </x-section-title>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white/10 backdrop-blur rounded-lg p-8 border border-white/20">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl">🏆</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">D3 Teknik Informatika</h3>
                    <p class="text-gray-200 mb-4">Akreditasi: UNGGUL</p>
                    <p class="text-sm text-gray-300 mb-6">Berlaku sampai 31 Desember 2028</p>
                    <x-button href="/akreditasi" type="secondary" class="border-white text-white hover:bg-white/10">
                        Lihat Sertifikat →
                    </x-button>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-lg p-8 border border-white/20">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl">🏆</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">D4 Teknik Informatika</h3>
                    <p class="text-gray-200 mb-4">Akreditasi: UNGGUL</p>
                    <p class="text-sm text-gray-300 mb-6">Berlaku sampai 31 Desember 2030</p>
                    <x-button href="/akreditasi" type="secondary" class="border-white text-white hover:bg-white/10">
                        Lihat Sertifikat →
                    </x-button>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <x-section-title 
                    title="BERITA TERBARU"
                    centered="false"
                />
                <x-button href="/berita" type="ghost">Lihat Semua →</x-button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($latestNews as $news)
                    <x-card 
                        title="{{ $news['title'] }}"
                        image="{{ $news['image'] }}"
                        href="/berita/{{ $news['id'] }}">
                        <div class="flex items-center space-x-4 text-xs text-gray-500 mb-3">
                            <span>📅 {{ $news['date'] }}</span>
                            <span>👁️ {{ $news['views'] }} views</span>
                        </div>
                        <p>{{ $news['excerpt'] }}</p>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Student Achievements Section -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title 
                title="PRESTASI MAHASISWA"
                subtitle="Pencapaian mahasiswa JTK di berbagai kompetisi"
            />
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-card>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-3xl">🥇</span>
                        <div>
                            <div class="font-bold text-navy-900">Juara Nasional KMIPN 2025</div>
                            <div class="text-xs text-gray-500">Kategori Game Development</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Mahasiswa JTK POLBAN meraih prestasi luar biasa di KMIPN 2025 di Padang.</p>
                </x-card>

                <x-card>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-3xl">🥈</span>
                        <div>
                            <div class="font-bold text-navy-900">Juara II Hackathon BuildOn</div>
                            <div class="text-xs text-gray-500">Build Indonesia 2020</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Obstetrik dari JTK sabet juara I Hackathon BuildOn Indonesia 2020.</p>
                </x-card>

                <x-card>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-3xl">🏅</span>
                        <div>
                            <div class="font-bold text-navy-900">Program Nyatakan.id</div>
                            <div class="text-xs text-gray-500">Kemenprakraf 2020</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Mahasiswa JTK raih prestasi dalam program Nyatakan.id Kemenprakraf.</p>
                </x-card>
            </div>

            <div class="text-center mt-8">
                <x-button href="/prestasi" type="primary">Lihat Semua Prestasi →</x-button>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-gradient-to-r from-sky-light to-sky-bright py-16 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Tertarik Bergabung dengan JTK POLBAN?</h2>
            <p class="text-lg mb-8 opacity-95">
                Raih kesempatan emas untuk belajar dan mengembangkan kompetensi di bidang teknik komputer dan informatika.
            </p>
            <x-button href="#" type="primary" class="bg-navy-900 text-white hover:bg-navy-800">
                Daftar Sekarang →
            </x-button>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('hero-slider');
            const dots = document.querySelectorAll('.slider-dot');
            let currentSlide = 0;
            const totalSlides = 3;

            // 1. Fungsi Utama untuk Berpindah Slide
            function goToSlide(index) {
                // Cegah index keluar dari batas (kurang dari 0 atau lebih dari total)
                if (index < 0) index = 0;
                if (index >= totalSlides) index = totalSlides - 1;
                
                currentSlide = parseInt(index);
                
                // Geser elemen
                slider.style.transform = `translateX(-${currentSlide * 100}%)`;
                
                // Update ukuran indikator dots
                dots.forEach((dot, i) => {
                    if (i === currentSlide) {
                        dot.classList.remove('w-2', 'h-2', 'bg-white/50');
                        dot.classList.add('w-3', 'h-3', 'bg-white');
                    } else {
                        dot.classList.remove('w-3', 'h-3', 'bg-white');
                        dot.classList.add('w-2', 'h-2', 'bg-white/50');
                    }
                });
            }

            // 2. Event Listener: Klik pada Indikator Dot
            dots.forEach((dot) => {
                dot.addEventListener('click', function() {
                    const index = this.getAttribute('data-index');
                    goToSlide(index);
                });
            });

            // 3. Logika Geser (Swipe) untuk Touchscreen (HP/Tablet)
            let startX = 0;
            let endX = 0;
            const threshold = 50; // Jarak minimal tarikan (pixel) agar slide pindah

            slider.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
            }, { passive: true });

            slider.addEventListener('touchend', function(e) {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            }, { passive: true });

            // 4. Logika Geser (Drag) untuk Mouse (Laptop/PC)
            let isDragging = false;
            
            slider.addEventListener('mousedown', function(e) {
                isDragging = true;
                startX = e.clientX;
                slider.style.cursor = 'grabbing';
            });

            slider.addEventListener('mouseup', function(e) {
                if (!isDragging) return;
                isDragging = false;
                endX = e.clientX;
                slider.style.cursor = 'default';
                handleSwipe();
            });

            slider.addEventListener('mouseleave', function() {
                if (isDragging) {
                    isDragging = false;
                    slider.style.cursor = 'default';
                }
            });

            // 5. Fungsi Kalkulasi Tarikan
            function handleSwipe() {
                if (startX - endX > threshold) {
                    // Tarik ke Kiri -> Slide Selanjutnya
                    goToSlide(currentSlide + 1);
                } else if (endX - startX > threshold) {
                    // Tarik ke Kanan -> Slide Sebelumnya
                    goToSlide(currentSlide - 1);
                }
            }

            // Inisialisasi awal agar dot pertama langsung membesar
            goToSlide(0);
        });
    </script>
@endsection
