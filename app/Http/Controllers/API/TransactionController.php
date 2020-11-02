<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Diskon;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Transaksi_detail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function search (Request $request){
        $products = Product::with(['diskon','stok'])
                            ->where('product_name','LIKE','%'.$request->search.'%')
                            ->orWhere('product_id','LIKE','%'.$request->search.'%')
                            ->orderBy('product_name','ASC')
                            ->limit(5)
                            ->get();

        return response()->json($products);
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
    public function store(Request $request)
    {
        $transaksi_detail_invoice = Transaksi_detail::latest()->first();
        $nomor_invoice = explode('/',$transaksi_detail_invoice->invoice);
        $invoice = $nomor_invoice[0]+1;
        $current = Carbon::now();

        $cart = $request->cart;
        $disc = 0;
        $subtotal = 0;
        // dd($cart);
        foreach($cart as $data_cart){
            $quantity = $data_cart['quantity'];
            $ppn = $data_cart['ppn'];
            $ppnnya = ($data_cart['realPrice'] * $ppn/100);
            $realPrice = $data_cart['realPrice'] + $ppnnya;
            $diskon_cart = $data_cart['disc'];
            $subtotal += $realPrice * $quantity;
            $disc += $quantity * $diskon_cart;

            $transaksi = new Transaksi;
            $transaksi->invoice = $invoice.'/KSR/UTM/'.$current->month.$current->format('y');
            $transaksi->product_id = $data_cart['id'];
            $transaksi->product_name = $data_cart['product_name'];
            $transaksi->qty = $quantity;
            $transaksi->save();

        }        
        $jumlah_item = Transaksi::where('invoice',$transaksi->invoice)
                                ->sum('qty');

        // $sub_total = Transaksi::join('products','products.id','=','transaksi.product_id')
        //                 ->select('transaksi.*','products.*')
        //                 // ->where('transaksi.invoice',$transaksi->invoice)->get();
        //                 ->sum(\DB::raw('transaksi.qty * (products.harga + (products.harga*(products.ppn/100)))'));
        
        // $diskon = Diskon::join('transaksi','diskon.product_id','=','transaksi.product_id')
                        // ->join('products','diskon.product_id','=','products.id')
                        // ->sum(\DB::raw('products.harga - ( products.harga * (diskon.diskon / 100))'));
                        // ->get();
        // dd($sub);
        $transaksi_detail = new Transaksi_detail;
        $transaksi_detail->user_id = Auth::id();
        $transaksi_detail->customer_id = $request->customer;
        $transaksi_detail->invoice = $transaksi->invoice;
        $transaksi_detail->jumlah_item = $jumlah_item;
        $transaksi_detail->payment_method = $request->payment_method;
        $transaksi_detail->sub_total = $subtotal;
        $transaksi_detail->diskon = $disc;
        $transaksi_detail->total = $request->total;
        $transaksi_detail->save();
        // return response()->json($transaksi_detail_invoice);
        return response()->json([
            'status' => true,
            'message' => 'ok',
            'tr' => $transaksi_detail
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
