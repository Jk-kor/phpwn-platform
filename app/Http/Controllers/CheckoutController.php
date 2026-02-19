<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $userId = Auth::id();

        try {
            // 트랜잭션 시작 (중간에 에러 나면 롤백)
            DB::beginTransaction();

            // [보안 핵심] lockForUpdate()를 사용하여 Race Condition 방어 (비관적 락)
            // 다른 결제 요청이 이 유저의 row에 접근하지 못하도록 잠금
            $user = User::where('id', $userId)->lockForUpdate()->first();
            
            // 장바구니 항목 가져오기
            $cartItems = Cart::where('user_id', $userId)->with('challenge')->get();

            if ($cartItems->isEmpty()) {
                DB::rollBack();
                return redirect()->route('cart.index')->with('error', '장바구니가 비어있습니다.');
            }

            // 총 결제 금액 계산
            $totalAmount = $cartItems->sum(function($item) {
                return $item->challenge->price * $item->quantity;
            });

            // 🌟 [보안 패치 완료] 잔고(Balance) 검증 및 차감 로직 활성화
            if ($user->balance < $totalAmount) {
                DB::rollBack();
                // 돈이 부족하면 여기서 트랜잭션을 엎고 에러 메시지와 함께 돌려보냅니다.
                return redirect()->route('cart.index')->with('error', '결제 실패: 잔고가 부족합니다. (현재 잔고: ' . number_format($user->balance, 2) . ' €)');
            }

            // 잔고가 충분하다면 돈을 깎고 저장합니다.
            $user->balance -= $totalAmount;
            $user->save();

            // 1. 영수증(Invoice) 본체 생성
            $invoice = Invoice::create([
                'user_id' => $userId,
                'total_amount' => $totalAmount,
                'status' => 'completed'
            ]);

            // 2. 영수증 상세 항목(InvoiceItem) 기록
            foreach ($cartItems as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'challenge_id' => $item->challenge_id,
                    'price' => $item->challenge->price // 구매 당시 가격 고정
                ]);
            }

            // 3. 결제 완료되었으므로 장바구니 비우기
            Cart::where('user_id', $userId)->delete();

            // 모든 작업이 성공하면 DB 반영
            DB::commit();

            return redirect()->route('home')->with('success', '결제가 완료되었습니다! (남은 잔고: ' . number_format($user->balance, 2) . ' €)');

        } catch (\Exception $e) {
            // 에러 발생 시 모든 DB 변경 사항 취소
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', '결제 처리 중 오류가 발생했습니다: ' . $e->getMessage());
        }
    }
}