<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('picture')->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable()->default('active');
            $table->timestamps();
        });

        // DB::table('cms')->insert([
        //     //Player Challenge
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        //     //LeaderBoard
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

        //     //Control
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        //     //Solo Training
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        //     //Partner Training
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        //     //Challenges
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

        //     // MindSet
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        //     // Position-Specific
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        //     // Guidebooks
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        //     // General
        //     ['title' => null, 'description' => null, 'picture' => null, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms');
    }
};
