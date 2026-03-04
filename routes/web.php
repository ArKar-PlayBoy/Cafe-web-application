<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\OrderExportController;
use App\Http\Controllers\Admin\StockController as AdminStockController;
use App\Http\Controllers\Admin\TableController as AdminTableController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Staff\AuthController as StaffAuthController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\OrderController as StaffOrderController;
use App\Http\Controllers\Staff\ReservationController as StaffReservationController;
use App\Http\Controllers\Staff\StockController as StaffStockController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsStaff;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Stripe webhook - NO auth, but signature-verified inside the controller
Route::post('/webhook/stripe', [CheckoutController::class, 'handleWebhook'])->name('webhook.stripe');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('customer.dashboard'))->name('dashboard');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{menuItem}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    // Payment verification MUST be auth-protected (IDOR prevention)
    Route::get('/checkout/verify', [CheckoutController::class, 'verifyPayment'])->name('checkout.verify');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/upload-payment', [OrderController::class, 'uploadPayment'])->name('orders.upload-payment');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('menu', AdminMenuController::class);
        Route::resource('tables', AdminTableController::class);
        Route::resource('users', AdminUserController::class)->except(['show']);
        Route::post('/users/{user}/ban', [AdminUserController::class, 'ban'])->name('users.ban');
        Route::post('/users/{user}/unban', [AdminUserController::class, 'unban'])->name('users.unban');
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
        Route::get('/orders/export/all', [OrderExportController::class, 'exportAllCsv'])->name('orders.export-all');
        Route::get('/orders/{order}/export', [OrderExportController::class, 'exportCsv'])->name('orders.export');
        Route::post('/orders/{order}/verify-payment', [AdminOrderController::class, 'verifyPayment'])->name('orders.verify-payment');
        Route::post('/orders/{order}/reject-payment', [AdminOrderController::class, 'rejectPayment'])->name('orders.reject-payment');

        Route::get('/stock', [AdminStockController::class, 'index'])->name('stock.index');
        Route::get('/stock/create', [AdminStockController::class, 'create'])->name('stock.create');
        Route::post('/stock', [AdminStockController::class, 'store'])->name('stock.store');
        Route::get('/stock/{stock}/edit', [AdminStockController::class, 'edit'])->name('stock.edit');
        Route::put('/stock/{stock}', [AdminStockController::class, 'update'])->name('stock.update');
        Route::delete('/stock/{stock}', [AdminStockController::class, 'destroy'])->name('stock.destroy');
        Route::get('/stock/{stock}/movements', [AdminStockController::class, 'movements'])->name('stock.movements');
        Route::get('/stock/{stock}/recipe', [AdminStockController::class, 'recipe'])->name('stock.recipe');
        Route::post('/stock/{stock}/recipe', [AdminStockController::class, 'updateRecipe'])->name('stock.recipe.update');
        Route::post('/stock/{stock}/add', [AdminStockController::class, 'addStock'])->name('stock.add');
        Route::post('/stock/{stock}/adjust', [AdminStockController::class, 'adjustStock'])->name('stock.adjust');
        Route::get('/stock/batches', [AdminStockController::class, 'batches'])->name('stock.batches');
        Route::get('/stock/alerts', [AdminStockController::class, 'alerts'])->name('stock.alerts');
        Route::post('/stock/alerts/{alert}/read', [AdminStockController::class, 'markAlertRead'])->name('stock.alerts.read');
        Route::get('/stock/expiring', [AdminStockController::class, 'expiring'])->name('stock.expiring');
    });
});

Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('/login', [StaffAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [StaffAuthController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware(EnsureUserIsStaff::class)->group(function () {
        Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
        Route::get('/orders', [StaffOrderController::class, 'index'])->name('orders');
        Route::put('/orders/{order}/status', [StaffOrderController::class, 'updateStatus'])->name('orders.status');
        Route::post('/orders/{order}/reject', [StaffOrderController::class, 'reject'])->name('orders.reject');
        Route::post('/orders/{order}/verify-payment', [StaffOrderController::class, 'verifyPayment'])->name('orders.verify-payment');
        Route::post('/orders/{order}/reject-payment', [StaffOrderController::class, 'rejectPayment'])->name('orders.reject-payment');
        Route::get('/reservations', [StaffReservationController::class, 'index'])->name('reservations');
        Route::put('/reservations/{reservation}/status', [StaffReservationController::class, 'updateStatus'])->name('reservations.status');

        Route::get('/stock', [StaffStockController::class, 'index'])->name('stock.index');
        Route::get('/stock/{stock}/in', [StaffStockController::class, 'addStockForm'])->name('stock.in.form');
        Route::post('/stock/{stock}/in', [StaffStockController::class, 'addStock'])->name('stock.in');
        Route::get('/stock/{stock}/waste', [StaffStockController::class, 'wasteForm'])->name('stock.waste.form');
        Route::post('/stock/{stock}/waste', [StaffStockController::class, 'logWaste'])->name('stock.waste');
        Route::get('/stock/{stock}/adjust', [StaffStockController::class, 'adjustForm'])->name('stock.adjust.form');
        Route::post('/stock/{stock}/adjust', [StaffStockController::class, 'adjustStock'])->name('stock.adjust');
        Route::get('/stock/alerts', [StaffStockController::class, 'alerts'])->name('stock.alerts');
    });
});

require __DIR__.'/auth.php';
