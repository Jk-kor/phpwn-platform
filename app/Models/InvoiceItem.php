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
}