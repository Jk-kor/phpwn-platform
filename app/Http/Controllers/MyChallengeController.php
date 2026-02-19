<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyChallengeController extends Controller
{
    // 내 구매 내역 보기
    public function index()
    {
        $userId = Auth::id();

        // [보안 핵심] 현재 로그인한 유저의 영수증에 담긴 아이템만 가져오기 (IDOR 방어)
        $purchases = InvoiceItem::whereHas('invoice', function($query) use ($userId) {
            $query->where('user_id', $userId)->where('status', 'completed');
        })->with('challenge')->get();

        return view('challenges.my', compact('purchases'));
    }
}