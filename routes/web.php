<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/{id}', [ClientController::class, 'showDetails'])->name('clients.show');
Route::get('/client/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');

Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
Route::get('/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');


// Route for listing invoices
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');

// Route for displaying the invoice creation form
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');

// Route for storing a newly created invoice
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
