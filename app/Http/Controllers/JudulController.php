<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\File;

class JudulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->avatar) {
            $avatar = asset('storage/' . auth()->user()->avatar);
        } else if(auth()->user()->avatar) {
            $avatar = asset(asset(auth()->user()->avatar));
        } else {
            $avatar = asset('img/user1.png');
        }

        $judul = auth()->user()->mahasiswa->judul;

        return view('judul.index', ['title' => 'Tugas Akhir', 'avatar' => $avatar, 'judul' => $judul]);
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
            'mahasiswa_id' => "required",
            'konsentrasi' => 'required',
            'judul_skripsi' => 'required',
            'metode' => 'required',
            'teknik' => 'required',
            'bentuk_data' => 'required',
            'tempat' => 'required',
            'nama_dosen1' => 'nullable',
            'nama_dosen2' => 'nullable',
            'nama_dosen3' => 'nullable',
            'nama_dosen4' => 'nullable',
            'jumlah_sks' => 'required',
            'bukti' => [
                'required',
                File::types('pdf')
            ],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        if($request->file('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('file');
        }

        Judul::create($validated);

        return back()->with([
            'success' => 'judul berhasil diajukaan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Judul $judul)
    {
        if(auth()->user()->avatar) {
            $avatar = asset('storage/' . auth()->user()->avatar);
        } else if(auth()->user()->avatar) {
            $avatar = asset(asset(auth()->user()->avatar));
        } else {
            $avatar = asset('img/user1.png');
        }


       return view('judul.detail', ['title' => 'Detail Judul', 'data' => $judul, 'avatar' => $avatar]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Judul $judul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Judul $judul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Judul $judul)
    {
        //
    }
}
