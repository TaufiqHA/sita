<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>SITA | {{ $title }}</title>
</head>
<body>
    @if ($errors->any())
    <div role="alert" class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>{{ $errors->first() }}</span>
    </div>
    @endif
    @if (session()->get('success'))
    <div role="alert" class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>{{ session()->get('success') }}</span>
    </div>
    @endif
    <h2>form input data dosen</h2>
    <form action="{{ url('/pegawai') }}" method="post" class="w-full max-w-lg flex flex-col gap-3 mx-auto">
        @csrf
        <input type="text" placeholder="nama" class="input input-bordered w-full max-w-xs" name="nama" />
        <input type="text" placeholder="nip" class="input input-bordered w-full max-w-xs" name="nip" />
        <input type="text" placeholder="jabatan" class="input input-bordered w-full max-w-xs" name="jabatan" />
        <input type="text" placeholder="kategori kepegawaian" class="input input-bordered w-full max-w-xs" name="kategori_pegawai" />
        <input type="text" placeholder="status kepegawaian" class="input input-bordered w-full max-w-xs" name="status_kepegawaian" />
        <button type="submit" class="btn">Save</button>
    </form>
</body>
</html>
