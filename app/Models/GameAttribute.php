<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameAttribute extends Model
{
    protected $fillable = [
        'product_id',
        'field_name',
        'field_type',
        'options',
        'sort_order',
        'is_required'
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}