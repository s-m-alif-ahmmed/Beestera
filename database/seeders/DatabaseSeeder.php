<?php

namespace Database\Seeders;

use App\Models\Train;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PlanSeeder::class,
        ]);
        $this->call(TaskSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CMSSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TrainSeeder::class);
        $this->call(LearnSeeder::class);
    }
}
