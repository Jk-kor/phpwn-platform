<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChallengeController; // <-- 챌린지 컨트롤러 연결
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MyChallengeController;

// 1. 메인 화면
Route::get('/', [ChallengeController::class, 'index'])->name('home');

// Page de détails d'un challenge
Route::get('/challenges/{id}', [ChallengeController::class, 'show'])->name('challenges.show');

// 2. 대시보드
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. 로그인한 사람만 가능한 기능들
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 챌린지 등록 기능
    Route::get('/sell', [ChallengeController::class, 'create'])->name('challenges.create');
    Route::post('/sell', [ChallengeController::class, 'store'])->name('challenges.store');
    // Edit / Update / Delete (only author)
    Route::get('/challenges/{id}/edit', [\App\Http\Controllers\ChallengeController::class, 'edit'])->name('challenges.edit');
    Route::patch('/challenges/{id}', [\App\Http\Controllers\ChallengeController::class, 'update'])->name('challenges.update');
    Route::delete('/challenges/{id}', [\App\Http\Controllers\ChallengeController::class, 'destroy'])->name('challenges.destroy');

    // 장바구니 관련 라우트
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

    // Historique des achats
    Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices.index');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/my-challenges', [MyChallengeController::class, 'index'])->name('my.challenges');
    
    // Téléchargement sécurisé et soumission de flag
    Route::get('/challenges/{id}/download', [\App\Http\Controllers\ChallengeController::class, 'download'])->name('challenges.download');
    Route::post('/challenges/{id}/submit-flag', [\App\Http\Controllers\ChallengeController::class, 'submitFlag'])->middleware('throttle:10,1')->name('challenges.submitFlag');

    // Liste des achats (challenges achetés)
    Route::get('/purchases', [\App\Http\Controllers\PurchaseController::class, 'index'])->name('purchases.index');
});

// 이제 파일이 생성되었으므로 에러가 나지 않습니다.
require __DIR__.'/auth.php';

// Admin routes (liste des utilisateurs & gestion des challenges)
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/users/{user}/toggle-ban', [AdminController::class, 'toggleBan'])->name('admin.users.toggleBan');
    Route::post('/admin/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('admin.users.toggleAdmin');
    Route::post('/admin/challenges/{challenge}/toggle-active', [AdminController::class, 'toggleChallenge'])->name('admin.challenges.toggleActive');
});