<!DOCTYPE html>
<html lang="en" data-theme = "light" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('img/logo_sita.png') }}">
    <title>SITA | {{ $title }}</title>
</head>
<body>
    <div class="w-full h-screen flex">
        <div class="w-60 h-screen pl-3 bg-[#92E3A9] rounded-r-3xl flex flex-col gap-5 drop-shadow-2xl flex-1">
            <div class="flex justify-center mt-5">
                <img src="{{ asset('img/logo_sita.png') }}" alt="logo" class="w-24">
            </div>
            <div class="w-full h-full flex flex-col items-end mt-16 gap-7">
                <a href="{{ route('mahasiswa') }}" class="w-44 flex justify-start items-center gap-3 bg-white py-3 pl-4 rounded-l-full hover:drop-shadow-xl @if ($title === 'Dashboard')
                    drop-shadow-xl
                @endif">
                    <img src="{{ asset('img/logo/home.svg') }}" alt="home">
                    <h2>Dashboard</h2>
                </a>
                <a href="{{ route('listMahasiswa') }}" class="w-44 flex justify-start items-center gap-3 bg-white py-3 pl-4 rounded-l-full hover:drop-shadow-xl @if ($title === 'Mahasiswa')
                    drop-shadow-xl
                @endif">
                    <img src="{{ asset('img/logo/list.svg') }}" alt="home">
                    <h2>Mahasiswa</h2>
                </a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-44 flex justify-start items-center gap-3 bg-white py-3 pl-4 rounded-l-full hover:drop-shadow-xl">
                        <img src="{{ asset('img/logo/logout.svg') }}" alt="home">
                        <h2>Logout</h2>
                    </button>
                </form>
            </div>
        </div>
        <div class="w-full h-full flex-2 p-7 overflow-hidden flex flex-col gap-4">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-2xl">{{ $title }}</h2>
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
            <div>
                @if (session()->get('success'))
                <div role="alert" class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session()->get('success') }}</span>
                </div>
                @endif
                @if ($errors->any())
                <div role="alert" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif
                @yield('container')
            </div>
        </div>
    </div>
</body>
</html>
