@extends('layouts.app')

@section('title', 'Tenaga Kependidikan - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Tenaga Kependidikan"
        subtitle="Informasi terbaru seputar Tenaga Kependidikan"
        bgImage="https://via.placeholder.com/1920x400?text=Tenaga+Kependidikan">
        <span>Beranda</span> > <span>Tenaga Kependidikan</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Accordion -->
            <div class="space-y-4">
                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>A. Tenaga Administrasi</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-6 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center p-4 border border-gray-200 rounded-lg">
                                <div class="text-3xl mb-3">👤</div>
                                <h3 class="font-bold text-navy-900 text-sm">Lia Rahmawati</h3>
                            </div>
                            <div class="text-center p-4 border border-gray-200 rounded-lg">
                                <div class="text-3xl mb-3">👤</div>
                                <h3 class="font-bold text-navy-900 text-sm">Pulut Priyanto</h3>
                            </div>
                        </div>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>B. Teknisi</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700 text-sm">Daftar tenaga teknisi pendukung</p>
                    </div>
                </details>

                <details class="bg-white border border-gray-300 rounded-lg group">
                    <summary class="flex cursor-pointer items-center justify-between bg-gray-50 px-6 py-4 text-navy-900 font-bold group-open:bg-navy-900 group-open:text-white transition">
                        <span>C. Pramukantor</span>
                        <span class="text-2xl group-open:rotate-180 transition">+</span>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <p class="text-gray-700 text-sm">Daftar pramukantor dan staff pendukung</p>
                    </div>
                </details>
            </div>
        </div>
    </section>
@endsection
