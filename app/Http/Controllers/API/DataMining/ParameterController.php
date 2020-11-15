<?php

namespace App\Http\Controllers\API\DataMining;

use App\Models\Parameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParameterController extends Controller
{
    public function parameter(){
        $params = Parameter::orderBy('min_support')->get();

        return response()->json($params);
    }
}
