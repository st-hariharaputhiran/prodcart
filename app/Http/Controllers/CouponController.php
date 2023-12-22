<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Traits\RestControllerTrait;

class FOO extends Controller
{
    use RestControllerTrait;
}

class CouponController extends FOO
{
    public $modelClass = Coupon::class;

    protected function _selectLookups( $id = null ): array {
        $data = [];
        
        $data[ 'couponTypes' ] = $this->modelClass::$couponTypes;
        
        return $data;
    }

}
