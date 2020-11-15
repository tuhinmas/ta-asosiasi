<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use App\Models\Transaksi_detail;

class PDFReportController extends Controller
{
    public function transaksi(){
        $month = Carbon::now();
        $data = Transaksi_detail::with('customers','user')
                                ->whereMonth('created_at', Carbon::now()->month)
                                // ->whereYear('created_at', Carbon::now()->year)
                                ->take(20)
                                ->orderBy('created_at','desc')
                                ->get();
        $total = Transaksi_detail::whereMonth('created_at',Carbon::now()->month)
                                ->orderBy('created_at')
                                ->sum('total');
        $totalQTY = Transaksi_detail::whereMonth('created_at',Carbon::now()->month)
                                ->orderBy('created_at')
                                ->sum('jumlah_item');
        $sub = Transaksi_detail::whereMonth('created_at',Carbon::now()->month)
                                ->orderBy('created_at')
                                ->sum('sub_total');
        // dd($data);
        $pdf = PDF::loadView('report.transaksi_pdf', compact('data','month','total','totalQTY','sub'));
        return $pdf->download('transaksi.pdf');
    }
}
