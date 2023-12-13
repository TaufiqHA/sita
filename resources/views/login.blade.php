@extends('layouts.auth')

@section('container')
    <div class="container h-full mx-auto py-7 px-16 bg-[#F2F2F2] flex rounded-[47px] drop-shadow-xl " >
        <div class="w-full h-full flex flex-col flex-1">
            <h2 class="font-semibold text-[40px] mb-5" >Login</h2>
            <form action="#" class="flex flex-col gap-5" >
                <input type="text" placeholder="username" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl" name="username" autocomplete="off" />
                <input type="password" placeholder="password" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl" name="password" autocomplete="off" />
                <button class="btn w-full max-w-sm self-center bg-[#BDF6BC] rounded-full drop-shadow-xl border-none my-3">Login</button>
            </form>
            <h2 class="self-center mt-3 text-sm font-normal">or login using :</h2>
            <div class="flex justify-center gap-3 mt-7 w-full max-w-lg p-3 bg-white rounded-full drop-shadow-xl ">
                <img src="img/google.svg" alt="google">
                <h2 class="font-semibold">Google</h2>
            </div>
        </div>
        <div class="flex-1 flex justify-center" >
            <img src="img/login1.png" alt="login" class="w-full h-full">
        </div>
    </div>
@endsection
