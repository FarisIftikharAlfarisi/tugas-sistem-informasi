@extends('layouts.main')
@section('content')
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if ($data_movie->isEmpty())
    <h1 class="text-center">No Request</h1>
@else




<div class="card mt-2">
    <table class="table">
        <tr>
            {{-- <th>Poster</th> --}}
            <th>Judul</th>
            <th>Genre</th>
            <th>Sensor</th>
            <th>Status Approve</th>
            <th>Tanggal Update</th>
            <th>Aksi</th>
        </tr>
        @foreach($data_movie as $data)
        <tr>
            {{-- <td> <img src="{{ asset('storage/img/posters/' . $data->poster) }}" class="img-fluid rounded-start" style="max-width: 100px"> </td> --}}
            <td>{{ $data->judul }}</td>
            <td>{{ $data->genre }}</td>
            <td>{{ $data->sensor }}</td>
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
                    {{-- <a href="{{ route('movie-edit-movies',['id' => $data->movie_id]) }}" class="btn btn-primary"> <i class="bi bi-pencil-square"></i> </a> --}}
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#basicModal{{ $data->movie_id }}">
                        <i class="bi bi-card-list text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"></i>
                    </button>
                    <div class="modal fade" id="basicModal{{ $data->movie_id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Detail Film </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex">
                                    <div class="me-auto">
                                        <img src="{{ asset('storage/img/posters/' . $data->poster) }}" class="img-fluid rounded-start position-relative top-50 start-50 translate-middle px-3" style="max-width: 18rem; width:18rem;">
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>Judul</td>
                                            <td><strong>{{ $data->judul }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Sutradara</td>
                                            <td><strong>{{ $data->sutradara }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Produser</td>
                                            <td>{{ $data->produser }}</td>
                                        </tr>
                                        <tr>
                                            <td>Genre</td>
                                            <td>{{ $data->genre }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sensor</td>
                                            <td>{{ $data->sensor }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bahasa Film</td>
                                            <td>{{ $data->bahasa }}</td>
                                        </tr>
                                        <tr>
                                            <td>Subtitle</td>
                                            <td>{{ $data->bahasa_subtitle }}</td>
                                        </tr>
                                        <tr>
                                            <td>Harga per tiket</td>
                                            <td>Rp.{{ number_format($data->harga, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Durasi</td>
                                            <td>{{ $data->durasi }} Menit</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi</td>
                                            <td>{{ $data->deskripsi }}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('update-status-approval-film',['id' => $data->movie_id]) }}" method="post">
                                    @csrf
                                    <input type="text" name="status_approval" value="Rejected" hidden>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-bookmark-x"></i>
                                        <span>Reject</span>
                                    </button>
                                </form>
                                <form action="{{ route('update-status-approval-film',['id' => $data->movie_id]) }}" method="post">
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
                    {{-- <form action="{{ route('movie-delete-movies',['id'=>$data->movie_id]) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Apakah Yakin?')" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="bi bi-trash"></i><span data-feather="x-circle"></span></button>
                        @method('delete')
                    </form> --}}
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
</div>
@endif
@endsection
