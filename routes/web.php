<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Invoices
    Route::resource('invoice', InvoiceController::class);

    // Show add product route.
    Route::get('/invoice/{invoice}/add-products', [InvoiceController::class, 'addProducts'])->name('invoice.show.add-products');
    // Store products.
    Route::post('/invoice/{invoice}/add-products', [InvoiceController::class, 'storeProducts'])->name('invoice.store.products');
    // Delete product.
    Route::delete('/invoice/{invoice}/delete-product/{product}', [InvoiceController::class, 'deleteProduct'])->name('invoice.product.delete');

    // Generating PDF routes
    Route::get('/invoice/{invoice}/generate-pdf', [InvoiceController::class, 'generatePDF'])->name('invoice.generate.pdf');
});

require __DIR__.'/auth.php';
