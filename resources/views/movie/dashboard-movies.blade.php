@extends('layouts.main')
@section('content')
<h1>Film</h1>
<a href="{{ route('movie-new-movies') }}" class="btn btn-primary"> Tambah Film </a>
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

{{-- @foreach ($data_movie as $index => $data)
    @if ($index % 4 == 0)
        <div class="row">
    @endif

    <div class="col-3 mt-4">
        <div class="card">
            <img src="{{ asset('storage/img/posters/'.$data->poster) }}" alt="" style="width:240px" srcset="">
            <div class="card-body">
                <h3>{{ $data->judul }}</h3>
                <p>{{  Str::limit($data->deskripsi, 100,'...') }}</p>
            </div>
        </div>
    </div>

    @if ($index % 4 == 3)
        </div>
    @endif
@endforeach --}}

{{-- @if ($index % 4 != 3)
    </div>
@endif --}}

<div class="card mt-2">
    <table class="table">
        <tr class="text-center">
            <th>Poster</th>
            <th>Judul</th>
            <th>Sutradara</th>
            <th>Produser</th>
            <th>Genre</th>
            <th>Sensor</th>
            <th>Status Approve</th>
            <th>Tanggal Update</th>
            <th>Aksi</th>
        </tr>
        @foreach($data_movie as $data)
        <tr>
            <td> <img src="{{ asset('storage/img/posters/' . $data->poster) }}" class="img-fluid rounded-start" style="max-width: 100px"> </td>
            <td>{{ $data->judul }}</td>
            <td>{{ $data->sutradara }}</td>
            <td>{{ $data->produser }}</td>
            <td>{{ $data->genre }}</td>
            <td>{{ $data->sensor }}</td>
            <td>
                @if ($data->status_approval === null)
                    <span class="badge bg-secondary">Belum di Approve</span>
                @elseif($data->status_approval === 'Rejected')
                    <span class="badge bg-danger">Di Reject</span>
                @else
                    <span class="badge bg-success">Di Approve</span>
                @endif
            </td>
            <td>
                @if ($data->tanggal_approval === null)
                    <span class="badge bg-secondary">Belum di Approve</span>
                @else
                    {{ \Carbon\Carbon::parse($data->tanggal_approval)->translatedFormat('d F Y') }}
                @endif
            </td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('movie-edit-movies',['id' => $data->movie_id]) }}" class="btn btn-primary"> <i class="bi bi-pencil-square"></i> </a>
                    <form action="{{ route('movie-delete-movies',['id'=>$data->movie_id]) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Apakah Yakin?')"><i class="bi bi-trash"></i><span data-feather="x-circle"></span></button>
                        @method('delete')
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <div>
        Showing
        {{ $data_movie->firstItem() }}
        to
        {{ $data_movie->lastItem() }}
        total
        {{ $data_movie->total() }}
    </div>
    <style>
        .pull-right{
            margin-left: 90%;
        }
    </style>
    <div class="pull-right" >
        {{ $data_movie->links() }}
    </div>
</div>
</div>
 
@endsection
