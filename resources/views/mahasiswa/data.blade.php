@extends('layouts.main')

@section('container')
@if ($errors->any())
<div role="alert" class="alert alert-error">
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    <span>{{ $errors->first() }}</span>
</div>
@endif
    <div class="w-full h-full flex flex-col gap-3">
        <div class="flex-2 w-full h-fit">
            <h2 class="font-semibold text-3xl">Data diri</h2>
        </div>
        <div class="flex-2 w-full h-full flex gap-7">
            <div class="flex-2 w-full h-[90%] max-w-2xl rounded-3xl overflow-y-auto scroll-smooth drop-shadow-xl">
                <form action="/mahasiswa/{{ auth()->user()->mahasiswa->id }}" method="POST" class="w-full h-full flex flex-col gap-3" >
                    @csrf
                    @method('put')
                    <div class="flex gap-5">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                              <span class="label-text">Nama lengkap</span>
                            </div>
                            <input type="text" placeholder="nama lengkap" class="input input-bordered w-full max-w-xs rounded-full h-10" name="nama" value="{{ auth()->user()->mahasiswa->nama }}" />
                        </label>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                              <span class="label-text">NIM</span>
                            </div>
                            <input type="number" placeholder="nim" class="input input-bordered w-full max-w-xs rounded-full h-10" name="nim" value="{{ auth()->user()->mahasiswa->nim }}" />
                        </label>
                    </div>
                    <div>
                        <label class="form-control w-full">
                            <div class="label">
                              <span class="label-text">Program Studi</span>
                            </div>
                            <select class="select select-bordered" name="program_studi">
                                <option disabled {{ auth()->user()->mahasiswa->program_studi ? "" : "selected" }}>program studi</option>
                                <option value="Teknik PWK" {{ auth()->user()->mahasiswa->program_studi === 'Teknik PWK' ? "selected" : "" }}>Teknik PWK</option>
                                <option value="Teknik Informatika" {{ auth()->user()->mahasiswa->program_studi === 'Teknik Informatika' ? "selected" : "" }}>Teknik Informatika</option>
                                <option value="Teknik Arsitektur" {{ auth()->user()->mahasiswa->program_studi === 'Teknik Arsitektur' ? "selected" : "" }}>Teknik Arsitektur</option>
                                <option value="Biologi" {{ auth()->user()->mahasiswa->program_studi === 'Biologi' ? "selected" : "" }}>Biologi</option>
                                <option value="Fisika" {{ auth()->user()->mahasiswa->program_studi === 'Fisika' ? "selected" : "" }}>Fisika</option>
                                <option value="Kimia" {{ auth()->user()->mahasiswa->program_studi === 'Kimia' ? "selected" : "" }}>Kimia</option>
                                <option value="Matematika" {{ auth()->user()->mahasiswa->program_studi === 'Matematika' ? "selected" : "" }}>Matematika</option>
                                <option value="Ilmu Peternakan" {{ auth()->user()->mahasiswa->program_studi === 'Ilmu Peternakan' ? "selected" : "" }}>Ilmu Peternakan</option>
                                <option value="Sistem Informasi" {{ auth()->user()->mahasiswa->program_studi === 'Sistem Informasi' ? "selected" : "" }}>Sistem Informasis</option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <label class="form-control w-full">
                            <div class="label">
                              <span class="label-text">Fakultas</span>
                            </div>
                            <select class="select select-bordered" name="fakultas">
                                <option disabled {{ auth()->user()->mahasiswa->fakultas ? "" : "selected" }}>fakultas</option>
                                <option value="Syariah dan Hukum" {{ auth()->user()->mahasiswa->fakultas === 'Syariah dan Hukum' ? "selected" : "" }}>Syariah dan Hukum</option>
                                <option value="Tarbiyah dan Keguruan" {{ auth()->user()->mahasiswa->fakultas === 'Tarbiyah dan Keguruan' ? "selected" : "" }}>Tarbiyah dan Keguruan</option>
                                <option value="Ushuluddin Filsafat dan Politik" {{ auth()->user()->mahasiswa->fakultas === 'Ushuluddin Filsafat dan Politik' ? "selected" : "" }}>Ushuluddin Filsafat dan Politik</option>
                                <option value="Adab dan Humaniora" {{ auth()->user()->mahasiswa->fakultas === 'Adab dan Humaniora' ? "selected" : "" }}>Adab dan Humaniora</option>
                                <option value="Dakwah dan Komunikasi" {{ auth()->user()->mahasiswa->fakultas === 'Dakwah dan Komunikasi' ? "selected" : "" }}>Dakwah dan Komunikasi</option>
                                <option value="Sains dan Teknologi" {{ auth()->user()->mahasiswa->fakultas === 'Sains dan Teknologi' ? "selected" : "" }}>Sains dan Teknologi</option>
                                <option value="Kedokteran dan Ilmu Kesehatan" {{ auth()->user()->mahasiswa->fakultas === 'Kedokteran dan Ilmu Kesehatan' ? "selected" : "" }}>Kedokteran dan Ilmu Kesehatan</option>
                                <option value="Ekonomi dan Bisnis Islam">Ekonomi dan Bisnis Islam</option>
                            </select>
                        </label>
                    </div>
                    <div class="flex gap-5">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                              <span class="label-text">Angkatan</span>
                            </div>
                            <input type="text" placeholder="angkatan" class="input input-bordered w-full max-w-xs h-10 rounded-full" name="angkatan" value="{{ auth()->user()->mahasiswa->angkatan }}" />
                        </label>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                              <span class="label-text">Tahun TA</span>
                            </div>
                            <input type="date" placeholder="tahun pendaftaran TA" class="input input-bordered w-full max-w-xs rounded-full h-10" name="tanggal_TA" value="{{ auth()->user()->mahasiswa->tanggal_TA }}" />
                        </label>
                    </div>
                    <div>
                        <label class="form-control">
                            <div class="label">
                              <span class="label-text">Alamat</span>
                            </div>
                            <textarea class="textarea textarea-bordered h-20" placeholder="alamat" name="alamat">{{ auth()->user()->mahasiswa->alamat }}</textarea>
                          </label>
                    </div>
                    <div class="flex gap-5">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                              <span class="label-text">Pembimbing akademik</span>
                            </div>
                            <input type="text" placeholder="pembimbing akademik" class="input input-bordered w-full max-w-xs h-10 rounded-full" name="pembimbing_akademik" value="{{ auth()->user()->mahasiswa->pembimbing_akademik }}" />
                        </label>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                              <span class="label-text">Jumlah surah yang telah dihafal</span>
                            </div>
                            <input type="text" placeholder="jumlah surah yang telah dihafal" class="input input-bordered w-full max-w-xs h-10 rounded-full" name="jumlah_surah" value="{{ auth()->user()->mahasiswa->jumlah_surah }}" />
                        </label>
                    </div>
                    <div class="flex gap-5">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                              <span class="label-text">IPK</span>
                            </div>
                            <input type="text" placeholder="IPK" class="input input-bordered w-full max-w-xs h-10 rounded-full" name="ipk" value="{{ auth()->user()->mahasiswa->ipk }}" />
                        </label>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                              <span class="label-text">No. HP</span>
                            </div>
                            <input type="number" placeholder="No. HP" class="input input-bordered w-full max-w-xs h-10 rounded-full" name="hp" value="{{ auth()->user()->mahasiswa->hp }}" />
                        </label>
                    </div>
                    <div class="w-full">
                        <button class="btn btn-success w-full rounded-full text-lg text-white my-4" type="submit" >Save</button>
                    </div>
                </form>
            </div>
            <div class="w-full flex-1 h-96 p-4 bg-[#92E3A9] flex flex-col gap-5 items-center rounded-3xl drop-shadow-xl" >
                <img src="{{ $avatar }}" alt="user" class="w-40 rounded-full">
                <form action="/user/{{ auth()->user()->id }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                          <span class="label-text">Foto profil</span>
                        </div>
                        <input type="file" class="file-input file-input-bordered w-full max-w-xs" name="avatar" />
                    </label>
                    <button type="submit" class="btn btn-success w-full rounded-full text-white mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
