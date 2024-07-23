<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\MovieSchedule;
use App\Models\RegisteredMovies;
use Illuminate\Support\Facades\DB;


class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        $orders = Orders::all();
        $unique_receipt_numbers = $orders->unique('receipt_number');
        $unique_receipt_numbers = $unique_receipt_numbers->sortByDesc('receipt_number')->take(5);

        $sql = "
            SELECT registered_movies.judul AS judul,
                COUNT(orders.order_id) AS jumlah_penjualan_tiket,
                SUM(CAST(orders.total_payment AS DECIMAL(10,2))) AS total_pemasukan
            FROM orders
            JOIN movie_schedules ON orders.schedule_id = movie_schedules.schedule_id
            JOIN registered_movies ON movie_schedules.movies_id = registered_movies.movie_id
            GROUP BY registered_movies.judul
            ORDER BY jumlah_penjualan_tiket DESC
        ";

        $topMovies = DB::select($sql);

        $order = Orders::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(total_payment) as total_sales'),
            DB::raw('COUNT(no_kursi) as total_customers')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Format data untuk dikirim ke view
        $months = $order->pluck('month');
        $sales = $order->pluck('total_sales');
        $customers = $order->pluck('total_customers');

        return view('manager.dashboard.index', [
            'title' => 'Dashboard',
            'orders' => $orders,
            'unique_receipt_numbers' => $unique_receipt_numbers,
            'topMovies' => $topMovies,
            'months' => $months,
            'sales' => $sales,
            'customers' => $customers
        ]);
    }

    //view untuk movies

    public function movies_view()
    {
        $data_movie = RegisteredMovies::where('status_approval','=',null)->get();
        return view('manager.update-status-movie',['title'=>'Movies'],compact(['data_movie']));
    }

    public function all_movies(){
        $data_movie = RegisteredMovies::orderBy('created_at','asc')->get();
        return view('manager.manager-movie-list',['title'=>'All Movies'], compact([ 'data_movie']));
    }

    public function all_schedule(){
        $data_schedule = MovieSchedule::orderBy('created_at','asc')->get();
        return view('manager.manager-schedule-list',['title'=>'schedule'] ,compact(['data_schedule']));
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

        // dd($movie['status_approval']);

        $movie['tanggal_approval'] = Carbon::now('Asia/Jakarta')->toDateString();

        // dd($movie['status_approval'],$movie['tanggal_approval']);

        $movie->update();

        return redirect()->route('movie-list')->with('success','film telah di update');
    }

    public function update_status_approval_schedule(Request $request, $id){
        $request->validate([
            'status_approval' => 'required'
        ]);

        $schedule = MovieSchedule::find($id);
        $schedule['status_approval'] = $request->status_approval;
        $schedule['tanggal_approval'] = Carbon::now('Asia/Jakarta')->toDateString();

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
