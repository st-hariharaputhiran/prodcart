<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductOrders;

class OrderController extends Controller
{
    public $modelClass = ProductOrders::class;
}
