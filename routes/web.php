<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\TableController as AdminTableController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Staff\AuthController as StaffAuthController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\OrderController as StaffOrderController;
use App\Http\Controllers\Staff\ReservationController as StaffReservationController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsStaff;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('customer.dashboard'))->name('dashboard');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{menuItem}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    
    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('menu', AdminMenuController::class);
        Route::resource('tables', AdminTableController::class);
        Route::resource('users', AdminUserController::class);
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
    });
});

Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('/login', [StaffAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [StaffAuthController::class, 'login']);
    Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');
    
    Route::middleware(EnsureUserIsStaff::class)->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
        Route::get('/orders', [StaffOrderController::class, 'index'])->name('orders');
        Route::put('/orders/{order}/status', [StaffOrderController::class, 'updateStatus'])->name('orders.status');
        Route::get('/reservations', [StaffReservationController::class, 'index'])->name('reservations');
        Route::put('/reservations/{reservation}/status', [StaffReservationController::class, 'updateStatus'])->name('reservations.status');
    });
});

require __DIR__.'/auth.php';
