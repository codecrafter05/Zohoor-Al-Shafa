<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name_en', 'name_ar', 'description_ar', 'description_en', 'price', 'currency', 'image_path', 'sort_order', 'is_active', 'is_favorite',
    ];

    protected $casts = [
        'price' => 'decimal:3',
        'is_active' => 'boolean',
        'is_favorite' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // إضافة scope للترتيب الافتراضي
    protected static function booted(): void
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('sort_order', 'asc');
        });
    }
}
