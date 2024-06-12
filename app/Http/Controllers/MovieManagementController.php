<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\RegisteredMovies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class MovieManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('movie.index',['title'=>'Movie Management']);
    }

    //start of movies controlling
    public function movies()
    {
        $data_movie = RegisteredMovies::all();
        $title = "New Movies | Movie Management";
        return view('movie.dashboard-movies',compact('title', 'data_movie'));
    }

    public function create_movies()
    {
        $title = "New Movies | Movie Management";
        return view('movie.create-film',compact('title'));
    }

    public function edit_movies($id){
        $title = "Edit Movies | Movie Management";
        $data_movie = RegisteredMovies::find($id);
        return view('movie.edit-film',compact(['title','data_movie']));
    }

    // public function store_movies(Request $request){
    //     $data = $request->validate([
    //         'poster' => 'required|image|file|max:1024|mimes:jpeg,jpg,png',
    //         'judul' => 'required',
    //         'sutradara' => 'required',
    //         'produser'  => 'required',
    //         'bahasa'  => 'required',
    //         'bahasa_sub'  => 'required',
    //         'genre'  => 'required',
    //         'sensor'  => 'required',
    //         'mulai_tayang'  => 'required',
    //         'selesai_tayang' => 'required',
    //         'deskripsi' => 'required',
    //         'status' => 'required',
    //         'diterima' => 'required'
    //     ]);

    //     $data['poster'] = $request->file('poster')->store('movies-poster');
    //     $data['judul'] = $request->judul;
    //     $data['sutradara'] = $request->sutradara;
    //     $data['produser'] = $request->produser;
    //     $data['bahasa'] = $request->bahasa;
    //     $data['bahasa_subtitle'] = $request->bahasa_sub;
    //     $data['genre'] = $request->genre;
    //     $data['sensor'] = $request->sensor;
    //     $data['show_start'] = $request->mulai_tayang;
    //     $data['show_end'] = $request->selesai_tayang;
    //     $data['deskripsi'] = $request->deskripsi;
    //     $data['status_approval'] = $request->status;
    //     $data['tanggal_approval'] = $request->diterima;

    //     RegisteredMovies::create($data);

    //     //redirect to index
    //     return redirect()->route('movie-movies')->with('success', 'Film Berhasil Ditambahkan!');

    // }
    //end of movies controlling

    public function delete_movies($id)
    {
        RegisteredMovies::where('id_movie', $id)->delete();
        return redirect()->route('movie-movies')->with('success', 'Film Berhasil Dihapus!');
    }
    /**
     * below is Theather Controlling section
    */


    //start of theater controlling
    public function theater(){
        $title = "Theater | Movie Management";
        $data_studio = Theater::all();
        return view('theater.index',compact(['title','data_studio']));
    }
    public function create_theater(){
        $title = "New Theater | Movie Management";
        return view('theater.create-theater',compact('title'));
    }
    public function edit_theater($id){
        $title = "Edit Theater | Movie Management";
        $data_studio = Theater::where('theater_id',$id)->first();
        return view('theater.edit',compact(['title','data_studio']))->with('data',$data_studio);
    }

    public function store_theater(Request $request){
        $validator = Validator::make($request->all(),[
           'nama_theater' => 'required',
           'status' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $data['nama_theater'] = $request->nama_theater;
        $data['status_availability'] = $request->status;

        Theater::create($data);
        return redirect()->route('movie-theater')->with('success','Berhasil menambahkan theater');
    }

    //end of theater controlling


    //schedule controlling

    public function schedule(){
        return view('movie.dashboard-schedule',['title'=>'Schedule | Movie Management ']);
    }
    public function create_schedule(){
        $title = 'New Schedule | Movie Management';
        $data_movie = RegisteredMovies::all();
        return view('movie.create-schedule',compact(['title','data_movie']));
    }

    //end of schedule controlling

    /**
     * Show the form for creating a new resource.
     */

    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $title = "Edit Theater | Movie Management";
        $data_studio = Theater::where('theater_id',$id)->first();
        return view('theater.edit',compact(['title','data_studio']))->with('data',$data_studio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(),[
            'nama_theater' => 'required',
            'status' => 'required'
         ]);

         if($validator->fails()){
             return redirect()->back()->withErrors($validator);
         }

         $data['nama_theater'] = $request->nama_theater;
         $data['status_availability'] = $request->status;

         theater::where('theater_id', $id)->update($data);

         //redirect to index
         return redirect()->to('/dashboard/movie/theater')->with('success', 'Studio Berhasil DiEdit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        theater::where('theater_id', $id)->delete();
        return redirect()->to('/dashboard/movie/theater')->with('success', 'Studio Berhasil Dihapus!');
    }
}
