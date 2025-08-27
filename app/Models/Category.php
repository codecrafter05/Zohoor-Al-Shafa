<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'slug', 'label_en', 'label_ar', 'sort_order', 'is_active',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // إضافة scope للترتيب الافتراضي
    protected static function booted(): void
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('sort_order', 'asc');
        });

        static::creating(function (Category $model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->label_en);
            }
        });

        static::updating(function (Category $model) {
            if ($model->isDirty('label_en') && empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->label_en);
            }
        });
    }

    protected static function generateUniqueSlug(string $source): string
    {
        $base = Str::slug($source);
        $slug = $base;
        $i = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }
        return $slug;
    }
}
