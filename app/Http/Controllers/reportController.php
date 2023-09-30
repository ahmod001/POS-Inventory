<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class reportController extends Controller
{
    // function reportPage(){
    //     return view('pages.auth.')
    // }

    function salesReport(Request $request)
    {
        $userId = $request->header('userId');
        $fromDate = date('y-m-d', strtotime($request->input('from')));
        $toDate = date('y-m-d', strtotime($request->input('to')));

        $invoice = Invoice::where('user_id', $userId)->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate);

        $total = $invoice->sum('total');
        $discount = $invoice->sum('discount');
        $vat = $invoice->sum('vat');
        $payable = $invoice->sum('payable');

        $invoiceList = $invoice->with('customer')->get();

        $data = [
            "fromDate" => $fromDate,
            "toDate" => $toDate,
            "total" => $total,
            "vat" => $vat,
            "payable" => $payable,
            "list" => $invoiceList
        ];

        $pdf = Pdf::loadView('pages.dashboard.sale-report', $data);
        return $pdf->download('report.pdf');
    }
}