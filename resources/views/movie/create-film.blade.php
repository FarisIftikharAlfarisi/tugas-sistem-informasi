@extends('layouts.main')
@section('content')
    <div class="row">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12 gap-3">

                <div class="card">
                    <div class="card-title text-center"> Tambah Film Baru</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Poster </label>
                                <input type="file" class="form-control mt-2" id="poster" name="poster"
                                    placeholder="Pilih Poster">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Judul Film">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="" class="form-label">Sutradara</label>
                                <input type="text" class="form-control" id="sutradara" name="sutradara">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Produser</label>
                                <input type="text" class="form-control" id="produser" name="produser">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="" class="form-label">Bahasa</label>
                                <input type="text" class="form-control" id="bahasa" name="bahasa">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Bahasa Subtitle</label>
                                <input type="text" class="form-control" id="bahasa_sub" name="bahasa_sub">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="" class="form-label">Genre</label>
                                <select id="genre" name="genre" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Sensor</label>
                                <select id="sensor" name="sensor" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="" class="form-label"> Mulai</label>
                                <input class="form-control" type="text" id="datetime_start" name="mulai_tayang" />
                            </div>

                            <div class="col-md-4">
                                <label for="" class="form-label"> Selesai </label>
                                <input class="form-control" type="text" id="datetime_end" name="selesai_tayang" />
                            </div>
                        </div>

                        <div class="card shadow-none">
                            <div class="card-body">
                                <div class="card-title">  </div>
                                <label for=""> Deskripsi Film </label>
                                <!-- Quill Editor Default -->
                                <div name="deskripsi" class="quill-editor-default">

                                </div>
                                <!-- End Quill Editor Default -->

                            </div>
                        </div>

                        <div class="text-center">
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
