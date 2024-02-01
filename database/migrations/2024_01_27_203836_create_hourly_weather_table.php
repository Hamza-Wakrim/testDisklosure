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
        Schema::create('hourly_weather', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weatherdata_id')->constrained('weather_data')->onDelete('cascade');
            $table->dateTime('time');
            $table->string('type');
            $table->decimal('value', 5, 1);
            $table->timestamps();

            $table->index('weatherdata_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hourly_weather');
    }
};
