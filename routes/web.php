<?php

use App\Http\Controllers\AuditsController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Barryvdh\Debugbar\DataCollector\RequestCollector;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/equipment', [EquipmentController::class, 'index'])->middleware(['auth', 'verified'])->name('equipment');
Route::get('/room', [RoomController::class, 'index'])->middleware(['auth', 'verified'])->name('room');
Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware(['auth', 'verified']);
Route::get('/borrowing', [BorrowingController::class, 'read'])->middleware(['auth', 'verified'])->name('borrowing');
Route::put('/reject/{id}', [BorrowingController::class, 'reject'])->middleware(['auth', 'verified']);
Route::put('/approve/{id}', [BorrowingController::class, 'approve'])->middleware(['auth', 'verified']);
Route::put('/returned/{id}', [BorrowingController::class, 'returned'])->middleware(['auth', 'verified']);

Route::get('/maintenance', [MaintenanceController::class, 'read'])->middleware(['auth', 'verified'])->name('maintenance');
Route::put('/complete/{id}', [MaintenanceController::class, 'complete'])->middleware(['auth', 'verified']);



Route::get('/audits', [AuditsController::class, 'index'])->middleware(['auth', 'verified'])->name('audits');


Route::get('/request', [RequestController::class, 'index'])->middleware(['auth', 'verified'])->name('request');
Route::post('/borrowing/details', [RequestController::class, 'details'])->middleware(['auth', 'verified'])->name('borrowing.details');
Route::post('/borrowing/submit', [RequestController::class, 'submit'])->middleware(['auth', 'verified'])->name('borrowing.submit');
Route::post('/borrowing/request', [RequestController::class, 'request'])->middleware(['auth', 'verified'])->name('borrowing.request');


Route::post('/submit-issue', [DashboardController::class, 'issue'])->middleware(['auth', 'verified'])->name('submit-issue');
Route::post('/add-user', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('add-user');
Route::post('/assign-technician/{id}', [MaintenanceController::class, 'assign'])->middleware(['auth', 'verified'])->name('assign.technician');


// Route::get('/users/add', function () {
//     return view('components.user.add');
// });