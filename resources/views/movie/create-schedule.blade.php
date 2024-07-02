@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title text-center">Buat Jadwal Baru </h5>

      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

      <!-- Horizontal Form -->
      <form action="{{ route('store-schedule') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
          <label for="select" class="col-sm-2 col-form-label">Pilih film</label>
          <div class="col-sm-7">
            <select class="form-select @error('selected_movies') is-invalid @enderror" name="selected_movies">
                <option value="unfilled">  </option>
                @foreach ($data_movies as $movies)
                    <option value="{{ $movies->movie_id }}"> {{ $movies->judul }} </option>
                @endforeach
            </select>
            @error('selected_movies')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Studio</label>
          <div class="col-sm-7">
           <select class="form-select @error('selected_movies') is-invalid @enderror" name="selected_studio">
               <option value="unfilled">  </option>
                @foreach ($data_studio as $studio)
                    <option value="{{ $studio->theater_id }}"> {{ $studio->nama_theater }} </option>
                @endforeach
           </select>
           @error('selected_studio')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-2">
                <span class="mt-2">Jam Tayang</span>
            </div>
          <label for="" class="col-sm-2 col-form-label">Mulai</label>
          <div class="col-sm-2">
            <input type="time" name="show_start" class="form-control @error('show_start')
                is-invalid
            @enderror" >
            @error('show_start')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <label for="" class="col-sm-2 col-form-label">Selesai</label>
          <div class="col-sm-2">
            <input type="time" name="show_end" class="form-control @error('show_start')
                is-invalid
            @enderror" >
            @error('show_end')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- End Horizontal Form -->

    </div>
  </div>
@endsection


