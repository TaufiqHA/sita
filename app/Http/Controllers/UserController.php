<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if(auth()->user()->avatar) {
            $avatar = asset('storage/' . auth()->user()->avatar);
        } else {
            $avatar = asset('img/user1.png');
        }

        $data = $user;

        return view('user.index', ['title' => 'Pengaturan Akun', 'data' => $user, 'avatar' => $avatar, 'data' => $data ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
            'avatar' => [
                ' nullable ',
                File::types(['jpg', 'jpeg', 'png'])
            ]
            ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $validated = $validator->validated();

        if($request->file('avatar'))
        {
            $validated['avatar'] = $request->file('avatar')->store('image');
        }

        User::where('id', $user->id)->update($validated);

        return back()->with([
            'success' => 'Data berhasil diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
