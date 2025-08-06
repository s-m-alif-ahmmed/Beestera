<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;



Route::get('/run-migrate', function () {
    Artisan::call('migrate');
    return 'Database migration completed successfully!';
});

Route::get('/run-migrate-fresh', function () {
    Artisan::call('migrate:fresh --seed');
    return 'Database migration and seeding completed successfully!';
});
Route::get('/seed-cms', function () {
    Artisan::call('db:seed', [
        '--class' => 'CMSSeeder'
    ]);
    return 'CMSSeeder executed successfully!';
});
Route::get('/run-optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Application cache cleared and optimized!';
});

require __DIR__ . '/auth.php';

// Include backend routes
require base_path('routes/backend.php');
