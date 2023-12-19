@extends('layouts.main')

@section('container')
    <div class="w-full h-full flex flex-col">
        <div class="w-full flex items-center justify-between">
            <div class="flex-2 flex flex-col gap-1">
                <h2 class="font-semibold text-3xl">Dashboard</h2>
                <h2 class="font-normal text-lg">Welcome back, {{ auth()->user()->mahasiswa->nama }}</h2>
            </div>
            <div class="flex-2 flex gap-3 items-center">
                <img src="{{ $avatar }}" alt="user" class="rounded-full w-12">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn w-32 m-1">settings</div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-white rounded-box w-32">
                      <li><a href="{{ route('edit.user', ['user' => auth()->user()->id]) }}">Akun</a></li>
                      <li><a href="{{ route('data.mahasiswa', ['mahasiswa' => auth()->user()->mahasiswa->id]) }}" >Data diri</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-full mt-6 flex flex-col gap-3">
            <h2 class="font-semibold text-md">Fast menu</h2>
            <div class="w-full flex justify-between">
                <div class="card w-80 h-20 bg-base-100 shadow-xl image-full">
                    <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" class="w-full"/></figure>
                    <div class="card-body">
                      <h2 class="card-title">Shoes!</h2>
                      <p>If a dog chews shoes whose shoes does he choose?</p>
                    </div>
                </div>
                <div class="card w-80 h-20 bg-base-100 shadow-xl image-full">
                    <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" class="w-full" /></figure>
                    <div class="card-body">
                      <h2 class="card-title">Shoes!</h2>
                      <p>If a dog chews shoes whose shoes does he choose?</p>
                    </div>
                </div>
                <div class="card w-80 h-20 bg-base-100 shadow-xl image-full">
                    <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" class="w-full" /></figure>
                    <div class="card-body">
                      <h2 class="card-title">Shoes!</h2>
                      <p>If a dog chews shoes whose shoes does he choose?</p>
                    </div>
                </div>
            </div>
        </div>
        <div></div>
    </div>
@endsection
