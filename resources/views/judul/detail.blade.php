@extends('layouts.main')

@section('container')
    <div class="w-full h-[88%] overflow-y-auto">
        <div class="overflow-x-auto">
            <table class="table">
              <tbody>
                <tr>
                  <th>Judul Skripsi</th>
                  <td>:</td>
                  <td>{{ $data->judul_skripsi }}</td>
                </tr>
                <tr>
                    <th>Konsentrasi</th>
                    <td>:</td>
                    <td>{{ $data->konsentrasi }}</td>
                </tr>
                <tr>
                    <th>Metode Analisis yang Digunakan</th>
                    <td>:</td>
                    <td>{{ $data->metode }}</td>
                </tr>
                <tr>
                    <th>Teknik Pengumpulan Data</th>
                    <td>:</td>
                    <td>{{ $data->teknik }}</td>
                </tr>
                <tr>
                    <th>Bentuk Data</th>
                    <td>:</td>
                    <td>{{ $data->bentuk_data }}</td>
                </tr>
                <tr>
                    <th>Tempat Pengambilan Data</th>
                    <td>:</td>
                    <td>{{ $data->tempat }}</td>
                </tr>
                <tr>
                    <th>Nama Calon Dosen Pembimbing Pilihan 1</th>
                    <td>:</td>
                    <td>{{ $data->nama_dosen1 }}</td>
                </tr>
                <tr>
                    <th>Nama Calon Dosen Pembimbing Pilihan 2</th>
                    <td>:</td>
                    <td>{{ $data->nama_dosen2 }}</td>
                </tr>
                <tr>
                    <th>Nama Calon Dosen Pembimbing Pilihan 3</th>
                    <td>:</td>
                    <td>{{ $data->nama_dosen3 }}</td>
                </tr>
                <tr>
                    <th>Nama Calon Dosen Pembimbing Pilihan 4</th>
                    <td>:</td>
                    <td>{{ $data->nama_dosen4 }}</td>
                </tr>
                <tr>
                    <th>Jumlah SKS yang Telah Ditempuh (lulus)</th>
                    <td>:</td>
                    <td>{{ $data->jumlah_sks }}</td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
@endsection
