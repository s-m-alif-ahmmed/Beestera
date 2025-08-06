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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->string('achievement')->nullable();
            $table->string('person_focus')->nullable(); // type
            $table->string('person_focus_description')->nullable();
            $table->string('player_focus')->nullable(); //topic
            $table->string('player_focus_description')->nullable();
            $table->string('phase')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('base_video')->nullable();
            $table->string('build_video')->nullable();
            $table->string('boost_video')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
