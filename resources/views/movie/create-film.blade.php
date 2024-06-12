@extends('layouts.main')
@section('content')
    <div class="row">
        <form action="{{ route('store-movie')  }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-13 gap-3">

                <div class="card">
                    <div class="card-title text-center"> Tambah Film Baru</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Poster </label>
                                <input type="file" class="form-control mt-2 @error ('poster') is-invalid @enderror" id="poster" name="poster"
                                    placeholder="Pilih Poster">
                                @error('poster')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label @error('judul') is-invalid @enderror">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Judul Film" required autofocus value="{{ old('judul') }}">
                                    @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="" class="form-label @error('sutradara') is-invalid @enderror">Sutradara</label>
                                <input type="text" class="form-control" id="sutradara" name="sutradara" required autofocus value="{{ old('sutradara') }}"  placeholder="Nama Sutradara"  >
                                @error('sutradara')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label @error('produser') is-invalid @enderror">Produser</label>
                                <input type="text" class="form-control" id="produser" name="produser" placeholder="Nama Produser" required autofocus value="{{ old('produser') }}">
                                @error('produser')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="" class="form-label @error('bahasa') is-invalid @enderror">Bahasa</label>
                                <input type="text" class="form-control" id="bahasa" name="bahasa" placeholder="Bahasa Asli Film" required autofocus value="{{ old('bahasa') }}">
                                @error('bahasa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label @error('bahasa_sub') is-invalid @enderror">Bahasa Subtitle</label>
                                <input type="text" class="form-control" id="bahasa_sub" name="bahasa_sub" placeholder="Subtitle Film" required autofocus value="{{ old('bahasa_sub') }}">
                                @error('bahasa_sub')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="" class="form-label @error('genre') is-invalid @enderror">Genre</label>
                                <select id="genre" name="genre" class="form-select"  required autofocus value="{{ old('genre') }}">
                                    <option selected></option>
                                    <option>Action</option>
                                    <option>Animation</option>
                                    <option>Comedy</option>
                                    <option>Documenter</option>
                                    <option>Drama</option>
                                    <option>Fantasy</option>
                                    <option>Horror</option>
                                    <option>Musical</option>
                                    <option>Science Fiction (Sci-Fi)</option>
                                    <option>Thriller</option>
                                </select>
                                @error('genre')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label @error('sensor') is-invalid @enderror">Sensor</label>
                                <select id="sensor" name="sensor" class="form-select" required autofocus value="{{ old('sensor') }}">
                                    <option selected></option>
                                    <option>SU (Semua Umur)</option>
                                    <option>A (Anak-anak)</option>
                                    <option>R (Remaja)</option>
                                    <option>D (Dewasa)</option>
                                    <option>BO (Bimbingan Orang Tua)</option>

                                </select>
                                @error('sensor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="" class="form-label @error('mulai_tayang') is-invalid @enderror"> Mulai</label>
                                <input class="form-control" type="text" id="datetime_start" name="mulai_tayang" required autofocus value="{{ old('mulai_tayang') }}">
                                @error('mulai_tayang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="" class="form-label "> Selesai </label>
                                <input class="form-control @error('selesai_tayang') is-invalid @enderror" type="text" id="datetime_end" name="selesai_tayang" required autofocus value="{{ old('selesai_tayang') }}">
                                @error('selesai_tayang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="" class="form-label ">Status</label>
                                <select id="status" name="status" class="form-select" >
                                    <option>none</option>
                                </select>
                            </div>
                            <div class= "col-md-6">
                                <label for="" class="form-label">Tanggal diterima</label>
                                <select id="diterima" name="diterima" class="form-select" >
                                    <option >none</option>
                                </select>
                            </div>
                        <div> --}}

                            </div>
                        </div>
                        <div class="card shadow-none">
                            <div class="card-body">
                                <div class="card-title"></div>
                                <label for=""> Deskripsi Film </label>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                      <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"  {{ old('deskripsi') }} style="height: 100px"></textarea>
                                    </div>
                                </div>

                                <!-- Quill Editor Default
                                <div name="deskripsi" class="quill-editor-default @error('deskripsi') is-invalid @enderror"  {{ old('deskripsi') }} >

                                    @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                              End Quill Editor Default -->

                            </div>
                        </div>


                        <div class="text-center" >
                            <button type="reset" class="btn btn-danger">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
