<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\SupportController;
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

Route::middleware([
    'auth',
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('chat', ChatController::class);
    // Route::get('/chat', function () {
    // })->name('messages');
    Route::resource('/goals/progress', ProgressController::class);

    Route::resource('/goals', GoalController::class);

    Route::resource('/reminders', ReminderController::class);
    Route::resource('/support', SupportController::class);

    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('/community/add-member', [CommunityController::class, 'addMember'])->name('community.add_member');
    Route::post('/community/remove-member', [CommunityController::class, 'removeMember'])->name('community.remove_member');

    Route::resource('/profile', ProfileController::class);

    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
});
