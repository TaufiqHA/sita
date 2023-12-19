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
    <h2>form input data diri mahasiswa</h2>
    <form action="{{ url('/mahasiswa') }}" method="post" class="w-full max-w-lg flex flex-col gap-3 mx-auto">
        @csrf
        <input type="text" placeholder="nama" class="input input-bordered w-full max-w-xs" name="nama" />
        <input type="text" placeholder="nim" class="input input-bordered w-full max-w-xs" name="nim" />
        <select class="select select-bordered w-full max-w-xs" name="program_studi">
            <option disabled selected>program studi</option>
            <option value="Teknik PWK">Teknik PWK</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Teknik Arsitektur">Teknik Arsitektur</option>
            <option value="Biologi">Biologi</option>
            <option value="Fisika">Fisika</option>
            <option value="Kimia">Kimia</option>
            <option value="Matematika">Matematika</option>
            <option value="Ilmu Peternakan">Ilmu Peternakan</option>
            <option value="Sistem Informasi">Sistem Informasis</option>
        </select>
        <select class="select select-bordered w-full max-w-xs" name="fakultas">
            <option disabled selected>fakultas</option>
            <option value="Syariah dan Hukum">Syariah dan Hukum</option>
            <option value="Tarbiyah dan Keguruan">Tarbiyah dan Keguruan</option>
            <option value="Ushuluddin Filsafat dan Politik">Ushuluddin Filsafat dan Politik</option>
            <option value="Adab dan Humaniora">Adab dan Humaniora</option>
            <option value="Dakwah dan Komunikasi">Dakwah dan Komunikasi</option>
            <option value="Sains dan Teknologi">Sains dan Teknologi</option>
            <option value="Kedokteran dan Ilmu Kesehatan">Kedokteran dan Ilmu Kesehatan</option>
            <option value="Ekonomi dan Bisnis Islam">Ekonomi dan Bisnis Islam</option>
        </select>
        <input type="text" placeholder="angkatan" class="input input-bordered w-full max-w-xs" name="angkatan" />
        <input type="text" placeholder="alamat" class="input input-bordered w-full max-w-xs" name="alamat" />
        <input type="text" placeholder="pembimbing akademik" class="input input-bordered w-full max-w-xs" name="pembimbing_akademik" />
        <input type="date" placeholder="tanggal pendaftaran TA" class="input input-bordered w-full max-w-xs" name="tanggal_TA" />
        <input type="number" placeholder="jumlah surah yang telah dihafal" class="input input-bordered w-full max-w-xs" name="jumlah_surah" />
        <input type="text" placeholder="ipk" class="input input-bordered w-full max-w-xs" name="ipk" />
        <input type="text" placeholder="no HP" class="input input-bordered w-full max-w-xs" name="hp" />
        <button type="submit" class="btn">Save</button>
    </form>
</body>
</html>
