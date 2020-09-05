<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FronController extends Controller
{
    public function index()
    {
        return view('layouts.laravel-vue-js-crud-spa.blade');
    }
}
