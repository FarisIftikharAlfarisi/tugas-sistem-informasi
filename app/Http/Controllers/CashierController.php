<?php

namespace App\Http\Controllers;

use App\Models\RegisteredMovies;
use App\Models\Seats;
use Illuminate\Http\Request;

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
        $data_movie = RegisteredMovies::all();
        $seats = Seats::all();
        return view('cashier.order',['title' => 'Order - Cashier Dashboard'], compact(['seats','data_movie']));
    }
    public function order_seat()
    {
        return view('cashier.order-seats',['title' => 'Order Seat']);
    }

    public function save_order(Request $request){
        $request->validate([
            'seats' => 'required|string'
        ]);

        dd($request->all());
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
