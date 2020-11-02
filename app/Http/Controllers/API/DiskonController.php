<?php

namespace App\Http\Controllers\API;

use App\Models\Diskon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\DiskonRequest;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        // $diskon = Product::join('diskon','diskon.product_id','=','products.id','left outer')
        //                 ->select('products.*','diskon.diskon')
        //                 ->where('product_name','like','%'.$request->search.'%')
        //                 // ->orWhere('products.product_id','like','%'.$request->search.'%')
        //                 ->where('diskon')
        //                 ->orderBy('product_name')
        //                 ->limit(7)
        //                 ->get();
        $diskon = Diskon::join('products','products.id','=','diskon.product_id')
                        ->select('diskon.*','products.product_name','products.product_id as p_id')
                        ->where('product_name','like','%'.$request->search.'%')
                        ->orderBy('product_name','asc')
                        ->paginate(20);
        return response()->json($diskon);
    }

    public function search(Request $request){
        $product = Product::join('diskon','diskon.product_id','=','products.id','left outer')
                        ->select('products.*','diskon.diskon')
                        ->where('product_name','like','%'.$request->search.'%')
                        // ->where('products.product_id','like','%'.$request->search.'%')
                        ->where('diskon')
                        ->limit(7)
                        ->orderBy('product_name')
                        ->get();
        
        // $product = Product::join('diskon','products.id','=','diskon.product_id','right outer')
        //                 ->select('products.*','diskon.product_id as p_id')
        //                 ->where('products.product_name','like','%'.$request->search.'%')
        //                 ->orWhere('products.product_id','like','%'.$request->search.'%')
        //                 ->limit(5)
        //                 ->orderBy('product_name','asc')
        //                 ->get();
        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiskonRequest $request)
    {
        $diskon = new Diskon;
        $diskon->product_id = $request->product_id;
        $diskon->diskon = $request->diskon;
        $diskon->save();

        return response()->json($diskon);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $diskon = Diskon::findOrFail($id);
        $this->validate($request, [
                'p_id' => 'required|string|max:30,'.$diskon->id,
                'product_name' => 'required|max:50',
                'diskon' => 'required|numeric|max:90',
            ]
        );

        $diskon->product_id = $request->product_id;
        $diskon->diskon = $request->diskon;
        $diskon->save();

        return response()->json($diskon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diskon = Diskon::findOrFail($id);
        $diskon->delete();
        return $diskon;
    }
}
