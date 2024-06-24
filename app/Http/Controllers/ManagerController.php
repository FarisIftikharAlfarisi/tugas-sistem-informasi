<?php

namespace App\Http\Controllers;

use App\Models\MovieSchedule;
use App\Models\RegisteredMovies;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DateTime;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manager.dashboard.index',['title'=>'Dashboard']);
    }

    //view untuk movies

    public function movies_view()
    {
        $data_movie = RegisteredMovies::where('status_approval','=',null)->get();
        return view('manager.update-status-movie',['title'=>'Movies'],compact(['data_movie']));
    }

    //view untuk jadwal
    public function schedule_view()
    {
        $data_schedule = MovieSchedule::where('status_approval','=',null)->get();
        return view('manager.update-status-schedule',['title'=>'Schedule'],compact(['data_schedule']));
    }

    public function update_status_approval(Request $request, $id){
        $request->validate([
            'status_approval' => 'required'
        ]);

        $movie = RegisteredMovies::find($id);
        $movie['status_approval'] = $request->status_approval;
        $movie['tanggal_approval'] = Carbon::now()->toDateString();

        dd($movie['status_approval'],$movie['tanggal_approval']);

        $movie->update();

        return redirect()->route('movie-list')->with('success','film telah di approve');
    }

    public function update_status_approval_schedule(Request $request, $id){
        $request->validate([
            'status_approval' => 'required'
        ]);

        $schedule = MovieSchedule::find($id);
        $schedule['status_approval'] = $request->status_approval;
        $schedule['tanggal_approval'] = Carbon::now()->toDateString();

        // dd($movie['status_approval'],$movie['tanggal_approval']);

        $schedule->update();

        return redirect()->route('schedule-list')->with('success','jadwal telah di approve');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
