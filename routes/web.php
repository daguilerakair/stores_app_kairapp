<?php

use App\Http\Controllers\auth\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\sidebar\SidebarController;
use App\Http\Controllers\store\StoreController;
use App\Http\Controllers\store\StoreProductController;
use App\Http\Controllers\SubStoreController;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'checkStore'])->name('dashboard');

// Middleware Role Administrator Store and Administrator SubStore
Route::middleware(['auth', 'checkAdmin', 'checkStore'])->group(function () {
    Route::get('/sucursals', [SubStoreController::class, 'obtainSubStores']);
    Route::get('/inventory', [SidebarController::class, 'inventoryManagementIndex'])->name('inventory.index');
    Route::get('/inventory/${id}', [SidebarController::class, 'inventoryManagementIndexSelected'])->name('inventory-selected.index');
    Route::get('product/create/${subStore}', [ProductController::class, 'create'])->name('product.create');
    Route::get('product/edit/${id}', [ProductController::class, 'update'])->name('product.edit');
    Route::get('status/product/{id}', [StoreProductController::class, 'changeStatus'])->name('status.product');
    Route::post('/images', [ImageController::class, 'store'])->name('images');
    Route::get('/collaborators', [SidebarController::class, 'manageCollaboratorsIndex'])->name('collaborators.index');
    Route::get('collaborator/create', [UserController::class, 'createCollaborator'])->name('collaborator.create');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
});

// Route::middleware(['auth', 'checkAdminSubStore', 'checkStore'])->group(function () {
//     Route::get('/inventory', [SidebarController::class, 'inventoryManagementIndex'])->name('inventory.index');
//     Route::get('/inventory/${id}', [SidebarController::class, 'inventoryManagementIndexSelected'])->name('inventory-selected.index');
//     Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
//     Route::get('product/edit/${id}', [ProductController::class, 'update'])->name('product.edit');
//     Route::get('status/product/{id}', [StoreProductController::class, 'changeStatus'])->name('status.product');
//     Route::post('/images', [ImageController::class, 'store'])->name('images');
//     Route::get('/collaborators', [SidebarController::class, 'manageCollaboratorsIndex'])->name('collaborators.index');
//     Route::get('collaborator/create', [UserController::class, 'createCollaborator'])->name('collaborator.create');
//     Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
// });

// Middleware Role Administrator Kairapp
Route::middleware(['auth', 'checkAdminKairapp'])->group(function () {
    // Routes Management Stores
    Route::get('/stores/management', [SidebarController::class, 'storesManagementIndex'])->name('stores-management.index');
    Route::get('store/create', [StoreController::class, 'createStore'])->name('store.create');
    Route::get('subStore/create/${id}', [StoreController::class, 'createSubStore'])->name('subStore.create');
    Route::get('subStore/edit/${id}', [SubStoreController::class, 'update'])->name('subStore.edit');
    Route::get('store/sucursals/${id}', [StoreController::class, 'sucursalsIndex'])->name('store.sucursals.index');
    Route::get('wizard', function () {
        return view('sidebarScreens.storesManagement.store.create');
    });
    // Routes Management Orders
    Route::get('/orders/management', [SidebarController::class, 'ordersManagementIndex'])->name('orders-management.index');
    Route::get('order/create', [OrderController::class, 'createOrder'])->name('order.create');

    Route::get('/get/stores', [StoreController::class, 'obtainStores']);
});

// Middleware Role Administrator SubStore

// Comun Routes
Route::middleware('auth', 'checkStore')->group(function () {
    Route::get('/change/password', [PasswordController::class, 'changePasswordAuthIndex'])->name('change-password.index');
    Route::get('/support', [SidebarController::class, 'supportIndex'])->name('support.index');
});

Route::middleware(['auth', 'selectedStore'])->group(function () {
    Route::get('/stores', [UserController::class, 'userStores'])->middleware(['auth', 'verified'])->name('stores');
    Route::get('/stores/{id}', [StoreController::class, 'index'])->name('store.index');
});

require __DIR__.'/auth.php';
