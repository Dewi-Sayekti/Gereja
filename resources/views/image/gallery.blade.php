@extends('layouts.landing')

@section('content')
<div class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Galeri Kegiatan Gereja</h1>
    <p class="text-gray-700 leading-relaxed mb-8 text-center">
        Lihat berbagai kegiatan dan momen berharga dari perjalanan gereja kami.
    </p>

        <div class="flex justify-end mb-6">
        <a href="{{ route('admin.galeri.create') }}"
             class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
         + Tambah Gambar
        </a>
        </div>

    @if($images && count($images) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($images as $image)
                    <div class="relative overflow-hidden rounded-lg shadow-lg group">

                    <img src="{{ asset('storage/'.$image->path) }}"
                        alt="{{ $image->title }}"
                        class="w-full h-48 object-cover">

            <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2">

                        <p class="text-white font-semibold">{{ $image->title }}</p>

                        <!-- Detail -->
                        <a href="{{ route('image.detail', $image->id) }}"
                        class="bg-white text-gray-800 px-3 py-1 rounded text-sm">
                            Detail
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('admin.galeri.edit', $image->id) }}"
                        class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                            Edit
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('admin.galeri.delete', $image->id) }}" method="POST"
                            onsubmit="return confirm('Yakin mau hapus?')">
                    @csrf
                @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                            Hapus
                        </button>
                </form>

            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-500">Belum ada gambar yang di-upload.</p>
    </div>
    @endif
</div>
@endsection
