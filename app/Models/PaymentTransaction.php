<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'payment_id',
        'amount'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
