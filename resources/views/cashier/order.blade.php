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
            background-color: #ccc;
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
        <div class="d-flex">
            <div class="seat available" data-seat="A1" onclick="toggleSeat(this)">A1</div>
            <div class="seat available" data-seat="A2" onclick="toggleSeat(this)">A2</div>
            <div class="seat available" data-seat="A3" onclick="toggleSeat(this)">A3</div>
            <div class="seat available" data-seat="A4" onclick="toggleSeat(this)">A4</div>
            <div class="seat available" data-seat="A5" onclick="toggleSeat(this)">A5</div>
            <div class="seat available" data-seat="A6" onclick="toggleSeat(this)">A6</div>
            <div class="seat available" data-seat="A7" onclick="toggleSeat(this)">A7</div>
            <div class="seat available" data-seat="A8" onclick="toggleSeat(this)">A8</div>
        </div>
        <div class="d-flex">
            <div class="seat available" data-seat="B1" onclick="toggleSeat(this)">B1</div>
            <div class="seat available" data-seat="B2" onclick="toggleSeat(this)">B2</div>
            <div class="seat available" data-seat="B3" onclick="toggleSeat(this)">B3</div>
            <div class="seat available" data-seat="B4" onclick="toggleSeat(this)">B4</div>
            <div class="seat available" data-seat="B5" onclick="toggleSeat(this)">B5</div>
            <div class="seat available" data-seat="B6" onclick="toggleSeat(this)">B6</div>
            <div class="seat available" data-seat="B7" onclick="toggleSeat(this)">B7</div>
            <div class="seat available" data-seat="B8" onclick="toggleSeat(this)">B8</div>
        </div>
        <!-- Add more fixed seats here -->
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
        }ko
    </script>
</body>
</html>

@endsection
