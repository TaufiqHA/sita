<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="icon" href="img/logo_sita.png">
    <title>SITA | {{ $title }}</title>
</head>
<body>
    <div class="w-full h-screen px-[110px] py-[60px]">
        @yield('container')
    </div>
</body>
</html>
