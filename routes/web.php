<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Public routes
Route::get('/', function () {
    return view('dashboard');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('store-user');
    
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login-user');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Clients
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('clients.index');
        Route::get('/{id}', [ClientController::class, 'showDetails'])->name('clients.show');
        Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
        Route::post('/', [ClientController::class, 'store'])->name('clients.store');
    });
    
    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
    });
    
    // Quotes
    Route::prefix('quotes')->group(function () {
        Route::get('/', [QuoteController::class, 'index'])->name('quotes.index');
        Route::get('/create', [QuoteController::class, 'create'])->name('quotes.create');
        Route::post('/', [QuoteController::class, 'store'])->name('quotes.store');
    });
    
    // Invoices
    Route::prefix('invoices')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/create', [InvoiceController::class, 'create'])->name('invoices.create');
        Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store');
        Route::get('/{id}/pdf', [InvoiceController::class, 'generatePdf'])->name('invoices.pdf');
    });
});


