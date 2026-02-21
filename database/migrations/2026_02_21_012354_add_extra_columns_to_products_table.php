<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    public function up(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('subtitle')->nullable()->after('name');
        $table->string('badge')->nullable()->after('category');
        $table->decimal('old_price', 8, 2)->nullable()->after('price');
        $table->boolean('is_featured')->default(false)->after('old_price');
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['subtitle', 'badge', 'old_price', 'is_featured']);
    });
}
};
