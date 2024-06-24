@extends('layouts.main')
@section('content')
<h1>Schedule</h1>
<a href="{{ route('schedule-new-schedules') }}" class="btn btn-primary"> Buat Jadwal Baru </a>
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
            <th>Aksi</th>
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
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('edit-schedule',['id' => $data->schedule_id]) }}" class="btn btn-primary"> <i class="bi bi-pencil-square"></i> </a>
                    <form action="{{ route('delete-schedule',['id' => $data->schedule_id ]) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Apakah Yakin?')"><i class="bi bi-trash"></i><span data-feather="x-circle"></span></button>
                        @method('delete')
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
</div>

@endsection
