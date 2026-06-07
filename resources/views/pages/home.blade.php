@extends('layouts.app')

@section('title', 'Beranda - JTK POLBAN')

@section('content')
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

    <section class="bg-gray-50 py-12 font-['Poppins']">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16">
            <h2 class="text-2xl font-bold text-[#01018B] text-center mb-8 tracking-wide uppercase">Akses Cepat</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <a href="/tentang-jtk" class="block bg-white rounded-[12px] p-6 text-center shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 mx-auto bg-blue-50 text-[#01018B] rounded-full flex items-center justify-center mb-4 text-2xl">🎓</div>
                    <h3 class="text-[#01018B] font-semibold text-[15px] mb-2">Calon Mahasiswa</h3>
                    <p class="text-gray-500 text-[12px] leading-relaxed">Informasi untuk calon mahasiswa baru</p>
                </a>

                <a href="/akademik" class="block bg-white rounded-[12px] p-6 text-center shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 mx-auto bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-4 text-2xl">👤</div>
                    <h3 class="text-[#01018B] font-semibold text-[15px] mb-2">Mahasiswa Aktif</h3>
                    <p class="text-gray-500 text-[12px] leading-relaxed">Informasi dan layanan untuk mahasiswa</p>
                </a>

                <a href="/profil-dosen" class="block bg-white rounded-[12px] p-6 text-center shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 mx-auto bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-4 text-2xl">👨‍🏫</div>
                    <h3 class="text-[#01018B] font-semibold text-[15px] mb-2">Dosen & Tendik</h3>
                    <p class="text-gray-500 text-[12px] leading-relaxed">Informasi dosen dan tenaga kependidikan</p>
                </a>

                <a href="/berita" class="block bg-white rounded-[12px] p-6 text-center shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 mx-auto bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mb-4 text-2xl">🤝</div>
                    <h3 class="text-[#01018B] font-semibold text-[15px] mb-2">Alumni</h3>
                    <p class="text-gray-500 text-[12px] leading-relaxed">Informasi jaringan alumni JTK POLBAN</p>
                </a>

                <a href="/kompetensi-lulusan" class="block bg-white rounded-[12px] p-6 text-center shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 mx-auto bg-teal-50 text-teal-600 rounded-full flex items-center justify-center mb-4 text-2xl">🏭</div>
                    <h3 class="text-[#01018B] font-semibold text-[15px] mb-2">Mitra Industri</h3>
                    <p class="text-gray-500 text-[12px] leading-relaxed">Kerja sama dan informasi untuk mitra industri</p>
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 font-['Poppins'] bg-white" id="programs">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <div>
                    <h2 class="text-xl font-bold text-[#01018B] mb-8 uppercase tracking-wide">PROGRAM STUDI</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-[16px] shadow-[0_2px_15px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden flex flex-col hover:shadow-lg transition-shadow">
                            <div class="bg-[#01018B]/10 flex justify-center py-8">
                                <div class="w-[72px] h-[72px] bg-[#01018B] rounded-full flex items-center justify-center text-white shadow-md">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 8l-2 2 2 2m4-4l2 2-2 2"></path></svg>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="text-[17px] font-bold text-[#01018B] mb-2 leading-snug">D3 Teknik Informatika</h3>
                                <p class="text-[13px] text-[#01018B] font-medium mb-3">Akreditasi: <span class="font-bold">UNGGUL</span></p>
                                <p class="text-gray-600 text-[12px] leading-relaxed mb-6 flex-1">
                                    Pendidikan vokasi selama 3 tahun yang membekali mahasiswa dengan keterampilan di bidang pengembangan perangkat lunak, jaringan, dan sistem informasi.
                                </p>
                                <a href="/program-studi/d3" class="inline-flex w-fit items-center gap-2 bg-[#01018B] text-white text-[13px] font-semibold px-5 py-2.5 rounded-full hover:bg-blue-900 transition">
                                    Lihat Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>

                        <div class="bg-white rounded-[16px] shadow-[0_2px_15px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden flex flex-col hover:shadow-lg transition-shadow">
                            <div class="bg-[#F2994A]/10 flex justify-center py-8">
                                <div class="w-[72px] h-[72px] bg-[#F2994A] rounded-full flex items-center justify-center text-white shadow-md">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="text-[17px] font-bold text-[#01018B] mb-2 leading-snug">D4 Teknik Informatika</h3>
                                <p class="text-[13px] text-[#01018B] font-medium mb-3">Akreditasi: <span class="font-bold">UNGGUL</span></p>
                                <p class="text-gray-600 text-[12px] leading-relaxed mb-6 flex-1">
                                    Pendidikan vokasi selama 4 tahun yang membekali mahasiswa dengan kompetensi aplikatif di bidang solusi teknologi informasi berbasis kebutuhan industri.
                                </p>
                                <a href="/program-studi/sarjana" class="inline-flex w-fit items-center gap-2 bg-[#01018B] text-white text-[13px] font-semibold px-5 py-2.5 rounded-full hover:bg-blue-900 transition">
                                    Lihat Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-[#01018B] mb-8 uppercase tracking-wide">AKREDITASI PROGRAM STUDI</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-[16px] shadow-[0_2px_15px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden flex flex-col hover:shadow-lg transition-shadow">
                            <div class="flex justify-center pt-10 pb-4">
                                <div class="w-20 h-20 bg-[#01018B]/10 rounded-full flex items-center justify-center text-[#01018B]">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col text-center">
                                <h3 class="text-[17px] font-bold text-[#01018B] mb-4">D3 Teknik Informatika</h3>
                                <p class="text-[13px] text-[#01018B] font-medium mb-3">Akreditasi: <span class="font-bold">UNGGUL</span></p>
                                <p class="text-gray-500 text-[12px]">Berlaku sampai: 07 Agustus 2028</p>
                                <p class="text-gray-500 text-[12px] mb-8 flex-1">No. SK: 073/SK/LAM-INFOKOM/Ak/D3/VIII/2023.</p>
                                
                                <div class="border-t border-gray-100 pt-6">
                                    <a href="https://www.polban.ac.id/wp-content/uploads/2024/01/24.-Sertifikat-Akreditasi-D3-Teknik-Informatika_073-2023-2028.pdf" target="_blank" class="inline-flex items-center gap-2 border-[1.5px] border-[#01018B] text-[#01018B] text-[13px] font-semibold px-6 py-2.5 rounded-full hover:bg-blue-50 transition">
                                        Lihat Sertifikat
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-[16px] shadow-[0_2px_15px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden flex flex-col hover:shadow-lg transition-shadow">
                            <div class="flex justify-center pt-10 pb-4">
                                <div class="w-20 h-20 bg-[#F2994A]/10 rounded-full flex items-center justify-center text-[#01018B]">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col text-center">
                                <h3 class="text-[17px] font-bold text-[#01018B] mb-4">D4 Teknik Informatika</h3>
                                <p class="text-[13px] text-[#01018B] font-medium mb-3">Akreditasi: <span class="font-bold">UNGGUL</span></p>
                                <p class="text-gray-500 text-[12px]">Berlaku sampai: 15 Agustus 2030</p>
                                <p class="text-gray-500 text-[12px] mb-8 flex-1">No. SK: 146/SK/LAM-INFOKOM/Ak/STr/VIII/2025.</p>
                                
                                <div class="border-t border-gray-100 pt-6">
                                    <a href="https://www.polban.ac.id/wp-content/uploads/2025/08/file_sertifikat_25051520395200500455301_1755423415.pdf" target="_blank" class="inline-flex items-center gap-2 border-[1.5px] border-[#01018B] text-[#01018B] text-[13px] font-semibold px-6 py-2.5 rounded-full hover:bg-blue-50 transition">
                                        Lihat Sertifikat
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section class="py-12 font-['Poppins'] bg-gray-50">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16">
            
            <div class="bg-white rounded-[20px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:divide-x divide-gray-100">
                    
                    <div class="lg:pr-6 flex flex-col">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-[17px] font-bold text-[#01018B] uppercase tracking-wide">Prestasi Mahasiswa</h2>
                            <a href="/prestasi" class="text-[#01018B] font-medium text-[13px] hover:text-blue-700 transition flex items-center gap-1">
                                Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                        
                        <div id="home-prestasi-list" class="flex flex-col gap-5">
                            <div class="animate-pulse flex items-center gap-4">
                                <div class="w-12 h-12 rounded-[12px] bg-gray-200"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:px-6 flex flex-col">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-[17px] font-bold text-[#01018B] uppercase tracking-wide">Berita Terbaru</h2>
                            <a href="/berita" class="text-[#01018B] font-medium text-[13px] hover:text-blue-700 transition flex items-center gap-1">
                                Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                        
                        <div id="home-berita-list" class="flex flex-col gap-5">
                            <div class="animate-pulse flex items-start gap-4">
                                <div class="w-[100px] h-[64px] rounded-[8px] bg-gray-200"></div>
                                <div class="flex-1 space-y-2 py-1">
                                    <div class="h-4 bg-gray-200 rounded w-full"></div>
                                    <div class="h-3 bg-gray-200 rounded w-1/3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:pl-6 flex flex-col">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-[17px] font-bold text-[#01018B] uppercase tracking-wide">Fasilitas Kami</h2>
                            <a href="/fasilitas" class="text-[#01018B] font-medium text-[13px] hover:text-blue-700 transition flex items-center gap-1">
                                Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <a href="/fasilitas" class="bg-[#EEF1F9] rounded-[12px] p-4 flex items-center gap-3 hover:bg-[#E2E8F4] transition group">
                                <div class="text-[#01018B] flex-shrink-0">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-[#01018B] font-bold text-[12px]">Laboratorium</h4>
                                    <p class="text-[#01018B]/70 text-[10px]">Komputer</p>
                                </div>
                            </a>

                            <a href="/fasilitas" class="bg-[#EEF1F9] rounded-[12px] p-4 flex items-center gap-3 hover:bg-[#E2E8F4] transition group">
                                <div class="text-[#01018B] flex-shrink-0">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zm10 0a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-[#01018B] font-bold text-[12px]">Ruang Serba</h4>
                                    <p class="text-[#01018B]/70 text-[10px]">Guna</p>
                                </div>
                            </a>

                            <a href="/fasilitas" class="bg-[#EEF1F9] rounded-[12px] p-4 flex items-center gap-3 hover:bg-[#E2E8F4] transition group">
                                <div class="text-[#01018B] flex-shrink-0">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-[#01018B] font-bold text-[12px]">Laboratorium</h4>
                                    <p class="text-[#01018B]/70 text-[10px]">Multimedia</p>
                                </div>
                            </a>

                            <a href="/fasilitas" class="bg-[#EEF1F9] rounded-[12px] p-4 flex items-center gap-3 hover:bg-[#E2E8F4] transition group">
                                <div class="text-[#01018B] flex-shrink-0">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-[#01018B] font-bold text-[12px]">Ruang Kelas</h4>
                                    <p class="text-[#01018B]/70 text-[10px]">Nyaman</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const prestasiContainer = document.getElementById('home-prestasi-list');
            const beritaContainer = document.getElementById('home-berita-list');
            const fallbackImage = 'https://placehold.co/120x80?text=JTK+POLBAN';

            // Keamanan teks
            const escapeHtml = (value) => String(value ?? '')
                .replaceAll('&', '&amp;').replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;').replaceAll('"', '&quot;').replaceAll("'", '&#039;');

            // 1. Fetch Data Prestasi (Hanya ambil 3 data terbaru)
            try {
                const resPrestasi = await fetch('/api/posts?type=prestasi&per_page=3');
                if (resPrestasi.ok) {
                    const json = await resPrestasi.json();
                    const posts = json.data || [];
                    
                    if (posts.length > 0) {
                        prestasiContainer.innerHTML = posts.map(post => `
                            <a href="/berita/${encodeURIComponent(post.slug || post.id)}" class="flex items-center gap-4 group cursor-pointer">
                                <div class="w-12 h-12 rounded-[12px] bg-orange-50 flex items-center justify-center flex-shrink-0 text-[#F2994A] group-hover:bg-orange-100 transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-[#01018B] font-bold text-[14px] leading-tight mb-1 group-hover:text-blue-600 transition line-clamp-1">${escapeHtml(post.title)}</h4>
                                    <p class="text-[#01018B]/70 text-[12px]">${escapeHtml(post.category || 'Prestasi Mahasiswa')}</p>
                                </div>
                            </a>
                        `).join('');
                    } else {
                        prestasiContainer.innerHTML = '<p class="text-sm text-gray-500 italic">Belum ada data prestasi terbaru.</p>';
                    }
                }
            } catch (e) {
                prestasiContainer.innerHTML = '<p class="text-sm text-red-500">Gagal memuat data prestasi.</p>';
            }

            // 2. Fetch Data Berita (Hanya ambil 3 data terbaru)
            try {
                const resBerita = await fetch('/api/posts?per_page=3');
                if (resBerita.ok) {
                    const json = await resBerita.json();
                    const posts = json.data || [];
                    
                    if (posts.length > 0) {
                        beritaContainer.innerHTML = posts.map(post => {
                            const image = post.image_url || post.featured_media?.url || fallbackImage;
                            return `
                                <a href="/berita/${encodeURIComponent(post.slug || post.id)}" class="flex items-start gap-4 group">
                                    <img src="${escapeHtml(image)}" alt="${escapeHtml(post.title)}" class="w-[100px] h-[64px] rounded-[8px] object-cover flex-shrink-0 bg-gray-200" onerror="this.onerror=null;this.src='${fallbackImage}';">
                                    <div class="flex flex-col justify-center min-h-[64px]">
                                        <h4 class="text-[#01018B] font-bold text-[13px] leading-snug group-hover:text-blue-600 transition line-clamp-2 mb-1">${escapeHtml(post.title)}</h4>
                                        <p class="text-gray-400 text-[11px] font-medium">${escapeHtml(post.date_label || '')}</p>
                                    </div>
                                </a>
                            `;
                        }).join('');
                    } else {
                        beritaContainer.innerHTML = '<p class="text-sm text-gray-500 italic">Belum ada berita terbaru.</p>';
                    }
                }
            } catch (e) {
                beritaContainer.innerHTML = '<p class="text-sm text-red-500">Gagal memuat data berita.</p>';
            }
        });
    </script>

    <section class="py-12 font-['Poppins'] bg-white">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16">
            
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-[#01018B] uppercase tracking-wide">Dosen & Tenaga Pengajar</h2>
                <a href="/profil-dosen" class="text-[#01018B] font-medium text-[13px] hover:text-blue-700 transition flex items-center gap-1">
                    Lihat Semua Dosen 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="relative">
                <style>
                    .hide-scroll::-webkit-scrollbar { display: none; }
                    .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
                </style>

                <div id="dosen-slider-container" class="flex gap-6 overflow-x-auto pb-6 snap-x snap-mandatory hide-scroll scroll-smooth">
                    <div class="min-w-[300px] flex-shrink-0 bg-white rounded-[16px] border border-gray-100 p-6 flex items-start gap-4 animate-pulse">
                        <div class="w-14 h-14 rounded-full bg-gray-200 flex-shrink-0"></div>
                        <div class="flex-1 space-y-3">
                            <div class="h-4 bg-gray-200 rounded w-full"></div>
                            <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                            <div class="h-3 bg-gray-200 rounded w-3/4 mt-4"></div>
                        </div>
                    </div>
                </div>

                <button onclick="document.getElementById('dosen-slider-container').scrollBy({left: 320, behavior: 'smooth'})" class="absolute -right-5 top-1/2 -translate-y-1/2 hidden md:flex items-center justify-center w-12 h-12 bg-white rounded-full shadow-[0_4px_15px_rgba(0,0,0,0.1)] border border-gray-100 text-[#01018B] hover:bg-gray-50 transition-colors z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </button>
                <button onclick="document.getElementById('dosen-slider-container').scrollBy({left: -320, behavior: 'smooth'})" class="absolute -left-5 top-1/2 -translate-y-1/2 hidden md:flex items-center justify-center w-12 h-12 bg-white rounded-full shadow-[0_4px_15px_rgba(0,0,0,0.1)] border border-gray-100 text-[#01018B] hover:bg-gray-50 transition-colors z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>
            </div>
            
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

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const dosenContainer = document.getElementById('dosen-slider-container');
            
            // Keamanan teks (untuk menghindari XSS)
            const escapeHtml = (value) => String(value ?? '')
                .replaceAll('&', '&amp;').replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;').replaceAll('"', '&quot;').replaceAll("'", '&#039;');

            // Fetch Data Dosen
            try {
                const resDosen = await fetch('/api/lecturers?per_page=6'); 
                if (resDosen.ok) {
                    const json = await resDosen.json();
                    const lecturers = json.data || json || []; 
                    
                    if (lecturers.length > 0) {
                        dosenContainer.innerHTML = lecturers.map(lecturer => {
                            // Ambil inisial dari nama
                            const initials = lecturer.name ? lecturer.name.substring(0, 1).toUpperCase() : 'D';
                            
                            return `
                                <a href="/profil-dosen/${encodeURIComponent(lecturer.id || '')}" class="min-w-[300px] block flex-shrink-0 bg-white rounded-[16px] shadow-[0_2px_15px_rgba(0,0,0,0.04)] border border-gray-100 p-6 snap-start hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex items-start gap-4">
                                        <div class="w-14 h-14 rounded-full bg-[#01018B]/10 flex items-center justify-center flex-shrink-0 text-[#01018B] font-bold text-xl">
                                            ${initials}
                                        </div>
                                        <div class="flex flex-col">
                                            <h4 class="text-[#01018B] font-bold text-[14px] leading-snug mb-1">${escapeHtml(lecturer.name)}</h4>
                                            
                                            <p class="text-[#01018B]/60 text-[12px] mb-3">${escapeHtml(lecturer.functional || 'Dosen Tetap')}</p>
                                            
                                            <p class="text-[#01018B] text-[12px] font-semibold leading-snug">Bidang: ${escapeHtml(lecturer.expertise || lecturer.bidang || '-')}</p>
                                        </div>
                                    </div>
                                </a>
                            `;
                        }).join('');
                    } else {
                        dosenContainer.innerHTML = '<p class="text-sm text-gray-500 italic p-6">Belum ada data dosen.</p>';
                    }
                }
            } catch (e) {
                dosenContainer.innerHTML = '<p class="text-sm text-red-500 p-6">Gagal memuat data dosen.</p>';
            }
        });
    </script>
@endsection