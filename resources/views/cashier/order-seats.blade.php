@extends('layouts.main')
@section('content')

<h3>Order Seat {{ $data_movie->judul }}</h3>
<hr>
<form id="ticketForm" action="{{ route('cashier-order-process') }}" method="POST">
    @csrf
    <label for="seats">Choose your schedule :</label><br>
    @foreach($data_schedule as $item)
    <a href="#" class="schedule-button btn" data-schedule="{{ $item->schedule_id }}" id="select_schedule">
        {{ Carbon\Carbon::parse($item->show_start)->format('H:i') }}
    </a>
    @endforeach

    <hr>

    {{-- <select class="form-control" name="selected_schedule" id="selected_schedule">
        <option value="null" > Pilih Jadwal </option>
        @foreach ($data_schedule as $data_schedule)
            <option value="{{ $data_schedule->schedule_id }}"> Jadwal ke-{{ $loop->iteration }} {{ Carbon\Carbon::parse($data_schedule->show_start)->format('H:i') }} - {{ Carbon\Carbon::parse($data_schedule->show_end)->format('H:i') }} </option>
        @endforeach
        </select> --}}
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
    <input type="hidden" name="selected_schedule" id="selectedScheduleInput">
    <input type="hidden" name="selected_movies" value="{{ $data_movie->movie_id }}">
    <input type="text" name="seat_status" value="reserved" hidden>
    <button type="submit" class="btn btn-primary ms-auto">Book Now</button>
</form>

<style>
    .row { display: flex; }
    .seat-button { margin: 5px; padding: 10px; border-radius: 5px; background-color: #fff; border: 1px solid #ccc; }
    .schedule-button { margin: 5px; padding: 10px; border-radius: 5px; background-color: #fff; border: 1px solid #ccc; }
    .schedule-button.selected { background-color: #4CAF50; color: white; }
    .seat-button.selected { background-color: #4CAF50; color: white; }
    .seat-button.reserved {background-color: #da5050; color: white; cursor:not-allowed }
</style>

<script>
    let selectedSeats = [];
    let selectedSchedule = null;
    let jumlah_kursi = null

    function toggleSeat(seat) {
        const seatButton = document.querySelector(`button[data-seat="${seat}"]`);
        if (seatButton.classList.contains('reserved')) {
            return;
        }

        if (selectedSeats.includes(seat)) {
            selectedSeats = selectedSeats.filter(s => s !== seat);
            seatButton.classList.remove('selected');
        } else {
            selectedSeats.push(seat);
            seatButton.classList.add('selected');
        }
        document.getElementById('seatsInput').value = selectedSeats.join(',');
    }

    function selectSchedule(scheduleId) {
        const scheduleButtons = document.querySelectorAll('.schedule-button');
        scheduleButtons.forEach(button => {
            button.classList.remove('selected');
        });

        const selectedButton = document.querySelector(`.schedule-button[data-schedule="${scheduleId}"]`);
        selectedButton.classList.add('selected');

        selectedSchedule = scheduleId;
        document.getElementById('selectedScheduleInput').value = selectedSchedule;
    }

    document.querySelectorAll('.schedule-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            selectSchedule(this.dataset.schedule);
        });
    });

</script>
@endsection
