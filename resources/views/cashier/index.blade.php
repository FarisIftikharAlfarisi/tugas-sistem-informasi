@extends('layouts.main')
@section('content')
@if (session()->has('success'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <i class="bi bi-star me-1"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<h3>Cashier Dashboard</h3>
<hr>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Receipt Number</th>
            <th>Movie</th>
            <th>Schedule</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach($unique_receipt_numbers as $key => $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->receipt_number }}</td>
                <td>{{ $order->schedule->movie->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($order->schedule->show_start)->format('H:i') }}</td>
                <td>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailsModal-{{ $order->receipt_number }}">View Details</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@foreach($unique_receipt_numbers as $order)
<!-- Details Modal -->
<div class="modal fade" id="detailsModal-{{ $order->receipt_number }}" tabindex="-1" aria-labelledby="detailsModalLabel-{{ $order->receipt_number }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-{{ $order->receipt_number }}">Order Details for Receipt Number: {{ $order->receipt_number }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi modal -->
                <table class="table">
                    <tr>
                        <td><strong>No.Pemesanan</strong></td>
                        <td>{{ $order->receipt_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Film</strong></td>
                        <td>{{ $order->schedule->movie->judul }}</td>
                    </tr>
                    <tr>
                        <td><strong>Studio</strong></td>
                        <td>{{ $order->schedule->theater->nama_theater }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jadwal</strong></td>
                        <td>{{ \Carbon\Carbon::parse($order->schedule->show_start)->format('H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kursi</strong></td>
                        <td>
                            @foreach($data_orders as $detail)
                                @if($detail->receipt_number == $order->receipt_number)
                                    <button class="seat-button" >{{ $detail->no_kursi }}</button>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Jumlah Kursi</th>
                            <th>Total Pembayaran</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->total_payment }}</td>
                            <td>{{ $order->metode_pembayaran }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

<style>
    .seat-button { margin: 5px; padding: 10px; border-radius: 5px; background-color: #fff; border: 1px solid #ccc; cursor:default;}
</style>
