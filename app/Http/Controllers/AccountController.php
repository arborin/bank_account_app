<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('account.list', [
            'accounts' => Account::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "account_name" => 'required|max:255',
            "account_number" => ['required', 'max:255', Rule::unique('accounts', 'account_number')],
            "bank_name" => 'required|max:255',
            "ifsc_code" => 'required|max:255',
            "group" => 'required|max:255',
            "status" => 'required|max:255'
        ]);

        // dd($request->toArray());
        Account::create([
            "account_name" => $request->account_name,
            "account_number" => $request->account_number,
            "bank_name" => $request->bank_name,
            "ifsc_code" => $request->ifsc_code,
            "group" => $request->group,
            "status" => $request->status
        ]);

        return redirect()->route('accounts.index')->with(['message' => "Record Added", 'status' => 'success']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('account.edit', [
            'account' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $validated = $request->validate([
            "account_name" => 'required|max:255',
            "account_number" => ['required', 'max:255', Rule::unique('accounts', 'account_number')->ignore($account->id)],
            "bank_name" => 'required|max:255',
            "ifsc_code" => 'required|max:255',
            "group" => 'required|max:255',
            "status" => 'required|max:255'
        ]);

        $account["account_name"] = $request->account_name;
        $account["account_number"] = $request->account_number;
        $account["bank_name"] = $request->bank_name;
        $account["ifsc_code"] = $request->ifsc_code;
        $account["group"] = $request->group;
        $account["status"] = $request->status;

        $account->save();

        return redirect()->route('accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delAccount(Request $request)
    {
        $id = $request->record_id;
        $account = Account::findOrFail($id);

        $transactions = PaymentTransaction::where('account_id', $id)->get();

        if ($transactions) {
            $message = ['message' => 'Account has payments', 'status' => 'error'];
        } else {
            $account->delete();
            $message = ['message' => 'Account deleted', 'status' => 'success'];
        }



        return redirect()->back()->with($message);
    }

    public function accountInfo(Account $account)
    {
        return $account;
    }
}
