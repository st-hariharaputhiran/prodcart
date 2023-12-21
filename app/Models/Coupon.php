<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'coupon_title',
        'coupon_code',
        'coupon_type',
        'discount_amount',
        'start_at',
        'expire_at'
    ];

    public static $couponTypes = [
        'fixed' => 'Fixed',
        'percent' => 'Percent',
    ];

    public function users()
    {
        return $this->belongsToMany( User::class, 'coupon_user', 'coupon_id', 'user_id');
    }
}
