<?php

use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\store\StoreController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\sidebar\SidebarController;
use App\Http\Controllers\store\StoreProductController;

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

Route::get('/stores', [UserController::class, 'userStores'])->middleware(['auth', 'verified'])->name('stores');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
});


// Middleware Role Administrator
Route::get('/inventory', [SidebarController::class, 'inventoryManagementIndex'])->name('inventory.index');
Route::get('/create-product', [ProductController::class, 'create'])->name('product.create');

Route::get('status/product/{id}', [StoreProductController::class, 'changeStatus'])->name('status.product');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/stores/{id}', [StoreController::class, 'index'])->name('store.index');
});




require __DIR__ . '/auth.php';
