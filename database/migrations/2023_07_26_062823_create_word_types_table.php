<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('word_types', function (Blueprint $table) {
            $table->id(); // id unsigned big integer, primary key, autoincrement
            $table->string('code')->unique(); // Identifies word type e.g. BA, IN, AC, etc.
            $table->string('name', 255);
            $table->timestamps(); // created_at  updated_at datetime (automatically added)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_types');
    }
};
