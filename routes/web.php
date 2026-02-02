<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

Route::get('/', function () {
    return view('welcome');
})->name('home');



require __DIR__.'/settings.php';

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('dashboard');




Route::get('/report', function () {
    return view('admin.sales-report');
})->name('report');

Route::get('/payment', function () {
    return view('admin.payment');
})->name('payment');

// Route::get('/check', function () {
//     return view('check');
// })->name('check');

// Route::get('/check2', function () {
//     return view('check2');
// })->name('check2');


    Route::get('/products', [adminController::class, 'Products'])->name('products');
    Route::get('products/{id}', [adminController::class, 'productView'])->name('products.show');
    Route::get('/addProduct', [adminController::class, 'showAddProd'])->name('showAddProd');
  

Route::delete('/products/delete/{id}', [adminController::class, 'destroy'])->name('products.destroy');
Route::get('/pro/updshow/{id}', [adminController::class, 'showEdit'])->name('updateProduct');

Route::put('/products/update/{product}', [adminController::class, 'update'])->name('product.update');




     
Route::post('/admin/products', [adminController::class, 'store'])->name('addProduct');




