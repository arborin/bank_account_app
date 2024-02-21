<?php

namespace App\Http\Controllers;

use App\Exports\IbPaymentExport;
use App\Exports\KbPaymentExport;
use App\Models\Payment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportPaymentController extends Controller
{
    public function export($payment_id)
    {
        // IB788-HHMM-DDMMYY
        // KB005-HHMM-DDMMYY

        $payment = Payment::findOrFail($payment_id);
        $status = $payment->status; //paid_ib paid_kb

        $file_name = date('-dmY') . ".xlsx";
        // $file_name = str_replace(' ', '', $file_name);

        if ($status == 'paid_ib') {
            $file_name = "IDFC" . $file_name;
            return Excel::download(new IbPaymentExport($payment_id), $file_name);
        }
        if ($status == 'paid_kb') {
            $file_name = "KMB-RERA" . $file_name;
            return Excel::download(new KbPaymentExport($payment_id), $file_name);
        }

        if ($status == 'paid_kb_main') {
            $file_name = "KMB-MAIN" . $file_name;
            return Excel::download(new KbPaymentExport($payment_id), $file_name);
        }

        return redirect()->back()->with(['message' => "Payment status not set!", 'status' => 'error']);
    }
}
