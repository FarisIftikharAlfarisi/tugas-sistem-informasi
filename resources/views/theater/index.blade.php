@extends('layouts.main')
@section('content')
<h1>Studio</h1>
<a href="{{ route('movie-new-theater') }}" class="btn btn-primary">New Theater</a>

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
            <a href="{{ route('movie-edit-theater',['id' => $data->theater_id]) }}" class="btn btn-primary"> <i class="bi bi-pencil-square"></i> </a>
            <a href="" class="btn btn-danger"> <i class="bi bi-trash"></i> </a>
        </td>
    </tr>
    @endforeach
</table>
</div>
@endsection
