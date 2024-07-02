@extends('layouts.main')
@section('content')
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if ($data_schedule->isEmpty())
    <h1 class="text-center">No Request</h1>
@else
<h2 class="h2"> Schedule Request</h2>
<hr>
<div class="card mt-2">
    <table class="table">
        <tr>
            {{-- <th>Poster</th> --}}
            <th>Film</th>
            <th>Theater</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Status Approve</th>
            <th>Tanggal Update</th>
            <th>Aksi</th>
        </tr>
        @foreach($data_schedule as $data)
        <tr>
            {{-- <td> <img src="{{ asset('storage/img/posters/' . $data->poster) }}" class="img-fluid rounded-start" style="max-width: 100px"> </td> --}}
            <td>{{ $data->movie->judul }}</td>
            <td>{{ $data->theater->nama_theater }}</td>
            <td>{{ $data->show_start }}</td>
            <td>{{ $data->show_end }}</td>
            <td>
                @if ($data->status_approval === null)
                    <span class="badge bg-secondary">Belum Update</span>
                @else
                    <span class="badge bg-success">Di Approve</span>
                @endif
            </td>
            <td>
                @if ($data->tanggal_approval === null)
                    <span class="badge bg-secondary">Belum update</span>
                @else
                    {{ $data->tanggal_approve }}
                @endif
            </td>
            <td>
                <div class="d-flex gap-2">

                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#basicModal{{ $data->schedule_id }}">
                        <i class="bi bi-card-text text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Verivikasi"></i>
                    </button>
                    <div class="modal fade" id="basicModal{{ $data->schedule_id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title"> Konfirmasi </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Periksa kembali detail jadwal yang akan diverifikasi :</p>
                                <table class="table">
                                    <tr>
                                        <td>Film</td>
                                        <td>{{ $data->movie->judul }}</td>
                                    </tr>
                                    <tr>
                                        <td>Theater</td>
                                        <td>{{ $data->theater->nama_theater }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jam Mulai Tayang</td>
                                        <td>{{ $data->show_start }}</td>
                                    </tr>
                                    <tr>
                                        <td>Theater</td>
                                        <td>{{ $data->show_end }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('update-status-approval-schedule',['id' => $data->schedule_id]) }}" method="post">
                                    @csrf
                                    <input type="text" name="status_approval" value="Rejected" hidden>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-bookmark-x"></i>
                                        <span>Reject</span>
                                    </button>
                                </form>
                                <form action="{{ route('update-status-approval-schedule',['id' => $data->schedule_id]) }}" method="post">
                                    @csrf
                                    <input type="text" name="status_approval" value="Approved" hidden>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-bookmark-check"></i>
                                        <span>Approve</span>
                                    </button>
                                </form>
                              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                          </div>
                        </div>
                      </div><!-- End Basic Modal-->
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
</div>
@endif
@endsection
