<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\productCardsController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index']);



require __DIR__.'/settings.php';

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('dashboard');




Route::get('/report', function () {
    return view('admin.sales-report');
})->name('report');



// Route::get('/check', function () {
//     return view('check');
// })->name('check');

// Route::get('/check2', function () {
//     return view('check2');
// })->name('check2');


    Route::get('/products', [ProductController::class, 'Products'])->name('products');
    Route::get('products/{id}', [ProductController::class, 'productView'])->name('products.show');
    Route::get('/addProduct', [ProductController::class, 'showAddProd'])->name('showAddProd');
  

Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/pro/updshow/{id}', [ProductController::class, 'showEdit'])->name('updateProduct');

Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('product.update');

     
Route::post('/admin/products', [ProductController::class, 'store'])->name('addProduct');


Route::get('/cards', [productCardsController::class, 'cards'])
    ->name('cards');

// Users list page 
    Route::get('/users', [UserController::class, 'users'])
        ->name('users');

    // Show single user
    Route::get('/users/{id}', [UserController::class, 'show'])
        ->name('admin.users.show');

    // Edit user
    Route::get('/users/{id}/edit/show', [UserController::class, 'edit'])
        ->name('users.editShow');
 Route::put('/users/{id}/update', [UserController::class, 'update'])
        ->name('users.update');
    // Delete user
    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');


        Route::get('/product/{slug}', [ProductCardsController::class, 'show'])->name('product.show');
