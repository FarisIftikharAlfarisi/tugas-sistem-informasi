@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Studio Baru</h5>

              <!-- Horizontal Form -->
              <form action="{{ route('store-theater') }}" method="POST">
                @csrf
                <div class="row mb-3">
                  <label for="" class="col-sm-2 col-form-label">Nama Studio</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_theater" name="nama_theater">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-md-4">
                    <select id="genre" name="status" class="form-select form-control">
                        <option value="unfilled">Choose...</option>
                        <option value="available">available</option>
                        <option value="maintainance">maintainance</option>
                        <option value="closed">closed</option>
                    </select>
                </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="reset" class="btn btn-secondary">Batal</button>
                </div>
              </form><!-- End Horizontal Form -->

            </div>
          </div>
    </div>
</div>
@endsection
