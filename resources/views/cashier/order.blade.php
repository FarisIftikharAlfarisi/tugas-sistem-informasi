@extends('layouts.main')
@section('content')
    <h1>Movies</h1>
    <h6>Choose Movie To Watch</h6>

    @foreach ($data_movie as $index => $data)
    @if ($index % 4 == 0)
        <div class="row">
    @endif

    <div class="col-3 mt-4">
        <a href="{{ route('cashier-order-seat',['id' => $data->movie_id]) }}">
        <div class="card">
            <img src="{{ asset('storage/img/posters/'.$data->poster) }}" alt="" style="width:240px" srcset="">
            <div class="card-body">
                <h3>{{ $data->judul }}</h3>
                {{-- <p>{{ $data->schedule->show_start }}</p> --}}
            </div>
        </div>
        </a>
    </div>

    @if ($index % 4 == 3)
        </div>
    @endif
@endforeach

@endsection
