<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrderItems extends Model
{
    use HasFactory;
    protected $table = 'product_orders';

    protected $fillable = [
        'product_id',
        'order_id',
        'price',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function order()
    {
        return $this->belongsTo(ProductOrders::class,'order_id','id');
    }
}
