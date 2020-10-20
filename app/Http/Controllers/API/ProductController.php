<?php

namespace App\Http\Controllers\API;

use App\Models\Stok;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\API\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return new ProductResource(Product::where('product_name','LIKE',"%".$request->search."%")->orderBy('product_name')->paginate(20));

        $produk = Product::with('stok')
                           ->where('product_name','LIKE',"%".$request->search."%")
                           ->orderBy('product_name')
                           ->paginate(20);
        return response()->json($produk);
        // return $data;
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

    public function store(ProductRequest $request)
    {
        // $product = Product::create([
        //     'product_id' => $request->product_id,
        //     'product_name' => $request->product_name,
        //     'harga' => $request->harga,
        //     'merk' => $request->merk,
        // ]);
        // dd($request->all());
        $product = new Product;
        $product->product_id = $request->product_id;
        $product->product_name = $request->product_name;
        $product->harga = $request->harga;
        $product->merk = $request->merk;
        $product->save();

        // $stok = Stok::create([
        //     'product_id' =>$product->id,
        //     'stok' => $request->stok,
        // ]);

        // dd($product->id);
        $stok = new Stok;
        // $stok->product_id = $request->id;
        $stok->stok = $request->jml;
        // $stok->save();
        $product->stok()->save($stok);

        
        return response()->json([
            "product" => $product,
            "stok" => $stok
            
        ]);
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
        $product = Product::findOrFail($id);
        $stok = Stok::findOrFail($product->stok->id);
        // dd($stok);
        $this->validate($request, [
            'product_id' => 'required|max:50|unique:products,product_id,'.$product->id,
            'product_name' => 'required|max:50',
            'harga' => 'required|numeric|max:5000000',
            'merk' => 'required|string|max:100',
            'jml' => 'required|numeric|max:500'
            ]
        );

        $product->product_id = $request->product_id;
        $product->product_name = $request->product_name;
        $product->harga = $request->harga;
        $product->merk = $request->merk;
        $product->save();

        $stok->stok = $request->jml;
        $stok->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        return $product;

    }
}
