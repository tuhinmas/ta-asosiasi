<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use App\Models\Transaksi_detail;

class PDFReportController extends Controller
{
    public function transaksi(Request $request){
        // $month = Carbon::now();
        $awal = $request->first;
        $akhir = $request->end;
        $data = Transaksi_detail::with('customers','user')
                                ->whereBetween('created_at',[$awal, $akhir])
                                // ->whereMonth('created_at', Carbon::now()->month)
                                // ->whereYear('created_at', Carbon::now()->year)
                                // ->take(20)
                                ->orderBy('created_at','desc')
                                ->get();
        $total = Transaksi_detail::whereBetween('created_at',[$awal, $akhir])
                                // whereMonth('created_at',Carbon::now()->month)
                                ->orderBy('created_at')
                                ->sum('total');
        $totalQTY = Transaksi_detail::whereBetween('created_at',[$awal, $akhir])
        // whereMonth('created_at',Carbon::now()->month)
                                ->orderBy('created_at')
                                ->sum('jumlah_item');
        $sub = Transaksi_detail::whereBetween('created_at',[$awal, $akhir])
        // whereMonth('created_at',Carbon::now()->month)
                                ->orderBy('created_at')
                                ->sum('sub_total');
        // dd($awal);
        // $pdf = PDF::loadView('report.transaksi_pdf', compact('awal','akhir'));

        // $date_awal = $awal->format('d-M-Y');
        $pdf = PDF::loadView('report.transaksi_pdf', compact('data','awal','akhir','total','totalQTY','sub'));
        return $pdf->download('transaksi.pdf');

        // return response()->json([
        //     'tgl' => $awal,
        //     'tgl_2' => $akhir
        //     ]
        // );
        // return response()->json([
        //     'data' => $data,
        //     'awal' => $awal,
        //     'akhir' =>$akhir,
        //     'toatl' => $total,
        //     'totalQty' => $totalQTY,
        //     'sub' => $sub,
        // ]);
    }
}
