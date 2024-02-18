<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

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
        // dd($request->toArray());
        Account::create([
            "account_name" => $request->account_name,
            "account_number" => $request->account_number,
            "bank_name" => $request->bank_name,
            "ifsc_code" => $request->ifsc_code,
            "group" => $request->group,
            "status" => $request->status
        ]);

        return redirect()->route('accounts.index');
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
    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->back();
    }
}
