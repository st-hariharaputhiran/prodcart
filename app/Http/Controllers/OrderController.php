<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductOrders;
use App\Traits\RestControllerTrait;

class FOO extends Controller
{
    use RestControllerTrait;
}

class OrderController extends FOO
{
    public $modelClass = ProductOrders::class;
}
