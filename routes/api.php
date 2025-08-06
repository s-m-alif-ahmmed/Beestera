<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\SocialLoginController;
use App\Http\Controllers\Api\Home\ChallengePointController;
use App\Http\Controllers\Api\Home\CMSController;
use App\Http\Controllers\Api\Home\TaskController;

use App\Http\Controllers\Api\Profile\UpdateProfileController;

use App\Http\Controllers\Api\Home\LeaderBoardController;
use App\Http\Controllers\Api\Achievement\AchievementController;
use App\Http\Controllers\Api\Learn\LearnContentController;
use App\Http\Controllers\Api\RevenueCatWebhookController;
use App\Http\Controllers\Api\Roadmap\RoadMapController;
use App\Http\Controllers\Api\Train\TrainContentController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

//Social login test routes
Route::controller(SocialLoginController::class)->group(function () {
    Route::post('/social/login', 'socialLogin');
    Route::post('/auth/apple/callback', 'redirectCallbackApple');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::post('auth/forgot-password', 'sendResetCode');
    Route::post('auth/verify-otp', 'verifyOtp');
    Route::post('auth/reset-password', 'newpassword');
});
// Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetCode']);
// Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('subscription-check/{planId}', [AuthController::class, 'subscriptionCheck']);
    // Route::get('view-profile', [AuthController::class, 'view_profile']);
    Route::post('/user-delete', [AuthController::class, 'deleteUser']);


    Route::get('/get-task', [TaskController::class, 'getTask']);

    Route::get('/get-cms' , [CMSController::class,'index']);

    Route::controller(UpdateProfileController::class)->group(function () {
        Route::get('/view-profile','index');
        Route::post('/profile-update', 'store');
    });

    Route::controller(TrainContentController::class)->group(function(){
        Route::get('train/all','index');
        // Route::get('train/search' , 'search');
    });
    Route::controller(LearnContentController::class)->group(function(){
        Route::get('learn/all','index');
        // Route::get('learn/search' , 'search');
    });

    Route::controller(AchievementController::class)->group(function(){
        Route::get('achievement/movement','movement_index');
        Route::get('achievement/manipulation','manipulation_index');
        Route::get('achievement/control','control_index');
        Route::get('achievement/striking','striking_index');
    });
    Route::controller(RoadMapController::class)->group(function(){
        Route::get('roadmap/movement','movement_index');
        Route::get('roadmap/manipulation','manipulation_index');
        Route::get('roadmap/control','control_index');
        Route::get('roadmap/striking','striking_index');

        // ['MOVEMENT', 'MANIPULATION', 'CONTROL', 'STRIKING']
    });

    Route::get('/leaderboard', [LeaderBoardController::class, 'index']);

    Route::post('/challenge-point/create', [ChallengePointController::class, 'create'])->name('challenge-point');

});

use Illuminate\Support\Facades\Artisan;

Route::get('/run-composer-update', function () {
    abort_unless(request()->query('key') === env('SECURE_KEY'), 403);

    $path = base_path(); // This gets the Laravel root directory (where composer.json lives)

    try {
        $output = shell_exec("cd {$path} && composer update 2>&1");
        return response("<pre>$output</pre>");
    } catch (\Exception $e) {
        return response("Error: " . $e->getMessage(), 500);
    }
});


//RevenueCat cart webhook
Route::post('/revenue-cat/webhook', [RevenueCatWebhookController::class, 'handle']);




