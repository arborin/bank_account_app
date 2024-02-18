<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment.list', [
            "payments" => Payment::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->toArray());

        $validated = $request->validate([
            'date' => 'required|date',
        ]);

        Payment::create([
            'date' => Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d')
        ]);

        return redirect()->route('payments.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('payment.edit', [
            'payment' => $payment,
            'accounts' => Account::where('status', 'active')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
