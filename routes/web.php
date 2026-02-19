<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChallengeController; // <-- 챌린지 컨트롤러 연결
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MyChallengeController;

// 1. 메인 화면
Route::get('/', [ChallengeController::class, 'index'])->name('home');

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

    // 장바구니 관련 라우트
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/my-challenges', [MyChallengeController::class, 'index'])->name('my.challenges');
});

// 이제 파일이 생성되었으므로 에러가 나지 않습니다.
require __DIR__.'/auth.php';