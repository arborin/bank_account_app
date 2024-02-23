<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function info()
    {
        $payments = Payment::with('transactions')->where('date', Carbon::today())->get();

        $transactionsSum = $payments->pluck('transactions.*.amount')->flatten()->sum();
        $transactionsCount = $payments->pluck('transactions.*.amount')->flatten()->count();

        return view('dashboard.dashboard', [
            'today_payment' => $transactionsSum,
            'today_transactions' => $transactionsCount
        ]);
    }
}
