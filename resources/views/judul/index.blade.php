@extends('layouts.main')

@section('container')
   <div class="w-full h-full flex flex-col gap-4">
    <div class="overflow-x-auto">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th class="font-semibold text-[14px]">Judul</th>
              <th class="font-semibold text-[14px]">Pembimbing 1</th>
              <th class="font-semibold text-[14px]">Pembimbing 2</th>
              <th class="font-semibold text-[14px]">Status</th>
              <th class="font-semibold text-[14px]">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- row 1 -->
            @foreach ($judul as $item)
                <tr>
                    <td>{{ $item->judul_skripsi }}</td>
                    <td>Adnan Sauddin</td>
                    <td>Muh. Irwan S.Si, M.Si</td>
                    <td>
                        <div class="p-3 rounded-md bg-success text-white">
                            Diajukan
                        </div>
                    </td>
                    <td class="flex gap-3">
                    <a href="/judul/{{ $item->id }}" class="btn btn-warning text-white">View</a>
                    <button class="btn btn-error text-white">Hapus</button>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- You can open the modal using ID.showModal() method -->
      <button class="btn btn-success text-white w-[30%]" onclick="my_modal_3.showModal()">Tambah Judul Tugas Akhir</button>
      <dialog id="my_modal_3" class="modal">
      <div class="modal-box">
      <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      </form>
      <form action="{{ route('addJudul') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ auth()->user()->mahasiswa->id }}" name="mahasiswa_id">
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Konsentrasi</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="konsentrasi" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Judul Tugas Akhir</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="judul_skripsi" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Metode Analisis yang Digunakan</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="metode" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Teknik Pengumpulan Data</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="teknik" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Bentuk Data</span>
            </div>
            <select class="select select-bordered" name="bentuk_data">
              <option disabled selected>select</option>
              <option value="Primer">Primer</option>
              <option value="Sekunder">Sekunder</option>
            </select>
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Tempat Pengambilan Data</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="tempat" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Nama Calon Dosen Pembimbing Pilihan 1</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="nama_dosen1" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Nama Calon Dosen Pembimbing Pilihan 2</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="nama_dosen2" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Nama Calon Dosen Pembimbing Pilihan 3</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="nama_dosen3" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Nama Calon Dosen Pembimbing Pilihan 4</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="nama_dosen4" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Jumlah SKS yang Telah Ditempuh (lulus)</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="jumlah_sks" />
        </label>
        <label class="form-control w-full max-w-lg">
            <div class="label">
              <span class="label-text">Bukti Konsultasi</span>
            </div>
            <input type="file" class="file-input file-input-bordered w-full max-w-lg" name="bukti" />
        </label>
        <button type="submit" class="btn btn-success text-white mt-4 w-full">Ajukan</button>
      </form>
      </dialog>
   </div>
@endsection
