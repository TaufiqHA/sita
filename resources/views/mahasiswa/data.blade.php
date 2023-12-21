@extends('layouts.main')

@section('container')
    <div class="w-full h-[90%] overflow-y-auto">
        <form action="/mahasiswa/{{ $data->id }}" class="w-full h-full flex gap-5" method="POST">
            @csrf
            @method('put')
            <div class="flex-2 w-[50%] h-full flex flex-col gap-4">
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">Nama Lengkap</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl" name="nama" value="{{ $data->nama }}" />
                </label>
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">NIM</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl" name="nim" value="{{ $data->nim }}" />
                </label>
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">Program Studi</span>
                    </div>
                    <select class="select select-bordered" name="program_studi">
                      <option disabled selected>select</option>
                      <option value="Teknik Informatika" {{ $data->program_studi === 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                      <option value="Biologi" {{ $data->program_studi === 'Biologi' ? 'selected' : '' }}>Biologi</option>
                      <option value="Fisika" {{ $data->program_studi === 'Fisika' ? 'selected' : '' }}>Fisika</option>
                      <option value="Kimia" {{ $data->program_studi === 'Kimia' ? 'selected' : '' }}>Kimia</option>
                      <option value="Matematika" {{ $data->program_studi === 'Matematika' ? 'selected' : '' }}>Matematika</option>
                      <option value="Ilmu Peternakan" {{ $data->program_studi === 'Ilmu Peternakan' ? 'selected' : '' }}>Ilmu Peternakan</option>
                      <option value="Teknik Perencanaan Wilayah dan Kota" {{ $data->program_studi === 'Teknik Perencanaan Wilayah dan Kota' ? 'selected' : '' }}>Teknik Perencanaan Wilayah dan Kota</option>
                      <option value="Teknik Arsitektur" {{ $data->program_studi === 'Teknik Arsitektur' ? 'selected' : '' }}>Teknik Arsitektur</option>
                      <option value="Sistem Informasi" {{ $data->program_studi === 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                    </select>
                </label>
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">Fakultas</span>
                    </div>
                    <select class="select select-bordered" name="fakultas">
                      <option disabled selected>select</option>
                      <option value="Syariah dan Hukum" {{ $data->fakultas === 'Syariah dan Hukum' ? 'selected' : '' }}>Syariah dan Hukum</option>
                      <option value="Tarbiyah dan Keguruan" {{ $data->fakultas === 'Tarbiyah dan Keguruan' ? 'selected' : '' }}>Tarbiyah dan Keguruan</option>
                      <option value="Ushuluddin Filsafat dan Politik" {{ $data->fakultas === 'Ushuluddin Filsafat dan Politik' ? 'selected' : '' }}>Ushuluddin Filsafat dan Politik</option>
                      <option value="Adab dan Humaniora" {{ $data->fakultas === 'Adab dan Humaniora' ? 'selected' : '' }}>Adab dan Humaniora</option>
                      <option value="Dakwah dan Komunikasi" {{ $data->fakultas === 'Dakwah dan Komunikasi' ? 'selected' : '' }}>Dakwah dan Komunikasi</option>
                      <option value="Sains dan Teknologi" {{ $data->fakultas === 'Sains dan Teknologi' ? 'selected' : '' }}>Sains dan Teknologi</option>
                      <option value="Kedokteran dan Ilmu Kesehatan" {{ $data->fakultas === 'Kedokteran dan Ilmu Kesehatan' ? 'selected' : '' }}>Kedokteran dan Ilmu Kesehatan</option>
                      <option value="Ekonomi dan Bisnis Islam" {{ $data->fakultas === 'Ekonomi dan Bisnis Islam' ? 'selected' : '' }}>Ekonomi dan Bisnis Islam</option>
                    </select>
                </label>
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">Angkatan</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl" name="angkatan" value="{{ $data->angkatan }}" />
                </label>
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">Indeks Prestasi Kumulatif (IPK)</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl" name="ipk" value="{{ $data->ipk }}" />
                </label>
            </div>
            <div class="flex-2 w-[50%] h-full flex flex-col gap-4">
                <label class="form-control">
                    <div class="label">
                      <span class="label-text">Alamat</span>
                    </div>
                    <textarea class="textarea textarea-bordered h-24" placeholder="Type here" name="alamat">{{ $data->alamat }}</textarea>
                </label>
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">Pembimbing Akademik</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl" name="pembimbing_akademik" value="{{ $data->pembimbing_akademik }}" />
                </label>
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">Tanggal Pendaftaran TA</span>
                    </div>
                    <input type="date" placeholder="Type here" class="input input-bordered w-full max-w-xl" name="tanggal_TA" value="{{ $data->tanggal_TA }}" />
                </label>
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">Jumlah Surah Juz 30 dari Al-quran yang telah dihafalkan</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl" name="jumlah_surah" value="{{ $data->jumlah_surah }}" />
                </label>
                <label class="form-control w-full max-w-xl">
                    <div class="label">
                      <span class="label-text">No. HP yang dapat dihubungi</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl" name="hp" value="{{ $data->hp }}" />
                </label>
                <button class="btn btn-success text-white" >Save</button>
            </div>
        </form>
    </div>
@endsection
