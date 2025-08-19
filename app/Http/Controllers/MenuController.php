<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function menu(): JsonResponse
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function (Category $cat) {
                return [
                    'slug' => $cat->slug,
                    'label' => [
                        'en' => $cat->label_en,
                        'ar' => $cat->label_ar,
                    ],
                ];
            })->values()->all();

        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->with(['category'])
            ->get()
            ->map(function (Product $p) {
                return [
                    'id' => $p->id,
                    'name' => [
                        'en' => $p->name_en,
                        'ar' => $p->name_ar,
                    ],
                    'description' => [
                        'en' => $p->description_en,
                        'ar' => $p->description_ar,
                    ],
                    'price' => (float) $p->price,
                    'currency' => $p->currency,
                    'image' => $p->image_path ? Storage::url($p->image_path) : null,
                    'category' => optional($p->category)->slug,
                    'is_favorite' => $p->is_favorite,
                ];
            })->values()->all();

        // Get favorite products for most-liked section
        $favoriteProducts = Product::query()
            ->where('is_active', true)
            ->where('is_favorite', true)
            ->orderBy('sort_order')
            ->with(['category'])
            ->get()
            ->map(function (Product $p) {
                return [
                    'id' => $p->id,
                    'name' => [
                        'en' => $p->name_en,
                        'ar' => $p->name_ar,
                    ],
                    'description' => [
                        'en' => $p->description_en,
                        'ar' => $p->description_ar,
                    ],
                    'price' => (float) $p->price,
                    'currency' => $p->currency,
                    'image' => $p->image_path ? Storage::url($p->image_path) : null,
                    'category' => optional($p->category)->slug,
                    'is_favorite' => $p->is_favorite,
                ];
            })->values()->all();

        return response()->json([
            'categories' => $categories,
            'products' => $products,
            'favorites' => $favoriteProducts,
        ]);
    }
}


