<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public $modelClass = Coupon::class;

    protected function _selectLookups( $id = null ): array {
        $data = [];
        
        $data[ 'couponTypes' ] = $this->modelClass::$couponTypes;
        
        return $data;
    }

}
