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
        // تحديث قيم sort_order للفئات الموجودة
        $categories = DB::table('categories')->orderBy('id')->get();
        
        foreach ($categories as $index => $category) {
            DB::table('categories')
                ->where('id', $category->id)
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
