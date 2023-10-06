<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\sidebar\SidebarController;
use App\Http\Controllers\store\StoreController;
use App\Http\Controllers\store\StoreProductController;
use App\Http\Controllers\user\UserController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware Role Administrator
Route::middleware(['auth', 'checkAdmin'])->group(function () {
    Route::get('/inventory', [SidebarController::class, 'inventoryManagementIndex'])->name('inventory.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('product/edit/${id}', [ProductController::class, 'update'])->name('product.edit');
    Route::get('status/product/{id}', [StoreProductController::class, 'changeStatus'])->name('status.product');
    Route::post('/images', [ImageController::class, 'store'])->name('images');
    Route::get('/collaborators', [SidebarController::class, 'manageCollaboratorsIndex'])->name('collaborators.index');
    Route::get('collaborator/create', [UserController::class, 'createCollaborator'])->name('collaborator.create');
});

// Middleware Role Kairapp
Route::middleware(['auth', 'checkAdminKairapp'])->group(function () {
    Route::get('/stores/management', [SidebarController::class, 'storesManagementIndex'])->name('stores-management.index');
    Route::get('store/create', [StoreController::class, 'createStore'])->name('store.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/change/password', [PasswordController::class, 'changePasswordAuthIndex'])->name('change-password.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'selectedStore'])->group(function () {
    Route::get('/stores', [UserController::class, 'userStores'])->middleware(['auth', 'verified'])->name('stores');
    Route::get('/stores/{id}', [StoreController::class, 'index'])->name('store.index');
});

require __DIR__.'/auth.php';
