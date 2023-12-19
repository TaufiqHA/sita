@extends('layouts.main')

@section('container')
    <div class="w-full h-full flex flex-col gap-5">
        <div class="flex-1 w-full h-fit">
            <h2 class="font-semibold text-2xl">Pengaturan Akun</h2>
        </div>
        <div class="flex-2 w-full h-full overflow-y-auto">
            @if (session()->get('success'))
            <div role="alert" class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session()->get('success') }}</span>
            </div>
            @endif
            @if ($errors->any())
            <div role="alert" class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ $errors->first() }}</span>
              </div>
            @endif
            <form action="{{ route('userEdit', ['user' => auth()->user()->id]) }}" class="w-full h-full flex flex-col gap-5" method="post">
                @csrf
                @method('put')
                <label class="form-control w-full max-w-lg">
                    <div class="label">
                      <span class="label-text font-semibold text-md">Username</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg drop-shadow-lg" name="username" value="{{ $data->username }}" />
                </label>
                <label class="form-control w-full max-w-lg">
                    <div class="label">
                      <span class="label-text">Email</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg drop-shadow-lg" name="email" value="{{ $data->email }}" />
                </label>
                <div class="label">
                    <span class="label-text font-semibold text-lg text-gray-300">Pengaturan kata sandi</span>
                </div>
                <label class="form-control w-full max-w-lg">
                    <div class="label">
                      <span class="label-text">Password</span>
                    </div>
                    <input type="password" placeholder="Type here" class="input input-bordered w-full max-w-lg drop-shadow-lg" name="password" />
                </label>
                <label class="form-control w-full max-w-lg" >
                    <div class="label">
                      <span class="label-text">Confirm</span>
                    </div>
                    <input type="password" placeholder="Type here" class="input input-bordered w-full max-w-lg drop-shadow-lg" name="confirm" />
                </label>
                <button type="submit" class="btn btn-success w-full max-w-lg rounded-full drop-shadow-lg text-white font-semibold text-md my-3">Save</button>
            </form>
        </div>
    </div>
@endsection
