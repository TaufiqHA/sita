<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->avatar) {
            $avatar = asset('storage/' . auth()->user()->avatar);
        } else {
            $avatar = asset('img/user1.png');
        }

        return view('mahasiswa.dashboard', ['title' => 'Mahasiswa', 'avatar' => $avatar]);
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'required',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'angkatan' => 'required',
            'alamat' => 'required',
            'pembimbing_akademik' => 'required',
            'tanggal_TA' => 'required',
            'jumlah_surah' => 'required',
            'ipk' => 'required',
            'hp' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $validated = $validator->validated();

        Mahasiswa::create($validated);

        return back()->with([
            'success' => 'data berhasil ditambahkan'
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        if(auth()->user()->avatar) {
            $avatar = asset('storage/' . auth()->user()->avatar);
        } else {
            $avatar = asset('img/user1.png');
        }

        return view('mahasiswa.data', ['title' => 'Data diri', 'avatar' => $avatar]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'required',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'angkatan' => 'required',
            'alamat' => 'required',
            'pembimbing_akademik' => 'required',
            'tanggal_TA' => 'required',
            'jumlah_surah' => 'required',
            'ipk' => 'required',
            'hp' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $validated = $validator->validated();

        Mahasiswa::where('id', $mahasiswa->id)->update($validated);

        return back()->with([
            'success' => 'Data berhasil di tambahkan'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
