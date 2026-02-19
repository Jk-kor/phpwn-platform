<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'total_amount', 'status', 'billing_address', 'billing_city', 'billing_zip'];

    // 영수증에 포함된 아이템들과의 관계 설정
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}