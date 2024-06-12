@extends('layouts.main')
@section('content')
<h1>Schedule</h1>
<a href="{{ route('movie-new-schedule') }}" class="btn btn-primary"> Buat Jadwal Baru </a>
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif


@endsection
