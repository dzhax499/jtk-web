@extends('layouts.app')

@section('title', 'Kompetensi Lulusan - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Kompetensi Lulusan"
        subtitle="Informasi terbaru seputar Kompetensi Lulusan"
        bgImage="https://via.placeholder.com/1920x400?text=Kompetensi+Lulusan">
        <span>Beranda</span> > <span>Kompetensi Lulusan</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-navy-900 mb-8 text-center">Kompetensi Lulusan</h2>

            <!-- Competency Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                @foreach([
                    ['icon' => '🔧', 'text' => 'Melakukan kustomisasi perangkat lunak'],
                    ['icon' => '📋', 'text' => 'Mendokumentasikan perangkat lunak'],
                    ['icon' => '🔍', 'text' => 'Menganalisa perangkat lunak'],
                    ['icon' => '🔄', 'text' => 'Merancang perangkat lunak'],
                    ['icon' => '💻', 'text' => 'Mengimplementasikan perangkat lunak'],
                    ['icon' => '🔌', 'text' => 'Menyediakan dukungan pemeliharaan sistem'],
                    ['icon' => '🔐', 'text' => 'Melakukan pengujian perangkat lunak'],
                    ['icon' => '👥', 'text' => 'Menjalankan manajemen proyek perangkat lunak'],
                ] as $competency)
                    <div class="border-2 border-navy-900 rounded-lg p-4 text-center hover:shadow-lg transition">
                        <div class="text-3xl mb-2">{{ $competency['icon'] }}</div>
                        <p class="text-sm font-semibold text-navy-900">{{ $competency['text'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Peran Lulusan -->
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div class="bg-blue-50 border-2 border-navy-900 rounded-lg p-8">
                    <h3 class="text-xl font-bold text-navy-900 mb-4">Peran Lulusan</h3>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex gap-2">
                            <span class="text-navy-900">✓</span>
                            <span>Database Administrator</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-900">✓</span>
                            <span>Software/System Engineer</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-900">✓</span>
                            <span>Computer Operator/Instruction Support</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-900">✓</span>
                            <span>Web Designer</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-blue-50 border-2 border-navy-900 rounded-lg p-8">
                    <h3 class="text-xl font-bold text-navy-900 mb-4">Jenjang Karir Lanjutan</h3>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex gap-2">
                            <span class="text-navy-900">→</span>
                            <span>Analyst Programmer</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-900">→</span>
                            <span>System/Database Programmer</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-900">→</span>
                            <span>IT Executive</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-900">→</span>
                            <span>Network Support Engineer</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-900">→</span>
                            <span>Account Manager</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-900">→</span>
                            <span>IT Manager</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-900">→</span>
                            <span>Project Manager</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
