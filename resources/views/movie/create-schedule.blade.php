@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title text-center">Buat Jadwal Baru </h5>

      <!-- Horizontal Form -->
      <form action="{{ route('store-schedule') }}" method="POST">
        @csrf
        <div class="row mb-3">
          <label for="select" class="col-sm-2 col-form-label">Pilih film</label>
          <div class="col-sm-7">
            <select class="form-select" name="selected_movies">
                <option value="unfilled">  </option>
                @foreach ($data_movies as $item)
                    <option value="{{ $item->movie_id }}"> {{ $item->judul }} </option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Studio</label>
          <div class="col-sm-7">
           <select class="form-select" name="selected_studio">
               <option value="unfilled">  </option>
                @foreach ($data_studio as $item)
                    <option value="{{ $item->theater_id }}"> {{ $item->nama_theater }} </option>
                @endforeach
           </select>
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


