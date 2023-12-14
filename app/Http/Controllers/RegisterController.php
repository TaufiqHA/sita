<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register', ['title' => 'Register']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userGoogle = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'email' => $userGoogle->getEmail()
        ], [
            'username' => $userGoogle->getName(),
            'nama' => $userGoogle->getName(),
            'email' => $userGoogle->getEmail(),
            'password' => $userGoogle->token,
            'role' => 'mahasiswa'
        ]);

        Auth::login($user);

        return redirect()->to('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:8',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ], [
            'email.unique' => 'email telah terdaftar',
            'email.required' => 'email tidak boleh dikosongkan',
            'username.required' => 'username tidak boleh dikosongkan',
            'username.min' => 'username minimal 8 karakter',
            'password.required' => 'password tidak boleh kosong',
            'password.min' => 'password minimal 8 karakter'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        User::create($validated);

        return redirect()->to('login')->with([
            'success' => 'Registrasi berhasil, silahkan login'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
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

    public function authGoogle() {
        return Socialite::driver('google')->redirect();
    }
}
