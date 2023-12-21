@extends('layouts.main')

@section('container')
    <div class="w-full h-full">
        <form action="/user/{{ $data->id }}" method="POST" class="w-full h-full flex gap-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex-2 w-[50%] h-full flex flex-col gap-3">
                <div class="w-full flex flex-col">
                    <div class="avatar">
                        <div class="w-24 rounded-full">
                          <img src="{{ asset($avatar) }}" />
                        </div>
                    </div>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                          <span class="label-text">Foto Profil</span>
                        </div>
                        <input type="file" class="file-input file-input-bordered w-full max-w-lg" name="avatar" />
                    </label>
                </div>
                <label class="form-control w-full max-w-lg">
                    <div class="label">
                      <span class="label-text">Username</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="username" value="{{ $data->username }}" />
                </label>
                <label class="form-control w-full max-w-lg">
                    <div class="label">
                      <span class="label-text">Email</span>
                    </div>
                    <input type="email" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="email" value="{{ $data->email }}" />
                </label>
            </div>
            <div class="flex-2 w-[50%] h-full flex flex-col gap-3">
                <h2 class="font-semibold text-[16px] text-gray-400">Pengaturan Kata Sandi</h2>
                <label class="form-control w-full max-w-lg">
                    <div class="label">
                      <span class="label-text">Password</span>
                    </div>
                    <input type="password" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="password" />
                </label>
                <label class="form-control w-full max-w-lg">
                    <div class="label">
                      <span class="label-text">Confirm</span>
                    </div>
                    <input type="password" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="confirm" />
                </label>
                <button class="btn btn-success text-white mt-3 max-w-lg">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
