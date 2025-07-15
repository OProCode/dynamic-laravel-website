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
        Schema::create('definition_rating', function (Blueprint $table) {
            $table->id();
            $table->foreignId('definition_id');
            $table->foreignId('rating_id');
            $table->foreignId('user_id');
            $table->unsignedTinyInteger('value')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('definition_rating');
    }
};
