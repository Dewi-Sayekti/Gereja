<?php

namespace App\Http\Controllers;

use App\Models\HeroSlider;
use App\Models\Image;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display the landing page with hero sliders
     */
    public function index(): View
    {
        $heroSliders = HeroSlider::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->toArray();

        $images = Image::all();

        return view('welcome', [
            'heroSliders' => $heroSliders,
            'images' => $images,
        ]);
    }

    public function gallery(): View
    {
        $images = Image::all();
        return view('image.gallery', compact('images'));
    }

    public function show($id)
    {
        $image = Image::findOrFail($id);
        return view('image.detail', compact('image'));
    }

    /**
     * Show the form for creating a new image
     */
    public function create(): View
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly uploaded image
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Image::create([
            'title' => $request->title,
            'path' => $imagePath,
        ]);

        return redirect()->route('admin.galeri.create')->with('success', 'Gambar berhasil ditambahkan!');
    }
}
