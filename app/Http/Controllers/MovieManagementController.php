<?php

namespace App\Http\Controllers;

use App\Models\MovieSchedule;
use App\Models\Theater;
use App\Models\RegisteredMovies;
use App\Models\Seats;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
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

    //movies controlling pindah ke controller FilmController
    //start of movies controlling
    // public function movies(){
    //     $data_movie = RegisteredMovies::all();
    //     $title = "New Movies | Movie Management";
    //     return view('movie.dashboard-movies',compact('title', 'data_movie'));
    // }

    // public function create_movies(){
    //     $title = "New Movies | Movie Management";
    //     return view('movie.create-film',compact('title'));
    // }

    // public function edit_movies($id){
    //     $title = "Edit Movies | Movie Management";
    //     $data_movie = RegisteredMovies::find($id);
    //     return view('movie.edit-film',compact(['title','data_movie']));
    // }

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

    // public function delete_movies($id){
    //     RegisteredMovies::where('id_movie', $id)->delete();
    //     return redirect()->route('movie-movies')->with('success', 'Film Berhasil Dihapus!');
    // }
    /**
     * below is Theather Controlling section
    */


    //start of theater controlling
    public function theater(){
        $title = "Theater | Movie Management";
        $data_studio = Theater::paginate(10);
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
        return redirect()->route('movie-theater')->with('success','Perubahan berhasil disimpan');
    }

    //end of theater controlling


    //schedule controlling

    public function schedule(){
        $data_schedule = MovieSchedule::where('status_approval','Approved')->paginate(10); #belum ada query untuk approal
        return view('movie.dashboard-schedule',['title'=>'Schedule | Movie Management '], compact(['data_schedule']));
    }

    public function create_schedule(){
        $title = 'New Schedule | Movie Management';
        $data_movies = RegisteredMovies::where('status_approval','Approved')->get(); //belum ada query approval
        $data_studio = Theater::all();
        return view('movie.create-schedule',compact(['title','data_studio','data_movies']));
    }

    public function edit_schedule($id) {
        $title = 'Edit Schedule | Movie Management';
        $data_schedule = MovieSchedule::with(['movie', 'theater'])->findOrFail($id);
        $movies = RegisteredMovies::all();
        $studios = Theater::all();

        return view('movie.edit-schedule', compact('title', 'data_schedule', 'movies', 'studios'));
    }

    // public function get_movies(){
    //     $movies = RegisteredMovies::where('judul', 'LIKE', '%' . request('q') . '%')->paginate(10);
    //     $results = [];

    //     foreach ($movies as $movie) {
    //         $results[] = [
    //             'id' => $movie->movie_id,
    //             'judul' => $movie->judul
    //         ];
    //     }

    //     return response()->json(['results' => $results]);
    // }

    public function store_schedule(Request $request){
        $validator = Validator::make($request->all(), [
            'selected_movies' => 'required',
            'selected_studio' => 'required',
            'show_start' => 'required|date_format:H:i',
            'show_end' => 'required|date_format:H:i',
        ]);

        // dd(request()->all());

        $time_start = $request->show_start;
        $time_end = $request->show_end;

        $parser_time_start = Carbon::parse($time_start);
        $to_time_start =$parser_time_start->format('H:i:s');

        $parser_time_end = Carbon::parse($time_end);
        $to_time_end =$parser_time_end->format('H:i:s');

        // dd([gettype($parser_time_start),$to_time_start, gettype($to_time_start)]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $data['movies_id'] = $request['selected_movies'];
        $data['theaters_id'] = $request['selected_studio'];
        $data['show_start'] = $to_time_start;
        $data['show_end'] = $to_time_end;
        $data['status_approval'] = null;
        $data['tanggal_approval'] = null;

        MovieSchedule::create($data);

        return redirect()->route('schedule-index')->with('success','Jadwal Berhasil Dibuat');
    }

    public function update_schedule(Request $request, $id) {
        // Validate the incoming request data
        $request->validate([
            'selected_movies' => 'required|exists:registered_movies,movie_id',
            'selected_studio' => 'required|exists:theaters,theater_id',
            'show_start' => 'required|date_format:H:i',
            'show_end' => 'required|date_format:H:i|after:show_start',
        ]);

        // Find the existing schedule
        $schedule = MovieSchedule::findOrFail($id);

        $time_start = $request->show_start;
        $time_end = $request->show_end;

        $parser_time_start = Carbon::parse($time_start);
        $to_time_start =$parser_time_start->format('H:i:s');

        $parser_time_end = Carbon::parse($time_end);
        $to_time_end =$parser_time_end->format('H:i:s');

        // Update the schedule with the validated data
        $schedule->update([
            'movies_id' => $request->input('selected_movies'),
            'theaters_id' => $request->input('selected_studio'),
            'show_start' => $to_time_start,
            'show_end' => $to_time_end,
        ]);

        // Redirect back with a success message
        return redirect()->route('schedule-index', ['id' => $id])->with('success', 'Perubahan Jadwal Berhasil Disimpan.');
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
    public function delete_schedule($id)
    {
        MovieSchedule::where('schedule_id', $id)->delete();
        return redirect()->route('schedule-index')->with('success', 'Jadwal Berhasil Dihapus!');
    }
}
