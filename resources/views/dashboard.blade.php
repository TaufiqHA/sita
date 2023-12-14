<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>dashboard mahasiswa</h2>
    <h2>Nama : {{  auth()->user()->nama }}</h2>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn" type="submit">logout</button>
    </form>
</body>
</html>
