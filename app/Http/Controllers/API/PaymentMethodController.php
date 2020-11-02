<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    public function index(){
        $paymentMethod = PaymentMethod::orderBY('name')->get();

        return response()->json($paymentMethod);
    }
}
