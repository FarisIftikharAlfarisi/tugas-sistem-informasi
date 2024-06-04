<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('movie.dashboard-movies',['title'=>'Movie Management']);
    }

    //start of movies controlling
    public function movies()
    {
        $title = "New Movies | Movie Management";
        return view('movie.index',compact('title'));
    }
    public function create_movies()
    {
        $title = "New Movies | Movie Management";
        return view('movie.create-film',compact('title'));
    }

    //end of movies controlling

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
        $data_studio = Theater::find($id);
        return view('theater.edit',compact(['title','data_studio']));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
