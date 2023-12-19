<!DOCTYPE html>
<html lang="en" data-theme = "light" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="icon" href="img/logo_sita.png">
    <title>SITA | {{ $title }}</title>
</head>
<body>
    <div class="w-full h-screen flex">
        <div class="w-60 h-screen pl-3 bg-[#92E3A9] rounded-r-3xl flex flex-col gap-5 drop-shadow-2xl flex-1">
            <div class="flex justify-center mt-5">
                <img src="{{ asset('img/logo_sita.png') }}" alt="logo" class="w-24">
            </div>
            <div class="w-full h-full flex flex-col items-end mt-16 gap-7">
                <a href="{{ route('mahasiswa') }}" class="w-44 flex justify-start items-center gap-3 bg-white py-3 pl-4 rounded-l-full hover:drop-shadow-xl @if ($title === 'Mahasiswa')
                    drop-shadow-xl
                @endif">
                    <img src="{{ asset('img/logo/home.svg') }}" alt="home">
                    <h2>Dashboard</h2>
                </a>
                <a href="/judul" class="w-44 flex justify-start items-center gap-3 bg-white py-3 pl-4 rounded-l-full hover:drop-shadow-xl @if ($title === 'Form Pengajuan Judul')
                    drop-shadow-xl
                 @endif">
                    <img src="{{ asset('img/logo/info.svg') }}" alt="info">
                    <h2>Pengajuan Judul </h2>
                </a>
                <a href="#" class="w-44 flex justify-start items-center gap-3 bg-white py-3 pl-4 rounded-l-full hover:drop-shadow-xl">
                    <img src="{{ asset('img/logo/bimbingan.svg') }}" alt="home">
                    <h2>Bimbingan</h2>
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
        <div class="w-full h-full flex-2 p-7 overflow-hidden">
            @yield('container')
        </div>
    </div>
</body>
</html>
