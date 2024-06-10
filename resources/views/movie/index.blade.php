@extends('layouts.main')
@section('content')
<h1>Movie Management</h1>
<a href="{{ route('movie-new-movies') }}" class="btn btn-primary"> Tambah Film </a>
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="card">
    <table class="table">
        <tr>
            <th>Poster</th>
            <th>Judul</th>
            <th>Sutradara</th>
            <th>Produser</th>
            <th>Bahasa</th>
            <th>Subtitle</th>
            <th>Genre</th>
            <th>Sensor</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Tgl Diterima</th>
            <th>Aksi</th>
        </tr>
        @foreach($data_movie as $data)
        <tr>
            <td> <img src="{{ asset('storage/' . $data->poster) }}" class="img-fluid rounded-start" style="max-width: 100px"> </td>
            <td>{{ $data->judul }}</td>
            <td>{{ $data->sutradara }}</td>
            <td>{{ $data->produser }}</td>
            <td>{{ $data->bahasa }}</td>
            <td>{{ $data->bahasa_subtitle }}</td>
            <td>{{ $data->genre }}</td>
            <td>{{ $data->sensor }}</td>
            <td>{{ $data->show_start}}</td>
            <td>{{ $data->show_end }}</td>
            <td>{{ $data->deskripsi }}</td>
            <td>{{ $data->status_approval }}</td>
            <td>{{ $data->tanggal_approval }}</td>
            <td>
                <a href="{{ url('/dashboard/movie/movies/' . $data->movie_id. '/edit') }}" class="btn btn-primary"> <i class="bi bi-pencil-square"></i> </a>
                <form class="d-inline" action="{{ url('/dashboard/movie/movies/' . $data->movie_id) }}" method="Post"> 
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
