@extends('layouts.landing')

@section('content')
    <div class="container mx-auto py-12 px-6">
        <a href="{{ route('gallery') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition mb-4">← Kembali ke Galeri</a>

        <div class="text-center">
            <img src="{{ asset('storage/'.$image->path) }}" class="img-fluid rounded shadow max-w-full h-auto" alt="{{ $image->title }}">
            <h2 class="mt-4 text-2xl font-bold text-gray-800">{{ $image->title }}</h2>
            @if($image->description)
                <p class="mt-3 text-gray-600">{{ $image->description }}</p>
            @endif
        </div>
    </div>
@endsection
