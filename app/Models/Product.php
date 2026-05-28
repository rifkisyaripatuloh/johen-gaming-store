<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProductPackage;
use App\Models\GameAttribute;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'thumbnail',
        'price',
        'stock',
        'type',
        'status',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function packages()
    {
        return $this->hasMany(ProductPackage::class);
    }

    // 🔥 TAMBAHKAN INI
    public function attributes()
    {
        return $this->hasMany(GameAttribute::class);
    }

    public function accounts()
{
    return $this->hasMany(AccountDelivery::class);
}
}