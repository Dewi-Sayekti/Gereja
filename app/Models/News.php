<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'image_path',
        'gradient_from',
        'gradient_to',
        'published_at',
        'is_published',
        'order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'order' => 'integer',
        'published_at' => 'date',
    ];

    public static function getPublished()
    {
        return self::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->orderBy('order')
            ->get();
    }
}
