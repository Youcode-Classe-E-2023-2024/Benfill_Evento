<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/events/status/{id}', [EventController::class, 'changeStatus'])->name('events.status');
    Route::get('/events/{slug}', [EventController::class, 'show']);
    Route::resource('events', EventController::class)->except(['show']);;
    Route::resource('reservations', ReservationController::class);
    Route::resource('tickets', TicketController::class);


    // Roles
    Route::get('/manage-roles', [RoleController::class, 'index'])->name('manage_roles')->can('role-list');
    Route::post('/create_role', [RoleController::class, 'create_role'])->name('create_role')->can('role-create');
    Route::delete('/destroy_role', [RoleController::class, 'destroy_role'])->name('destroy_role')->can('role-delete');
    Route::put('/update_user_role/{user_id}', [UserController::class, 'update_user_role'])->can('update-user-role');

    Route::delete('/delete_user/{user_id}', [UserController::class, 'destroy'])->can('delete-user');

    Route::put('/update_role', [RoleController::class, 'update_role'])->can('role-edit');

    // Categories
    Route::get('/category', [CategoryController::class, 'index'])->can('category-list');

    Route::resource('categories', CategoryController::class);

    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

});

require __DIR__ . '/auth.php';
