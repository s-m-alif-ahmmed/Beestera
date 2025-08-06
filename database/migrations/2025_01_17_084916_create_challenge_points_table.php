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
        Schema::create('challenge_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->integer('base_1')->nullable();
            $table->integer('base_2')->nullable();
            $table->integer('base_3')->nullable();
            $table->integer('build_1')->nullable();
            $table->integer('build_2')->nullable();
            $table->integer('build_3')->nullable();
            $table->string('user_video', 2048)->nullable();
            $table->integer('user_point')->nullable();
            $table->enum('status',['approved','rejected','pending'])->default('pending');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_points');
    }
};
