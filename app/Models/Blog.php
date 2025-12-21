<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'author_name',
        'author_role',
        'category',
        'reading_time',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image_alt',
        'provider_key',
        'icon_name',
        'gradient_from',
        'gradient_to',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Generate slug from title
     */
    public static function generateSlug(string $title): string
    {
        return Str::slug($title);
    }

    /**
     * Get related blogs by provider
     */
    public static function getByProvider(string $providerKey, int $limit = 5)
    {
        return static::where('provider_key', $providerKey)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get related blogs (same category or provider)
     */
    public function getRelated(int $limit = 3)
    {
        return static::where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->where('category', $this->category)
                    ->orWhere('provider_key', $this->provider_key);
            })
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
