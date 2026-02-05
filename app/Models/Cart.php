<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // 대량 할당 허용 (이걸 안 하면 저장할 때 에러 남)
    protected $fillable = ['user_id', 'challenge_id', 'quantity'];

    // 관계 설정 1: 이 장바구니 아이템은 어떤 '상품(Challenge)'인가?
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    // 관계 설정 2: 이 장바구니는 어떤 '유저(User)'의 것인가?
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}