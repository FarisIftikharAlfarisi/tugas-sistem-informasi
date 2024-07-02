<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisteredMovies;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data_movie = RegisteredMovies::all();
        $title = "Movie Management";
        return view('movie.index',compact(['title']));
    }

    public function movies()
    {
        $data_movie = RegisteredMovies::all();
        $title = "New Movies | Movie Management";
        return view('movie.dashboard-movies',compact('title', 'data_movie'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "New Movies | Movie Management";
        return view('movie.create-film',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'poster' => 'required|image|file|max:4096|mimes:jpeg,jpg,png,jfif',
            'judul' => 'required',
            'sutradara' => 'required',
            'produser'  => 'required',
            'bahasa'  => 'required',
            'bahasa_sub'  => 'required',
            'genre'  => 'required',
            'sensor'  => 'required',
            'durasi' => 'required',
            'rating' => 'required|string',
            'harga_tiket' => 'required',
            'deskripsi' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $file_poster = $request->file('poster');
        $nama_file = $file_poster->getClientOriginalName();
        $path = 'img/posters/'.$nama_file;

        $data['poster'] = $nama_file;
        $data['judul'] = $request->judul;
        $data['sutradara'] = $request->sutradara;
        $data['produser'] = $request->produser;
        $data['bahasa'] = $request->bahasa;
        $data['bahasa_subtitle'] = $request->bahasa_sub;
        $data['genre'] = $request->genre;
        $data['sensor'] = $request->sensor;
        $data['rating'] = $request->rating;
        $data['durasi'] = $request->durasi;
        $data['harga'] = $request->harga_tiket;
        $data['deskripsi'] = $request->deskripsi;
        $data['status_approval'] = null;
        $data['tanggal_approval'] = null;

        // dd($data);

        Storage::disk('public')->put($path,file_get_contents($file_poster));
        RegisteredMovies::create($data);

        //redirect to index
        return redirect()->route('movie-movies')->with('success', 'Film Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Edit Movies | Movie Management";
        $data_movie = RegisteredMovies::where('movie_id', $id)->first();
        return view('movie.edit-film',compact(['title','data_movie']))->with('data',$data_movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $data = $request->validate([
            'poster' => 'required|image|file|max:1024|mimes:jpeg,jpg,png',
            'judul' => 'required',
            'sutradara' => 'required',
            'produser'  => 'required',
            'bahasa'  => 'required',
            'bahasa_subtitle'  => 'required',
            'genre'  => 'required',
            'sensor'  => 'required',
            'show_start'  => 'required',
            'show_end' => 'required',
            'deskripsi' => 'required',
            'status_approval' => 'required',
            'tanggal_approval' => 'required'
        ]);

        $data['poster'] = $request->file('poster')->store('movies-poster');
        $data['judul'] = $request->judul;
        $data['sutradara'] = $request->sutradara;
        $data['produser'] = $request->produser;
        $data['bahasa'] = $request->bahasa;
        $data['bahasa_subtitle'] = $request->bahasa_subtitle;
        $data['genre'] = $request->genre;
        $data['sensor'] = $request->sensor;
        $data['show_start'] = $request->show_start;
        $data['show_end'] = $request->show_end;
        $data['deskripsi'] = $request->deskripsi;
        $data['status_approval'] = $request->status_approval;
        $data['tanggal_approval'] = $request->tanggal_approval;

        RegisteredMovies::where('movie_id', $id)->update($data);

        //redirect to index
        return redirect()->to('/dashboard/movie/movies')->with('success', 'Film Berhasil DiEdit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $to_remove = RegisteredMovies::find($id);
        $to_remove->delete();
        return redirect()->to('/dashboard/movie/movies')->with('success', 'Film Berhasil Dihapus!');
    }
}
