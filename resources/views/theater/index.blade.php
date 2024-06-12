@extends('layouts.main')
@section('content')
<h1>Studio</h1>
<a href="{{ route('movie-new-theater') }}" class="btn btn-primary">New Theater</a>
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="card">
<table class="table">
    <tr>
        <th>Nama Studio</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @foreach($data_studio as $data)
    <tr>
        <td>{{ $data->nama_theater }}</td>
        <td>{{ $data->status_availability }}</td>
        <td>
            <a href="{{ url('/dashboard/movie/theater/' . $data->theater_id) . '/edit' }}" class="btn btn-primary"> <i class="bi bi-pencil-square"></i> </a>
            <form class="d-inline" action="{{ url('/dashboard/movie/theater/' . $data->theater_id) }}" method="Post"> 
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Yakin?')"><i class="bi bi-trash"></i><span data-feather="x-circle"></span></button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
</div>
@endsection
