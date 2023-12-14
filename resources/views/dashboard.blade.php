@extends('layouts.main')

@section('container')
    <h2>dashboard mahasiswa</h2>
    <h2>Nama : {{  auth()->user()->nama }}</h2>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn" type="submit">logout</button>
    </form>
@endsection
