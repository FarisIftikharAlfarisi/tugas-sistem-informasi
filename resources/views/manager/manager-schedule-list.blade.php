@extends('layouts.main')
@section('content')
<h1>Schedule</h1>
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="card mt-2">
    <table class="table">
        <tr class="text-center">

            <th>#</th>
            <th>Film</th>
            <th>Studio</th>
            <th>Status Approve</th>
            <th>Tanggal Update</th>
        </tr>
        @foreach($data_schedule as $data)
        <tr class="text-center">
            <td>{{ $loop->iteration}}</td>
            <td>{{ $data->movie->judul }}</td>
            <td>{{ $data->theater->nama_theater }}</td>
            <td>
                @if ($data->status_approval === null)
                    <span class="badge bg-secondary">Belum di Approve</span>
                @elseif($data->status_approval === "Ditolak")
                    <span class="badge bg-success">Tidak di approve</span>
                @else
                    <span class="badge bg-success">Di approve</span>
                @endif


            </td>
            <td>
                @if ($data->tanggal_approval === null)
                    <span class="badge bg-secondary">Tidak ada update</span>
                @else
                {{ \Carbon\Carbon::parse($data->tanggal_approval)->translatedFormat('d F Y') }}
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        Showing
        {{ $data_schedule->firstItem() }}
        to
        {{ $data_schedule->lastItem() }}
        total
        {{ $data_schedule->total() }}
    </div>
    <style>
        .pull-right{
            margin-left: 90%;
        }
    </style>
    <div class="pull-right" >
        {{ $data_schedule->links() }}
    </div>
    </div>
</div>

@endsection
