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
        return view('cashier.index',['title' => 'Cashier Dashboard']);
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
        return view('cashier.order-seats',['title' => 'Order Seat for movie'],compact(['data_movie','data_schedule']));
    }

    public function order_validation($rn)
    {
        // $data_kursi = [];

        $data_kursi = Orders::where('receipt_number',$rn)->pluck('no_kursi');
        $data_order = Orders::where('receipt_number',$rn)->get();

        return view('cashier.order-validation',['title' => 'order validation'], ['data_order' => $data_order,'data_kursi' => $data_kursi]);
    }

    public function save_order(Request $request){
        $validatedData = $request->validate([
            'seats' => 'required|string',
            'selected_schedule' => 'string|required',
            'seat_status' => 'required|string',
            'selected_movies' => 'required',
        ]);

        $data_movie = RegisteredMovies::where('movie_id',$validatedData['selected_movies'])->first();
        $data_schedule = MovieSchedule::where('schedule_id',$validatedData['selected_schedule'])->first();

        $seatsArray = explode(',', $validatedData['seats']);

        $amount_seat = count($seatsArray);

        $amount_to_pay = $data_movie['harga'] * $amount_seat;


        // $data['no_kursi'] = $validatedData['seats'];
        // $data['status_kursi'] = $validatedData['seat_status'];
        // $data['schedule_id'] = $validatedData['selected_schedule'];
        // $data['total_payment'] = $amount_to_pay;
        // $data['amount'] = $amount_seat;

        $reciept_number = Carbon::now()->format('Ymdhis');
        $film_show_end = $data_schedule->show_end;

        foreach ($seatsArray as $seat) {
            $data = [
                'receipt_number' => $reciept_number ,
                'schedule_id' => $validatedData['selected_schedule'],
                'amount' => $amount_seat,
                'total_payment' => $amount_to_pay,  // Price per seat
                'no_kursi' => $seat,
                'status_kursi' => $validatedData['seat_status'],
                'jam_selesai_film' => $film_show_end
            ];
            $data_order = Orders::create($data);
        }


        $this->order_validation($reciept_number);

        return redirect()->route('cashier-order-validation', ['receipt_number' => $data_order->receipt_number]);
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
