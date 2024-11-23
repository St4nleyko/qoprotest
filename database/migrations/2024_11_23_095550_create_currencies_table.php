<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('coin_id')->unique();
            $table->decimal('current_price', 16, 8);
            $table->decimal('price_change_percentage_24h', 16, 8)->nullable();
            $table->string('image_url')->nullable();
            $table->bigInteger('market_cap')->nullable();
            $table->string('symbol', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
