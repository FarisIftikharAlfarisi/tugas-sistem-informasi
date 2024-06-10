@extends('layouts.main')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cinema Seat Booking</title>
        <style>
            .seat {
                width: 40px;
                height: 40px;
                margin: 5px;
                border: 1px solid #ccc;
                background-color: #eee;
                text-align: center;
                line-height: 40px;
                cursor: pointer;
            }

            .seat.selected {
                background-color: #ffcc00;
            }

            .seat.booked {
                background-color: #c54c4c;
                cursor: not-allowed;
            }

            .seat.available:hover {
                background-color: #66ccff;
            }
        </style>
    </head>

    <body>

        <h2>Select Your Seats</h2>
        <p>Please click on the seats you wish to book:</p>

        <div id="seats">
            @foreach ($seats as $seat)
                <div class="seat {{ $seat->status_kursi === 'available' ? 'available' : 'booked' }}"
                    data-seat="{{ $seat->id_kursi }}">
                    {{ $seat->section }}{{ $seat->number }}
                </div>
            @endforeach
        </div>

        <form action="{{ route('cashier-order-process') }}" method="POST" id="booking-form">
            @csrf
            <input type="hidden" name="selectedSeats" id="selected-seats-input">
            <button type="button" onclick="bookSeats()">Book Selected Seats</button>
        </form>

        <script>
            // Function to toggle seat selection
            function toggleSeat(seatElement) {
                if (seatElement.classList.contains('booked')) {
                    return; // Don't allow selection of booked seats
                }
                seatElement.classList.toggle('selected');
            }

            // Function to handle seat booking
            function bookSeats() {
                const selectedSeats = document.querySelectorAll('.seat.selected');
                const seatsToBook = Array.from(selectedSeats).map(seat => seat.dataset.seat);

                // Set the value of hidden input with the selected seats
                document.getElementById('selected-seats-input').value = JSON.stringify(seatsToBook);

                // Submit the form
                document.getElementById('booking-form').submit();
            }
            ko
        </script>
    </body>

    </html>
@endsection
