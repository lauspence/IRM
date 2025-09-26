<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MessageController;

// Public route - welcome page, accessible without login
Route::get('/', function () {
    return view('welcome');
});

// =============================
// Authentication Routes
// =============================
// Register page and handler
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
// Login page and handler
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// =============================
// Generic dashboard redirect route
// =============================
// This is the important addition to fix the error
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('manager')) {
        return redirect()->route('manager.dashboard');
    } elseif ($user->hasRole('staff')) {
        return redirect()->route('staff.tools'); // or staff.dashboard if you have that
    }

    // Default fallback if no role matched
    return redirect('/');
})->name('dashboard');

// =============================
// Admin Dashboard - protected by RoleMiddleware for 'admin'
Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
});



// =============================
// Manager Routes - protected by RoleMiddleware for 'manager'
Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':manager,admin'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/manager/tasks', [ManagerController::class, 'storeTask'])->name('manager.tasks.store');
    Route::get('/manager/reports', [ManagerController::class, 'reports'])->name('manager.reports');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
});

// =============================
// Staff Routes - protected by RoleMiddleware for 'staff'
Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':staff,manager,admin'])->group(function () {
    Route::get('/staff/tools', [StaffController::class, 'tools'])->name('staff.tools');
    Route::get('/staff/tasks', [StaffController::class, 'tasks'])->name('staff.tasks');
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
       
});

// For staff (only logged-in employees)
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('/tasks/{task}/update', [TaskController::class, 'update'])->name('tasks.update');
});

// For admin only
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

Route::patch('/tasks/{task}/complete', [TaskController::class, 'markCompleted'])

    ->name('tasks.complete');

// Staff Messaging Routes
Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':staff,manager,admin'])->prefix('staff')->group(function () {
    Route::get('/messages', function () {
        return redirect()->route('staff.messages.inbox');
    })->name('staff.messages');
    Route::get('/messages/inbox', [MessageController::class, 'inbox'])->name('staff.messages.inbox');
    Route::get('/messages/outbox', [MessageController::class, 'outbox'])->name('staff.messages.outbox');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('staff.messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('staff.messages.store');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('staff.messages.show');
});


Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');
