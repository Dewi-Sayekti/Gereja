@extends('layouts.landing')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tim Pelayanan Kami</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Pastor 1 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-48 bg-gray-300 flex items-center justify-center">
                <span class="text-gray-500">Foto Pastor 1</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Pendeta Utama</h3>
                <p class="text-indigo-600 mb-3">Pemimpin Rohani Gereja</p>
                <p class="text-gray-600 text-sm">
                    Dedikasi penuh dalam memberikan bimbingan rohani dan kepemimpinan yang kuat bagi jemaat.
                </p>
            </div>
        </div>

        <!-- Pastor 2 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-48 bg-gray-300 flex items-center justify-center">
                <span class="text-gray-500">Foto Pastor 2</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Pendeta Pemuda</h3>
                <p class="text-blue-600 mb-3">Pelayanan Generasi Muda</p>
                <p class="text-gray-600 text-sm">
                    Fokus pada pengembangan dan pembimbingan generasi muda dalam iman Kristus.
                </p>
            </div>
        </div>

        <!-- Pastor 3 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-48 bg-gray-300 flex items-center justify-center">
                <span class="text-gray-500">Foto Pastor 3</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Pendeta Pastoral</h3>
                <p class="text-green-600 mb-3">Pelayanan Pastoral & Konseling</p>
                <p class="text-gray-600 text-sm">
                    Memberikan dukungan pastoral, konseling, dan kunjungan kepada anggota jemaat.
                </p>
            </div>
        </div>
    </div>

    <!-- Ajakan -->
    <div class="mt-12 bg-gradient-to-r from-indigo-600 to-blue-600 rounded-lg p-8 text-white text-center">
        <h2 class="text-2xl font-bold mb-4">Bergabunglah Dengan Kami</h2>
        <p class="mb-6">Kami senantiasa terbuka untuk melayani Anda dan keluarga. Hubungi kami untuk informasi lebih lanjut.</p>
        <a href="#contact" class="inline-block bg-white text-indigo-600 font-bold px-8 py-3 rounded-lg hover:bg-gray-100 transition">
            Hubungi Kami
        </a>
    </div>
</div>
@endsection
