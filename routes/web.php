<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

// Serve static files explicitly
Route::group(['prefix' => ''], function () {
    Route::get('/css/{file}', function ($file) {
        $path = public_path('css/' . $file);
        if (file_exists($path)) {
            return response()->file($path)->header('Content-Type', 'text/css');
        }
        abort(404);
    });

    Route::get('/js/{file}', function ($file) {
        $path = public_path('js/' . $file);
        if (file_exists($path)) {
            return response()->file($path)->header('Content-Type', 'application/javascript');
        }
        abort(404);
    });

    Route::get('/assets/{path}', function ($path) {
        $file = public_path('assets/' . $path);
        if (file_exists($file)) {
            return response()->file($file);
        }
        abort(404);
    })->where('path', '.*');

    Route::get('/images/{path}', function ($path) {
        $file = public_path('images/' . $path);
        if (file_exists($file)) {
            return response()->file($file);
        }
        abort(404);
    })->where('path', '.*');
});

// Public routes (website pages)
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/blog-post', function () {
    return view('blog-post');
})->name('blog.post');

Route::get('/blog-home', function () {
    return view('blog-home');
})->name('blog.home');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/portfolio-item', function () {
    return view('portfolio-item');
})->name('portfolio.item');

Route::get('/portfolio-overview', function () {
    return view('portfolio-overview');
})->name('portfolio.overview');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])
                ->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    // Profile routes accessible to all authenticated users
    Route::get('profile', [ProfileController::class, 'edit'])
                ->name('profile.edit');

    Route::patch('profile', [ProfileController::class, 'update'])
                ->name('profile.update');

    Route::delete('profile', [ProfileController::class, 'destroy'])
                ->name('profile.destroy');
});

// Admin routes (only accessible to admin users)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Blog management routes
    Route::resource('categories', CategoryController::class, ['as' => 'admin']);
    Route::resource('posts', PostController::class, ['as' => 'admin']);
    Route::resource('tags', TagController::class, ['as' => 'admin']);
});