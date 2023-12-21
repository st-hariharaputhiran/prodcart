<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_title',
        'product_description',
        'product_slug',
        'product_price',
        'product_status'
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function productOrders()
    {
        return $this->belongsToMany( ProductOrders::class, 'product_order_items', 'product_id', 'order_id' )->withPivot('price','quantity');
    }

}
