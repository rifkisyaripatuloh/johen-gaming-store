<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountDelivery extends Model
{
    protected $fillable = [

        'product_id',
        'login_email',
        'login_password',
        'nickname',
        'is_sent'

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}