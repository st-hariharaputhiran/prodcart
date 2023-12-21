<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrders extends Model
{
    use HasFactory;

    protected $table = 'product_orders';

    protected $fillable = [
        'user_id',
        'subtotal',
        'discount',
        'total',
        'firstname',
        'lastname',
        'mobile',
        'email',
        'line1',
        'line2',
        'city',
        'zipcode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        //return $this->hasMany(ProductOrderItems::class,'order_id','id');
        return $this->belongsToMany( Product::class, 'product_order_items', 'order_id', 'product_id' )->withPivot('price','quantity');
    }

    public function productImages()
    {
        $this->products->productImages();
    }

}
