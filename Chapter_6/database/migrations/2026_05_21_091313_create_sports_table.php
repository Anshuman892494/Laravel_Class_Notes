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
        Schema::create('sports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sports_name');
            $table->string('category');
            $table->integer('no_of_players');
            $table->text('description')->nullable();
            $table->boolean('is_olympic');
            $table->date('date_of_sport');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports');
    }
};
