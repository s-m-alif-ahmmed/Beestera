<?php

use App\Http\Controllers\Web\Backend\Achievement\AchievementController;
use App\Http\Controllers\Web\Backend\CMS\Learn\CMSGeneralController;
use App\Http\Controllers\Web\Backend\CMS\Learn\CMSGuideBooksController;
use App\Http\Controllers\Web\Backend\CMS\Learn\CMSMindsetController;
use App\Http\Controllers\Web\Backend\CMS\Learn\CMSPositionSpecificController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\CMS\Progress\CMSChallengeController;
use App\Http\Controllers\Web\Backend\CMS\Progress\CMSLeaderBoardController;
use App\Http\Controllers\Web\Backend\CMS\Train\CMSChallengesController;
use App\Http\Controllers\Web\Backend\CMS\Train\CMSControlController;
use App\Http\Controllers\Web\Backend\CMS\Train\CMSPartnerTrainingController;
use App\Http\Controllers\Web\Backend\CMS\Train\CMSSolotrainingController;
use App\Http\Controllers\Web\Backend\Home\ApprovedTaskController;
use App\Http\Controllers\Web\Backend\Home\UserTaskController;
use App\Http\Controllers\Web\Backend\Home\DashboardController;
use App\Http\Controllers\Web\Backend\Home\UserTaskHistoryController;
use App\Http\Controllers\Web\Backend\LeaderBoard\LeaderBoardController;
use App\Http\Controllers\Web\Backend\Users\UserListController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\SystemSettingController;
use App\Http\Controllers\Web\Backend\Train\TrainContentController;
use App\Http\Controllers\Web\Backend\Categories\CategoriesController;
use App\Http\Controllers\Web\Backend\CMS\Progress\CMSAchievementController;
use App\Http\Controllers\Web\Backend\CMS\Progress\CMSRoadmapController;
use App\Http\Controllers\Web\Backend\Learn\LearnContentController;
use App\Http\Controllers\Web\Backend\RoadMap\RoadMapController;

