<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->after('user_id');
            $table->string('email')->after('name');
            $table->string('phone')->after('email');
            $table->string('city')->after('address');
            $table->decimal('subtotal', 8, 2)->after('city');
            $table->decimal('shipping', 8, 2)->after('subtotal');
        });
    }

    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'city', 'subtotal', 'shipping']);
        });
    }
};