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
        Schema::create('list_movie', function (Blueprint $table) {
            $table->id('mov_id');
            $table->string('judul');
            $table->date('release_date'); 
            $table->string('producer', 150);
            $table->decimal('rating', 3, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_movie');
    }
};
