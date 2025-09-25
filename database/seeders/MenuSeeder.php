<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            ['label_en' => 'Hot Beverages', 'label_ar' => 'مشروبات حارة', 'sort_order' => 1],
            ['label_en' => 'Cakes', 'label_ar' => 'كيك', 'sort_order' => 2],
            ['label_en' => 'Cold Beverages', 'label_ar' => 'مشروبات باردة', 'sort_order' => 3],
            ['label_en' => 'Bakery', 'label_ar' => 'مخبوزات', 'sort_order' => 4],
            ['label_en' => 'Ice Cream', 'label_ar' => 'آيس كريم', 'sort_order' => 5],
        ])->map(fn ($c) => Category::updateOrCreate(['label_en' => $c['label_en']], $c));

        $catsByEn = $categories->keyBy('label_en');

        $products = [
            ['cat' => 'Hot Beverages', 'en' => 'Double Espresso', 'ar' => 'اسبريسو مزدوج', 'price' => 2.500, 'img' => 'products/images/3.png', 'sort' => 1, 'favorite' => true],
            ['cat' => 'Hot Beverages', 'en' => 'Americano', 'ar' => 'أمريكانو', 'price' => 2.500, 'img' => 'products/images/3.png', 'sort' => 2],
            ['cat' => 'Hot Beverages', 'en' => 'Latte', 'ar' => 'لاتيه', 'price' => 3.000, 'img' => 'products/images/4.png', 'sort' => 3, 'favorite' => true],
            ['cat' => 'Hot Beverages', 'en' => 'Cappuccino', 'ar' => 'كابتشينو', 'price' => 2.800, 'img' => 'products/images/4.png', 'sort' => 4],
            ['cat' => 'Hot Beverages', 'en' => 'Spanish Latte', 'ar' => 'سبانيش لاتيه', 'price' => 3.500, 'img' => 'products/images/4.png', 'sort' => 5, 'favorite' => true],
            ['cat' => 'Hot Beverages', 'en' => 'Black Tea', 'ar' => 'شاي أسود', 'price' => 1.200, 'img' => 'products/images/hotdrink.png', 'sort' => 6],
            ['cat' => 'Hot Beverages', 'en' => 'Green Tea', 'ar' => 'شاي أخضر', 'price' => 1.200, 'img' => 'products/images/hotdrink.png', 'sort' => 7],
            ['cat' => 'Hot Beverages', 'en' => 'Karak Tea', 'ar' => 'شاي كرك', 'price' => 1.400, 'img' => 'products/images/hotdrink.png', 'sort' => 8, 'favorite' => true],
            ['cat' => 'Cakes', 'en' => 'Arabic Cake Slice', 'ar' => 'شريحة كيك عربي', 'price' => 1.800, 'img' => 'products/images/cake.png', 'sort' => 1],
            ['cat' => 'Cakes', 'en' => 'Tiramisu', 'ar' => 'تيراميسو', 'price' => 2.400, 'img' => 'products/images/cake.png', 'sort' => 2, 'favorite' => true],
            ['cat' => 'Cakes', 'en' => 'Popular Cake', 'ar' => 'كيك شعبي', 'price' => 1.600, 'img' => 'products/images/cake.png', 'sort' => 3],
            ['cat' => 'Cold Beverages', 'en' => 'Iced Americano', 'ar' => 'امريكانو بارد', 'price' => 2.800, 'img' => 'products/images/1.png', 'sort' => 1],
            ['cat' => 'Cold Beverages', 'en' => 'Iced Latte', 'ar' => 'لاتيه بارد', 'price' => 3.000, 'img' => 'products/images/1.png', 'sort' => 2, 'favorite' => true],
            ['cat' => 'Cold Beverages', 'en' => 'Iced Spanish', 'ar' => 'سبانيش بارد', 'price' => 3.800, 'img' => 'products/images/1.png', 'sort' => 3],
            ['cat' => 'Cold Beverages', 'en' => 'Iced White Mocha', 'ar' => 'وايت موكا بارد', 'price' => 4.200, 'img' => 'products/images/1.png', 'sort' => 4],
            ['cat' => 'Cold Beverages', 'en' => 'Iced Matcha Latte', 'ar' => 'ماتشا لاتيه بارد', 'price' => 3.500, 'img' => 'products/images/2.png', 'sort' => 5],
            ['cat' => 'Cold Beverages', 'en' => 'Iced Rose', 'ar' => 'وردي بارد', 'price' => 3.200, 'img' => 'products/images/1.png', 'sort' => 6],
            ['cat' => 'Cold Beverages', 'en' => 'Mango Frappe', 'ar' => 'فرابيه مانجو', 'price' => 3.800, 'img' => 'products/images/2.png', 'sort' => 7, 'favorite' => true],
            ['cat' => 'Cold Beverages', 'en' => 'Mango Juice', 'ar' => 'عصير مانجو', 'price' => 2.200, 'img' => 'products/images/2.png', 'sort' => 8],
            ['cat' => 'Cold Beverages', 'en' => 'Orange Juice', 'ar' => 'عصير برتقال', 'price' => 2.000, 'img' => 'products/images/1.png', 'sort' => 9],
            ['cat' => 'Cold Beverages', 'en' => 'Strawberry Mojito', 'ar' => 'موهيتو فراولة', 'price' => 3.500, 'img' => 'products/images/1.png', 'sort' => 10, 'favorite' => true],
            ['cat' => 'Cold Beverages', 'en' => 'Passion Mojito', 'ar' => 'موهيتو باشن', 'price' => 3.500, 'img' => 'products/images/2.png', 'sort' => 11],
            ['cat' => 'Cold Beverages', 'en' => 'Lemon w/ Mint', 'ar' => 'ليمون نعنع', 'price' => 3.200, 'img' => 'products/images/1.png', 'sort' => 12],
            ['cat' => 'Cold Beverages', 'en' => 'Carcadet', 'ar' => 'كركديه', 'price' => 3.000, 'img' => 'products/images/2.png', 'sort' => 13],
            ['cat' => 'Bakery', 'en' => 'Chicken Sandwich', 'ar' => 'ساندويش دجاج', 'price' => 2.600, 'img' => 'products/images/sandwich.png', 'sort' => 1, 'favorite' => true],
            ['cat' => 'Bakery', 'en' => 'Butter Croissant', 'ar' => 'كرواسون زبدة', 'price' => 1.200, 'img' => 'products/images/carwason.png', 'sort' => 2],
            ['cat' => 'Bakery', 'en' => 'Popular Sandwich', 'ar' => 'ساندويج شعبي', 'price' => 2.000, 'img' => 'products/images/brade.png', 'sort' => 3],
            ['cat' => 'Ice Cream', 'en' => 'Classic Affogato', 'ar' => 'أفوقاتو كلاسيك', 'price' => 4.500, 'img' => 'products/images/11.png', 'sort' => 1, 'favorite' => true],
            ['cat' => 'Ice Cream', 'en' => 'Matcha Affogato', 'ar' => 'ماتشا أفوقاتو', 'price' => 4.800, 'img' => 'products/images/11.png', 'sort' => 2],
            ['cat' => 'Ice Cream', 'en' => 'Lotus Affogato', 'ar' => 'لوتس أفوقاتو', 'price' => 5.000, 'img' => 'products/images/11.png', 'sort' => 3],
        ];

        foreach ($products as $p) {
            $cat = $catsByEn[$p['cat']];
            Product::updateOrCreate(
                ['name_en' => $p['en'], 'category_id' => $cat->id],
                [
                    'name_en' => $p['en'],
                    'name_ar' => $p['ar'],
                    'description_en' => 'Delicious ' . strtolower($p['en']),
                    'description_ar' => 'لذيذ ' . $p['ar'],
                    'price' => $p['price'],
                    'currency' => 'BHD',
                    'image_path' => $p['img'],
                    'sort_order' => $p['sort'],
                    'is_active' => true,
                    'is_favorite' => $p['favorite'] ?? false,
                ]
            );
        }
    }
}
