<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Middleware\RoleMiddleware;



// ============================================
// PUBLIC PAGES
// ============================================
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/services', 'services')->name('services');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ============================================
// POLICIES
// ============================================
Route::view('/privacy-policy', 'policies.privacy-policy')->name('privacy-policy');
Route::view('/our-rules', 'policies.our-rules')->name('our-rules');
Route::view('/terms-of-service', 'policies.terms-of-service')->name('terms-of-service');
Route::view('/refund-policy', 'policies.refund-policy')->name('refund-policy');

// ============================================
// USER AUTHENTICATION
// ============================================
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register/store', [UserController::class, 'store'])->name('register.store');
Route::get('/get-districts/{state}', [UserController::class, 'getDistricts']);
Route::get('/get-tehsils/{district}', [UserController::class, 'getTehsils']);

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.store');


// ============================================
// USER DASHBOARD (Protected)
// ============================================
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Payment - sirf 2 core routes: callback (Cashfree redirect yahin aata hai) + status pages
    Route::post('/payment/initiate', [PaymentController::class, 'initiate'])->name('payment.initiate');
    Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/my-contacts', [UserController::class, 'contacts'])->name('user.contacts');
    Route::get('/my-payments', [UserController::class, 'payments'])->name('user.payments');
    Route::get('/my-products', [UserController::class, 'products'])->name('user.products');

    // tickets
    Route::get('/support', [TicketController::class, 'index'])->name('ticket.index');
    Route::post('/support/store', [TicketController::class, 'store'])->name('ticket.store');
    Route::post('/support/reply/{id}', [TicketController::class, 'reply'])->name('ticket.reply');
    Route::get('/support/show/{id}', [TicketController::class, 'show'])->name('ticket.show');
    Route::get('/support/latest-messages/{ticket}', [TicketController::class, 'latestMessages']);
});


// ============================================
// ADMIN PANEL
// ============================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Users
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::post('/users/{id}/approve', [AdminController::class, 'approveUser'])->name('users.approve');
        Route::post('/users/{id}/reject', [AdminController::class, 'rejectUser'])->name('users.reject');
        Route::post('/users/{id}/block', [AdminController::class, 'blockUser'])->name('users.block');
        Route::post('/users/{id}/unblock', [AdminController::class, 'unblockUser'])->name('users.unblock');

        // Payments (temp + success)
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
        Route::get('/success/payments', [AdminController::class, 'successPayments'])->name('success.payments');
        Route::post('/payments/{id}/approve', [AdminController::class, 'approveTempPayment'])->name('payments.approve');
        Route::delete('/payments/{id}', [AdminController::class, 'deleteTempPayment'])->name('payments.delete');

        // Purchased products
        Route::get('/purchased-products', [AdminController::class, 'purchasedProducts'])->name('purchased-products');
        Route::post('/purchased-products/{id}/approve', [AdminController::class, 'approvePurchasedProduct'])->name('purchased-products.approve');

        // contact
        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/pending', [AdminContactController::class, 'pending'])->name('contacts.pending');
        Route::get('/contacts/replied', [AdminContactController::class, 'replied'])->name('contacts.replied');
        Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');
        Route::post('/contacts/{id}/reply', [AdminContactController::class, 'reply'])->name('contacts.reply');
        Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
        Route::post('/contacts/bulk-delete', [AdminContactController::class, 'bulkDelete'])->name('contacts.bulk-delete');
        Route::post('/contacts/{id}/mark-read', [AdminContactController::class, 'markAsRead'])->name('contacts.mark-read');
        Route::get('/contacts/export', [AdminContactController::class, 'export'])->name('contacts.export');

        // Tickets
        Route::get('/tickets', [TicketController::class, 'tickets'])->name('tickets');
        Route::get('/ticket/messages/{id}', [TicketController::class, 'ticketMessages'])->name('ticket.messages');
        Route::post('/tickets/reply/{id}', [TicketController::class, 'ticketReply'])->name('ticket.reply');
        Route::post('/tickets/reply-close/{id}', [TicketController::class, 'ticketReplyClose'])->name('ticket.reply.close');

        // logout
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
