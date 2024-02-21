<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Payment;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment.list', [
            "payments" => Payment::orderBy('id', 'desc')->get()
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
            'date' => [
                'required',
                // 'date'
            ],
        ]);

        $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        $payment = Payment::create([
            'date' => $date,
            'status' => 'not_paid'
        ]);

        return redirect()->route('payments.edit', ['payment' => $payment->id]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $existing_accounts = PaymentTransaction::select('account_id')
            ->where('payment_id', $payment->id)
            ->pluck('account_id');

        $accounts = Account::where('status', 'active')
            ->when(!empty($existing_accounts), function ($query) use ($existing_accounts) {
                return $query->whereNotIn('id', $existing_accounts);
            })
            ->orderBy('account_name')
            ->get();


        return view('payment.edit', [
            'payment' => $payment,
            'accounts' => $accounts
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
    public function delPayment(Request $request)
    {

        $id = $request->record_id;
        $transaction = Payment::findOrFail($id);
        $transaction->delete();

        // CLEAR TRANSACTIONS TOO
        PaymentTransaction::where('payment_id', $id)->delete();

        return redirect()->back()->with(['message' => 'Record deleted', 'status' => 'success']);
    }

    public function addTransaction(Request $request)
    {
        // CHECK IF ACOUNT ALLREADY EXISTS
        $transaction = PaymentTransaction::where('account_id', $request->account_id)
            ->where('payment_id', $request->payment_id)
            ->first();


        if ($transaction == null) {
            PaymentTransaction::create([
                'account_id' => $request->account_id,
                'payment_id' => $request->payment_id,
                'amount' => $request->amount,
            ]);
            $message = ['message' => 'Account add', 'status' => 'success'];
        } else {
            // The result is not empty
            $message = ['message' => 'Account exists', 'status' => 'error'];
        }


        return redirect()->back()->with($message);
    }

    public function delTransaction(Request $request)
    {
        $id = $request->record_id;
        $transaction = PaymentTransaction::findOrFail($id);
        $transaction->delete();

        return redirect()->back()->with(['message' => 'Record deleted', 'status' => 'success']);
    }


    public function setPaymentStatus(Request $request)
    {
        $payment_id = $request->payment_id;
        $status = $request->status;
        $payment = Payment::findOrFail($payment_id);
        $payment['status'] = $status;
        $payment->save();

        return response()->json(['message' => 'Status set', 'status' => 'success']);
    }

    public function printTransactions($payment_id)
    {
        return view('print.payment', [
            'payment' => Payment::findOrFail($payment_id)
        ]);
    }
}
