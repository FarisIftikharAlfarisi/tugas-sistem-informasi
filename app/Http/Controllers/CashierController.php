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
use Illuminate\Support\Facades\Validator;
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

    public function order()
    {
        $data_movie = RegisteredMovies::where('status_approval','=','Approved')->get();
        return view('cashier.order',['title' => 'Order - Cashier Dashboard'], compact(['data_movie']));
    }

    public function order_seat($id)
    {
        $data_schedule = MovieSchedule::where('movies_id','=',$id)->get();
        $data_movie = RegisteredMovies::where('status_approval','=','Approved')->where('movie_id',$id)->first();
        $reservedSeats = Orders::where('status_kursi', 'reserved')
                           ->pluck('no_kursi')
                           ->toArray();

        $currentTime = Carbon::now()->setTimezone('Asia/Jakarta');
        $schedules = MovieSchedule::where('show_start', '<', $currentTime)->get();

        foreach ($schedules as $schedule) {
            // Update status kursi menjadi 'available' berdasarkan schedule_id
            Orders::where('schedule_id', $schedule->schedule_id)
                ->where('status_kursi', 'reserved')
                ->update(['status_kursi' => 'available']);
        }
        return view('cashier.order-seats',['title' => 'Order Seat for movie'],compact(['data_movie','data_schedule','reservedSeats']));
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
                'current_time' => Carbon::now('Asia/Jakarta')->format('his'),
                'metode_pembayaran' => $validatedData['metode_pembayaran'],
                'status_pembayaran'=> $isSuccess
            ];
            Orders::create($data);
        }

        return redirect()->route('cashier-index')->with('success','Transaksi Berhasil!');
    }

    public function cetak_struk($receipt_number)
{
    $data_orders = Orders::where('receipt_number', $receipt_number)->get();
    $title = "Cashier | Cetak Struk";
    return view('cashier.cetak-struk', compact('title', 'data_orders'));
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
