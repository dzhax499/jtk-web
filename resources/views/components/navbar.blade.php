<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-lg">J</span>
                </div>
                <div class="hidden sm:block">
                    <div class="text-navy-900 font-bold text-sm">JTK POLBAN</div>
                    <div class="text-navy-700 text-xs leading-tight">Jurusan Teknik Komputer<br>dan Informatika</div>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="/" class="text-navy-900 font-medium hover:text-navy-600 transition">Beranda</a>
                
                <!-- Tentang JTK Dropdown -->
                <div class="relative group">
                    <button class="text-navy-900 font-medium hover:text-navy-600 transition flex items-center space-x-1" data-dropdown-toggle="tentang-dropdown">
                        <span>Tentang JTK</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </button>
                    <div id="tentang-dropdown" class="hidden absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-3 z-50" role="menu">
                        <a href="/visi-misi" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Visi dan Misi</span>
                        </a>
                        <a href="/riwayat-singkat" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Riwayat Singkat</span>
                        </a>
                        <a href="/struktur-organisasi" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Struktur Organisasi</span>
                        </a>
                        <a href="/fasilitas" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Fasilitas</span>
                        </a>
                        <a href="/reputasi" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Reputasi</span>
                        </a>
                        <a href="/kompetensi-lulusan" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Kompetensi Lulusan</span>
                        </a>
                        <a href="/produk" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Produk</span>
                        </a>
                        <a href="/hasil-penelitian" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Hasil Penelitian</span>
                        </a>
                        <a href="/tenaga-kependidikan" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Tenaga Kependidikan</span>
                        </a>
                    </div>
                </div>

                <!-- Program Studi Dropdown -->
                <div class="relative group">
                    <button class="text-navy-900 font-medium hover:text-navy-600 transition flex items-center space-x-1" data-dropdown-toggle="program-dropdown">
                        <span>Program Studi</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </button>
                    <div id="program-dropdown" class="hidden absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-3 z-50" role="menu">
                        <a href="/program-studi/d3" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>D3 Teknik Informatika</span>
                        </a>
                        <a href="/program-studi/sarjana" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Sarjana Terapan Teknik Informatika</span>
                        </a>
                    </div>
                </div>

                <!-- Berita Dropdown -->
                <div class="relative group">
                    <button class="text-navy-900 font-medium hover:text-navy-600 transition flex items-center space-x-1" data-dropdown-toggle="berita-dropdown">
                        <span>Berita</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </button>
                    <div id="berita-dropdown" class="hidden absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-3 z-50" role="menu">
                        <a href="/berita" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Berita</span>
                        </a>
                        <a href="/prestasi" class="block px-4 py-2 text-navy-900 hover:bg-gray-50 transition flex items-center space-x-2">
                            <span class="text-sky-light">✦</span>
                            <span>Prestasi Mahasiswa</span>
                        </a>
                    </div>
                </div>
                <a href="/profil-dosen" class="text-navy-900 font-medium hover:text-navy-600 transition">Profil Dosen</a>
                <a href="/akademik" class="text-navy-900 font-medium hover:text-navy-600 transition">Akademik</a>
                <a href="/akreditasi" class="text-navy-900 font-medium hover:text-navy-600 transition">Akreditasi</a>
                <a href="/arsip/berita" class="text-navy-900 font-medium hover:text-navy-600 transition">Arsip</a>
            </div>

            <!-- Mobile menu button -->
            <button id="mobile-menu-btn" class="lg:hidden text-navy-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="/" class="block px-3 py-2 rounded-md text-navy-900 font-medium">Beranda</a>
            <a href="/tentang-jtk" class="block px-3 py-2 rounded-md text-navy-900 font-medium">Tentang JTK</a>
            <a href="/program-studi" class="block px-3 py-2 rounded-md text-navy-900 font-medium">Program Studi</a>
            <a href="/berita" class="block px-3 py-2 rounded-md text-navy-900 font-medium">Berita</a>
            <a href="/profil-dosen" class="block px-3 py-2 rounded-md text-navy-900 font-medium">Profil Dosen</a>
            <a href="/akreditasi" class="block px-3 py-2 rounded-md text-navy-900 font-medium">Akreditasi</a>
            <a href="/arsip/berita" class="block px-3 py-2 rounded-md text-navy-900 font-medium">Arsip</a>
        </div>
    </div>
</nav>
