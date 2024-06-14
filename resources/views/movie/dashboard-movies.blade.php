@extends('layouts.main')
@section('content')
<h1>Film</h1>
<a href="{{ route('movie-new-movies') }}" class="btn btn-primary"> Tambah Film </a>
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@foreach ($data_movie as $index => $data)
    @if ($index % 4 == 0)
        <div class="row">
    @endif

    <div class="col-3 mt-4">
        <div class="card">
            <img src="{{ asset('storage/img/posters/'.$data->poster) }}" alt="" style="width:240px" srcset="">
            <div class="card-body">
                <h3>{{ $data->judul }}</h3>
                <p>{{ $data->deskripsi }}</p>
            </div>
        </div>
    </div>

    @if ($index % 4 == 3)
        </div>
    @endif
@endforeach

@if ($index % 4 != 3)
    </div>
@endif



<div class="card">
    <table class="table">
        <tr class="text-center">
            <th>Poster</th>
            <th>Judul</th>
            <th>Sutradara</th>
            <th>Produser</th>
            <th>Genre</th>
            <th>Sensor</th>
            <th>Status Approve</th>
            <th>Tgl Diterima</th>
            <th>Aksi</th>
        </tr>
        @foreach($data_movie as $data)
        <tr>
            <td> <img src="{{ asset('storage/img/posters/' . $data->poster) }}" class="img-fluid rounded-start" style="max-width: 100px"> </td>
            <td>{{ $data->judul }}</td>
            <td>{{ $data->sutradara }}</td>
            <td>{{ $data->produser }}</td>
            <td>{{ $data->bahasa }}</td>
            <td>{{ $data->bahasa_subtitle }}</td>
            <td>{{ $data->genre }}</td>
            <td>{{ $data->sensor }}</td>
            <td>{{ $data->deskripsi }}</td>
            <td>{{ $data->status_approval }}</td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('movie-edit-movies',['id' => $data->movie_id]) }}" class="btn btn-primary"> <i class="bi bi-pencil-square"></i> </a>
                    <form action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Apakah Yakin?')"><i class="bi bi-trash"></i><span data-feather="x-circle"></span></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
</div>
@endsection
