<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Seats;
use App\Models\orders;
use Illuminate\Http\Request;
use App\Models\MovieSchedule;
use App\Models\RegisteredMovies;
use Carbon\Carbon;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Spatie\Backtrace\Arguments\Reducers\DateTimeZoneArgumentReducer;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_orders = Orders::orderBy('created_at', 'DESC')->paginate(20);
        $unique_receipt_numbers = $data_orders->unique('receipt_number');
        return view('cashier.index', [
            'title' => 'Cashier Dashboard',
            'data_orders' => $data_orders,
            'unique_receipt_numbers' => $unique_receipt_numbers
        ]);
    }

    public function  update_jam(Request $request){
        $data = $request->all();

        $data_time = Orders::selectRaw('DATE_FORMAT(created_at, "%H:%i:%s") as time_only')
        ->whereDate('created_at', Carbon::today()->setTimezone('Asia/Jakarta'))
        ->get();

        $data_to_update['current_time'] = $data['jam'];
        if($data['jam'] > $data_time){
            Orders::where('time_only')->update($data_to_update);
        }

        return redirect()->route('cashier-order');
    }

    public function order()
    {
        $data_movie = RegisteredMovies::where('status_approval','=','Approved')->get();
        return view('cashier.order',['title' => 'Order - Cashier Dashboard'], compact(['data_movie']));
    }

    public function order_seat($id)
    {
        $data_schedule = MovieSchedule::where('movies_id','=',$id)->get();
        $data_movie = RegisteredMovies::where('status_approval','=','Approved')->where('movie_id',$id)->first();
        $currentTime = Carbon::now()->setTimezone('Asia/Jakarta');
         // Ambil kursi yang dipesan berdasarkan jadwal yang diambil
        //  $reservedSeats = Orders::where('status_kursi', 'reserved')
        //  ->get(['schedule_id', 'no_kursi'])
        //  ->toArray();

        $reservedSeats = Orders::select('schedule_id', 'no_kursi')
        ->get()
        ->toArray();

        $movie_ends_time = MovieSchedule::select('schedule_id', 'show_end')
        ->where('movies_id', $id)
        ->get()
        ->toArray();

        return view('cashier.order-seats',['title' => 'Order Seat for movie'],compact(['data_movie','data_schedule','reservedSeats','movie_ends_time','currentTime']));
    }

    public function save_order(Request $request){
        $validatedData = $request->validate([
            'seats' => 'required|string',
            'selected_schedule' => 'string|required',
            'seat_status' => 'required|string',
            'selected_movies' => 'required',
            'metode_pembayaran' => 'required|string|in:CASH,QRIS'
        ]);

        // dd($validatedData);

        $data_movie = RegisteredMovies::where('movie_id',$validatedData['selected_movies'])->first();
        $data_schedule = MovieSchedule::where('schedule_id',$validatedData['selected_schedule'])->first();

        $seatsArray = explode(',', $validatedData['seats']);

        $amount_seat = count($seatsArray);

        $amount_to_pay = $data_movie['harga'] * $amount_seat;


        $reciept_number = Carbon::now()->format('Ymdhis');
        $film_show_end = $data_schedule->show_end;

        if($validatedData['metode_pembayaran']){
            $isSuccess = 'Berhasil';
        }else{
            $isSuccess = 'Gagal';
        }

        foreach ($seatsArray as $seat) {
            $data = [
                'receipt_number' => $reciept_number ,
                'schedule_id' => $validatedData['selected_schedule'],
                'amount' => $amount_seat,
                'total_payment' => $amount_to_pay,  // Price per seat
                'no_kursi' => $seat,
                'status_kursi' => $validatedData['seat_status'],
                'jam_selesai_film' => $film_show_end,
                'current_time' => Carbon::now()->setTimezone('Asia/Jakarta')->format('h:i:s'),
                'metode_pembayaran' => $validatedData['metode_pembayaran'],
                'status_pembayaran'=> $isSuccess
            ];
            Orders::create($data);
        }

        return redirect()->route('cashier-index')->with('success','Transaksi Berhasil!');
    }

    public function update_order(){

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
