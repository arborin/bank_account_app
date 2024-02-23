<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.list', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required|max:255',
            "email" => ['required', 'max:255', Rule::unique('users', 'email')],
            "password" => 'required|max:255',
        ]);

        // dd($request->toArray());
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with(['message' => "Record Added", 'status' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $rules = [
            "name" => 'required|min:4|max:255',
            "email" => ['required', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ];

        if ($request->password) {
            $rules['password'] = "min:8|max|20";
            $user["password"] = bcrypt($request->password);
        }

        $validated = $request->validate($rules);

        $user["name"] = $request->name;
        $user["email"] = $request->email;
        $user->save();
        return redirect()->route('users.index')->with(['message' => "Record Added", 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delUser(Request $request)
    {
        $id = $request->record_id;
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with(['message' => 'Record deleted', 'status' => 'success']);
    }
}
