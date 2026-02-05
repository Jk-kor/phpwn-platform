<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. 장바구니 화면 보여주기
    public function index()
    {
        $userId = Auth::id();
        
        // 내 장바구니 목록 가져오기 (상품 정보 포함)
        $cartItems = Cart::where('user_id', $userId)->with('challenge')->get();
        
        // 총 금액 계산
        $total = $cartItems->sum(function($item) {
            return $item->challenge->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // 2. 장바구니에 담기
    public function add($challengeId)
    {
        $userId = Auth::id();

        // 이미 담겨있는지 확인
        $exists = Cart::where('user_id', $userId)->where('challenge_id', $challengeId)->first();

        if ($exists) {
            // 이미 있으면 장바구니 화면으로 보내면서 에러 메시지
            return redirect()->route('cart.index')->with('error', 'Item is already in your cart.');
        }

        // DB에 저장
        Cart::create([
            'user_id' => $userId,
            'challenge_id' => $challengeId,
            'quantity' => 1
        ]);

        // 저장 후 장바구니 화면으로 이동
        return redirect()->back()->with('show_cart_modal', true);
    } // <--- 여기가 빠져있어서 에러가 났었습니다!

    // 3. 장바구니에서 삭제하기
    public function remove($cartId)
    {
        // 내 장바구니의 아이템인지 확인하고 삭제
        $cartItem = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Item removed.');
    }
}