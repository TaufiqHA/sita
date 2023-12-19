@extends('layouts.main')

@section('container')
    <div class="w-full h-full flex flex-col gap-5">
        <div class="flex-1 w-full h-fit flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl">Form Pengajuan Judul</h2>
            </div>
            <div class="flex gap-3 items-center">
                <img src="{{ $avatar }}" alt="user" class="rounded-full w-12">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn w-32 m-1">settings</div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-white rounded-box w-32 ">
                      <li><a href="{{ route('edit.user', ['user' => auth()->user()->id]) }}">Akun</a></li>
                      <li><a href="{{ route('data.mahasiswa', ['mahasiswa' => auth()->user()->mahasiswa->id]) }}" >Data diri</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="flex-2 w-full h-[88%] flex justify-between gap-7 ">
            <div class="w-full h-full flex-2 overflow-y-auto max-w-xl">
                @if ($errors->any())
                <div role="alert" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif
                @if (session()->get('success'))
                <div role="alert" class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session()->get('success') }}</span>
                  </div>
                @endif
                <form action="/judul" class="w-full h-full flex flex-col gap-4 " method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="mahasiswa_id" value="{{ auth()->user()->mahasiswa->id }}">
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Konsentrasi</span>
                        </div>
                        <input type="text" placeholder="konsentrasi" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('konsentrasi')
                            border-red-500
                        @enderror " name="konsentrasi" value="{{ old('konsentrasi') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Judul Skripsi</span>
                        </div>
                        <input type="text" placeholder="judul skripsi" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('judul_skripsi')
                            border-red-500
                        @enderror" name="judul_skripsi" value="{{ old('judul_skripsi') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Metode Analisis yang Digunakan</span>
                        </div>
                        <input type="text" placeholder="metode" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('metode')
                            border-red-500
                        @enderror" name="metode" value="{{ old('metode') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Teknik Pengumpulan data</span>
                        </div>
                        <input type="text" placeholder="teknik pengumpulan data" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('teknik')
                            border-red-500
                        @enderror" name="teknik" value="{{ old('teknik') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Bentuk Data</span>
                        </div>
                        <select class="select select-bordered rounded-full drop-shadow-xl" name="bentuk_data">
                        <option disabled selected>select</option>
                        <option value="Primer">Primer</option>
                        <option value="Sekunder">Sekunder</option>
                        </select>
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Tempat PengambilanData</span>
                        </div>
                        <input type="text" placeholder="tempat pengambilan data" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('tempat')
                            border-red-500
                        @enderror" name="tempat" value="{{ old('tempat') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Nama Calon Dosen Pembimbing Pilihan 1</span>
                        </div>
                        <input type="text" placeholder="nama dosen" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('nama_dosen1')
                            border-red-500
                        @enderror" name="nama_dosen1" value="{{ old('nama_dosen1') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Nama Calon Dosen Pembimbing Pilihan 2</span>
                        </div>
                        <input type="text" placeholder="nama dosen" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('nama_dosen2')
                            border-red-500
                        @enderror" name="nama_dosen2" value="{{ old('nama_dosen2') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Nama Calon Dosen Pembimbing Pilihan 3</span>
                        </div>
                        <input type="text" placeholder="nama dosen" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('nama_dosen3')
                            border-red-500
                        @enderror" name="nama_dosen3" value="{{ old('nama_dosen3') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Nama Calon Dosen Pembimbing Pilihan 4</span>
                        </div>
                        <input type="text" placeholder="nama dosen" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('nama_dosen4')
                            border-red-500
                        @enderror" name="nama_dosen4" value="{{ old('nama_dosen4') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Jumlah SKS yang Telah Ditempu (lulus)</span>
                        </div>
                        <input type="text" placeholder="jumlah SKS" class="input input-bordered w-full max-w-lg rounded-full drop-shadow-xl @error('jumlah_sks')
                            border-red-500
                        @enderror" name="jumlah_sks" value="{{ old('jumlah_sks') }}" />
                    </label>
                    <label class="form-control w-full max-w-lg">
                        <div class="label">
                        <span class="label-text font-semibold text-lg">Bukti Konsultasi</span>
                        </div>
                        <input type="file" class="file-input file-input-bordered w-full max-w-lg rounded-full drop-shadow-xl" name="bukti" />
                    </label>
                    <button class="w-full max-w-lg btn btn-success my-3 rounded-full drop-shadow-xl text-white">Ajukan</button>
                </form>
            </div>
            <div class="w-full h-full flex-1 flex justify-end">
                <div class="w-full bg-[#92E3A9] h-[70%] p-5 rounded-2xl drop-shadow-xl">
                    <div class="w-full h-full">
                        <div class="w-full h-full overflow-y-auto">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="font-semibold text-[16px]">Judul Skripsi</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($judul as $item)
                                    <tr>
                                        <td>{{ $item->judul_skripsi }}</td>
                                    </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