Route::get('/', function () {
    return view('frontend.layouts.index');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/admin/profile', 'index')->name('profile.setting');
        Route::put('/admin/update-profile', 'UpdateProfile')->name('update.profile');
        Route::put('/admin/update-profile-password', 'UpdatePassword')->name('update.Password');
        Route::post('/admin/update-profile-picture', 'UpdateProfilePicture')->name('update.profile.picture');
    });

    Route::controller(SystemSettingController::class)->group(function () {
        Route::get('/admin/system-setting', 'index')->name('system.index');
        Route::patch('/admin/system-setting', 'update')->name('system.update');
    });

    Route::controller(UserListController::class)->group(function () {
        Route::get('/user-list', 'index')->name('user_list.index');
        Route::delete('/user/delete/{id}', 'destroy')->name('user-delete');
    });

    Route::controller(UserTaskController::class)->group(function () {
        Route::get('/user/task/index', 'index')->name('user.task.index');
        Route::get('/user/task/create', 'create')->name('user.task.create');
        Route::post('/user/task/store', 'store')->name('user.task.store');
        Route::get('/tasks/{id}/edit', 'edit')->name('user.task.edit');
        Route::put('/user/task/update/{id}', 'update')->name('user.task.update');
        Route::delete('/task/delete/{id}', 'destroy')->name('user.task.delete');
    });

    Route::controller(LeaderBoardController::class)->group(function () {
        Route::get('/leaderboard', 'index')->name('user.leaderboard');
    });

    Route::controller(UserTaskHistoryController::class)->group(function () {
        Route::get('/task-history', 'index')->name('user.task.history');
        Route::post('approve-task/{id}', 'approveTask')->name('approve.task');
        Route::post('reject-task/{id}', 'rejectTask')->name('reject.task');
    });

    Route::controller(ApprovedTaskController::class)->group(function () {
        Route::get('approved-task', 'index')->name('user.approved.task');
        Route::delete('approved-task/delete/{id}', 'deleteTask')->name('user.approved.task.delete');
    });

    Route::controller(LeaderBoardController::class)->group(function () {
        Route::get('/leaderboard', 'index')->name('user.leaderboard');
        Route::delete('leaderboard/delete/{id}', 'deleteUser')->name('user.leaderboard.delete');
    });

    //CMS for Progress Page
    Route::controller(CMSChallengeController::class)->group(function () {
        Route::get('/cms/challenge/banner', 'index')->name('cms.challenge.banner');
        Route::put('/cms/challenge/banner/update', 'store')->name('cms.challenge.banner.update');
    });

    Route::controller(CMSLeaderBoardController::class)->group(function () {
        Route::get('/cms/leaderboard/banner', 'index')->name('cms.leaderboard.banner');
        Route::put('/cms/leaderboard/banner/update', 'store')->name('cms.leaderboard.banner.update');
    });

    Route::controller(CMSRoadmapController::class)->group(function () {
        Route::get('/cms/roadmap/banner', 'index')->name('cms.roadmap.banner');
        Route::put('/cms/roadmap/banner/update', 'store')->name('cms.roadmap.banner.update');
    });

    Route::controller(CMSAchievementController::class)->group(function () {
        Route::get('/cms/achievement/banner', 'index')->name('cms.achievement.banner');
        Route::put('/cms/achievement/banner/update', 'store')->name('cms.achievement.banner.update');
    });

    // CMS for Train Page
    Route::controller(CMSControlController::class)->group(function () {
        Route::get('cms/train/control/banner', 'index')->name('cms.train.control.banner');
        Route::post('cms/train/control/banner/update', 'store')->name('cms.train.control.banner.update');
    });


    Route::controller(CMSSolotrainingController::class)->group(function () {
        Route::get('cms/train/solo-training/banner', 'index')->name('cms.train.solo-training.banner');
        Route::post('cms/train/solo-training/banner/update', 'store')->name('cms.train.solo-training.banner.update');
    });

    Route::controller(CMSChallengesController::class)->group(function () {
        Route::get('cms/train/challenges/banner', 'index')->name('cms.train.challenges.banner');
        Route::post('cms/train/challenges/banner/update', 'store')->name('cms.train.challenges.banner.update');
    });


    Route::controller(CMSPartnerTrainingController::class)->group(function () {
        Route::get('cms/train/partner-training/banner', 'index')->name('cms.train.partner-training.banner');
        Route::post('cms/train/partner-training/banner/update', 'store')->name('cms.train.partner-training.banner.update');
    });


    // CMS for Learn Page

    Route::controller(CMSMindsetController::class)->group(function () {
        Route::get('cms/learn/mindset/banner', 'index')->name('cms.learn.mindset.banner');
        Route::post('cms/learn/mindset/banner/update', 'store')->name('cms.learn.mindset.banner.update');
    });

    Route::controller(CMSPositionSpecificController::class)->group(function () {
        Route::get('cms/learn/position-specific/banner', 'index')->name('cms.learn.position-specific.banner');
        Route::post('cms/learn/position-specific/banner/update', 'store')->name('cms.learn.position-specific.banner.update');
    });

    Route::controller(CMSGuideBooksController::class)->group(function () {
        Route::get('cms/learn/guide-book/banner', 'index')->name('cms.learn.guide-book.banner');
        Route::post('cms/learn/guide-book/banner/update', 'store')->name('cms.learn.guide-book.banner.update');
    });
    Route::controller(CMSGeneralController::class)->group(function () {
        Route::get('cms/learn/general/banner', 'index')->name('cms.learn.general.banner');
        Route::post('cms/learn/general/banner/update', 'store')->name('cms.learn.general.banner.update');
    });

    // Train Contents

    Route::controller(TrainContentController::class)->group(function () {
        Route::get('train/content/list', 'index')->name('train.content.list');
        Route::get('train/content/create', 'create')->name('train.content.create');
        Route::post('train/content/store', 'store')->name('train.content.store');
        Route::get('train/content/{id}/edit', 'edit')->name('train.content.edit');
        Route::put('train/content/{id}', 'update')->name('train.content.update');
        Route::get('train/content/toggle-status/{id}', 'toggleStatus')->name('train.content.toggleStatus');
        Route::delete('train/content/{id}', 'destroy')->name('train.content.destroy');
        Route::put('train/content/content/', 'content')->name('train.content.content');

    });


    // Learn Contents

    Route::controller(LearnContentController::class)->group(function () {
        Route::get('learn/content/list', 'index')->name('learn.content.list');
        Route::get('learn/content/create', 'create')->name('learn.content.create');
        Route::post('learn/content/store', 'store')->name('learn.content.store');
        Route::get('learn/content/{id}/edit', 'edit')->name('learn.content.edit');
        Route::put('learn/content/{id}', 'update')->name('learn.content.update');
        Route::get('learn/content/toggle-status/{id}', 'toggleStatus')->name('learn.content.toggleStatus');
        Route::delete('learn/content/{id}', 'destroy')->name('learn.content.destroy');
        Route::put('learn/content/content/', 'content')->name('learn.content.content');

    });

    // Categories

    Route::controller(CategoriesController::class)->group(function () {
        Route::get('category/list', 'index')->name('category.list');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category/store', 'store')->name('category.store');
        Route::get('category/{id}/edit', 'edit')->name('category.edit');
        Route::put('category/{id}', 'update')->name('category.update');
        Route::get('category/toggleStatus/{id}', 'toggleStatus')->name('category.toggleStatus');
        Route::delete('category/delete/{id}', 'destroy')->name('category.destroy');
        Route::put('category/content/', 'content')->name('category.content');
    });

    // Achievement

    Route::controller(AchievementController::class)->group(function () {
        Route::get('achievement/content/list', 'index')->name('achievement.content.list');
        Route::get('achievement/content/create', 'create')->name('achievement.content.create');
        Route::post('achievement/content/store', 'store')->name('achievement.content.store');
        Route::get('achievement/{id}/edit', 'edit')->name('achievement.content.edit');
        Route::put('achievement/{id}', 'update')->name('achievement.content.update');
        Route::get('achievement/toggleStatus/{id}', 'toggleStatus')->name('achievement.content.toggleStatus');
        Route::delete('achievement/delete/{id}', 'destroy')->name('achievement.content.destroy');
        Route::put('achievement/content/', 'content')->name('achievement.content');
    });

    // RoadMap

    Route::controller(RoadMapController::class)->group(function(){
        Route::get('roadmap/content/list', 'index')->name('roadmap.content.list');
        Route::get('roadmap/content/create', 'create')->name('roadmap.content.create');
        Route::post('roadmap/content/store', 'store')->name('roadmap.content.store');
        Route::get('roadmap/{id}/edit', 'edit')->name('roadmap.content.edit');
        Route::put('roadmap/{id}', 'update')->name('roadmap.content.update');
        Route::get('roadmap/toggleStatus/{id}', 'toggleStatus')->name('roadmap.content.toggleStatus');
        Route::delete('roadmap/delete/{id}', 'destroy')->name('roadmap.content.destroy');
        Route::put('roadmap/content/', 'content')->name('roadmap.content');
    });

    // Route::controller(FaqController::class)->group(function () {
    //     Route::get('/faq', 'index')->name('cms.home.faq');
    //     Route::get('/faq/create', 'create')->name('cms.home.faq.create');
    //     Route::post('/faq', 'store')->name('cms.home.faq.store');
    //     Route::get('/faq/{slug}/edit', 'edit')->name('faq.edit');
    //     Route::put('/faq/{slug}', 'update')->name('faq.update');
    //     Route::post('/faq/toggle-status/{id}', 'toggleStatus')->name('faq.toggleStatus');
    //     Route::delete('/faq/{slug}', 'destroy')->name('faq.destroy');
    //     Route::put('/faq/content/', 'content')->name('cms.home.faq.content');
    // });
});
