@extends('layouts.main')
@section('content')
<form id="ticketForm" action="{{ route('cashier-order-process') }}" method="POST">
    @csrf
    <label for="seats">Choose your seats:</label><br>
    <div id="seat-map">
        <!-- Gambarkan kursi di sini -->
        @foreach(range('A', 'H') as $row)
            <div class="row">
                @foreach(range(1, 14) as $num)
                <div class="col">
                    @php
                        $seat = $row . $num;
                    @endphp
                    <button type="button" class="seat-button" data-seat="{{ $seat }}" onclick="toggleSeat('{{ $seat }}')">
                        {{ $seat }}
                    </button>
                </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <br>
    <input type="hidden" name="seats" id="seatsInput">
    <button type="submit">Book Now</button>
</form>

<style>
    .row { display: flex; }
    .seat-button { margin: 5px; padding: 10px; border-radius: 5px; background-color: #fff; border: 1px solid #ccc; }
    .seat-button.selected { background-color: #4CAF50; color: white; }
</style>

<script>
    let selectedSeats = [];

    function toggleSeat(seat) {
        const seatButton = document.querySelector(`button[data-seat="${seat}"]`);
        if (selectedSeats.includes(seat)) {
            selectedSeats = selectedSeats.filter(s => s !== seat);
            seatButton.classList.remove('selected');
        } else {
            selectedSeats.push(seat);
            seatButton.classList.add('selected');
        }
        document.getElementById('seatsInput').value = selectedSeats.join(',');
    }
</script>
@endsection
