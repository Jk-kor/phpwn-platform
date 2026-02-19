<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'challenge_id', 'price'];

    // 어떤 챌린지인지 연결
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    // 관계: 이 인보이스 아이템은 어떤 인보이스에 속하는가?
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}