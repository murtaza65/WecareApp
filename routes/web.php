<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Repositories\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/schedule', function () {
    $schedule = new Schedule();
    $schedule->schedule();

    return view('datepicker');
});
Auth::routes();

Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    }
);

Route::get('/goals', function () {
    return view('goals.index');
})->name('goals');

Route::middleware([
    'auth',
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/chat', function () {
        // return Inertia::render('Messages');
    })->name('messages');
    Route::get('/goals-progress', function () {
        // return Inertia::render('GoalsProgress');
    })->name('goals-progress');

    // Route::get('/goals', function () {
    //     // return Inertia::render('GoalsProgress');
    // })->name('goals');

    Route::get('/reminders', function () {
        // return Inertia::render('Reminders');
    })->name('reminders');
    Route::get('/community/support', function () {
        // return Inertia::render('CommunitySupport');
    })->name('community-support');
    Route::get('/goals/add-goal', function () {
        // return Inertia::render('AddGoal');
    })->name('add-goal');

    Route::get('/community/add-members', function () {
        // return Inertia::render('AddCommunityMembers');
    })->name('add-community-members');

    Route::get('/profile', function () {
        // return Inertia::render('AddCommunityMembers');
    })->name('profile');
});
