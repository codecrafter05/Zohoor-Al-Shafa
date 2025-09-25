<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // تحديث قيم sort_order للمنتجات الموجودة
        $products = DB::table('products')->orderBy('id')->get();
        
        foreach ($products as $index => $product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update(['sort_order' => $index + 1]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // لا نحتاج إلى rollback لهذا التحديث
    }
};
