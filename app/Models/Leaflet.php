<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Leaflet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'pdf_path',
        'thumbnail_path',
        'file_size',
        'views_count',
    ];

    protected static function booted()
    {
        static::creating(function ($leaflet) {
            if (empty($leaflet->slug)) {
                $baseSlug = Str::slug($leaflet->title ?: 'leaflet');
                $slug = $baseSlug;
                $counter = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter++;
                }
                $leaflet->slug = $slug;
            }
        });
    }

    public function getPdfUrlAttribute(): string
    {
        return route('leaflet.stream', $this->id);
    }

    public function getDownloadUrlAttribute(): string
    {
        return route('leaflet.download', $this->id);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail_path) {
            return null;
        }
        if (str_starts_with($this->thumbnail_path, 'http://') || str_starts_with($this->thumbnail_path, 'https://')) {
            return $this->thumbnail_path;
        }
        return '/storage/' . ltrim($this->thumbnail_path, '/');
    }
}
