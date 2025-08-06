<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('road_maps', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->enum('category', ['MOVEMENT', 'MANIPULATION', 'CONTROL', 'STRIKING'])->nullable();
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->longText('details')->nullable();
            $table->string('vimeo_id')->nullable();
            $table->enum('status' , ['active' , 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('road_maps');
    }
};
