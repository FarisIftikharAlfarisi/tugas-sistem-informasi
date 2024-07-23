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
                    <button type="button" class="seat-button {{ in_array($seat, $reservedSeats) ? 'reserved' : '' }}" data-seat="{{ $seat }}" onclick="toggleSeat('{{ $seat }}')">
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
    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#confirmModal">Book Now</button>
    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pemesanan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td>Film</td>
                        <td>:</td>
                        <td>{{ $data_movie->judul }}</td>
                    </tr>
                    <tr>
                        <td>Jadwal</td>
                        <td>:</td>
                        <td><span id="modalSchedule"></span></td>
                    </tr>
                    <tr>
                        <td> No. Kursi </td>
                        <td>:</td>
                        <td><span id="modalSeats"></span></td>
                    </tr>
                    <tr>
                        <td> Harga Tiket </td>
                        <td>:</td>
                        <td>{{ $data_movie->harga }}</td>
                    </tr>
                    <tr>
                        <td>Total Bayar</td>
                        <td>:</td>
                        <td><span id="modalTotal"></span></td>
                    </tr>
                    <tr>
                        <td>Metode Pembayaran</td>
                        <td>:</td>
                        <td>
                            <select name="metode_pembayaran" id="metode_pembayaran">
                                <option value="null">Pilih Metode Pembayaran</option>
                                <option value="CASH">Cash</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <div id="qris-container" style="display:none;">
                    <img id="qris-image" width="250px" align="center" src="{{ asset('storage/img/add-on/QR_dana_faris.jpeg') }}" alt="QRIS">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="Submit" class="btn btn-primary" id="confirmBooking">Confirm Order</button>
            </div>
          </div>
        </div>
      </div>
</form>


<style>
    .row { display: flex; }
    .seat-button { margin: 5px; padding: 10px; border-radius: 5px; background-color: #fff; border: 1px solid #ccc; }
    .schedule-button { margin: 5px; padding: 10px; border-radius: 5px; background-color: #fff; border: 1px solid #ccc; }
    .schedule-button.selected { background-color: #4CAF50; color: white; }
    .seat-button.selected { background-color: #4CAF50; color: white; }
    .seat-button.reserved {background-color: #da5050; color: white; cursor:not-allowed }
    .seat-button.not-allowed { cursor: not-allowed; }
</style>

<script>
    let selectedSeats = [];
    let selectedSchedule = null;
    let jumlah_kursi = null
    const ticketPrice = {{ $data_movie->harga }};
    const reservedSeats = @json($reservedSeats);
    const movieEndTimes = @json($movie_ends_time);
    const currentTime = new Date('{{ $currentTime }}');

    function getSeatCoordinates(seat) {
        const row = seat[0];
        const num = parseInt(seat.slice(1));
        return { row, num };
    }

    function areSeatsAdjacent(seat1, seat2) {
        const coord1 = getSeatCoordinates(seat1);
        const coord2 = getSeatCoordinates(seat2);

        // di cek kalau kursinya sebelahan atau nggak
        return coord1.row === coord2.row && Math.abs(coord1.num - coord2.num) === 1;
    }

    function canSelectSeat(seat) {
        if (selectedSeats.length === 0) {
            return true;
        }

        return selectedSeats.some(selectedSeat => areSeatsAdjacent(selectedSeat, seat));
    }

    function toggleSeat(seat) {
        const seatButton = document.querySelector(`button[data-seat="${seat}"]`);
        if (seatButton.classList.contains('reserved') || seatButton.classList.contains('not-allowed')) {
            return;
        }

        if (selectedSeats.includes(seat)) {
            selectedSeats = selectedSeats.filter(s => s !== seat);
            seatButton.classList.remove('selected');
        } else {
            if (canSelectSeat(seat)) {
                selectedSeats.push(seat);
                seatButton.classList.add('selected');
            } else {
                seatButton.classList.add('not-allowed');
                setTimeout(() => seatButton.classList.remove('not-allowed'), 3000);
                return;
            }
        }
        document.getElementById('seatsInput').value = selectedSeats.join(',');
    }

    // function selectSchedule(scheduleId) {
    //     const scheduleButtons = document.querySelectorAll('.schedule-button');
    //     scheduleButtons.forEach(button => {
    //         button.classList.remove('selected');
    //     });

    //     const selectedButton = document.querySelector(`.schedule-button[data-schedule="${scheduleId}"]`);
    //     selectedButton.classList.add('selected');

    //     selectedSchedule = scheduleId;
    //     document.getElementById('selectedScheduleInput').value = selectedSchedule;

    //     // Filter reserved seats based on selected schedule
    //     document.querySelectorAll('.seat-button').forEach(button => {
    //         const seat = button.dataset.seat;
    //         const isReserved = reservedSeats.some(rs => rs.schedule_id == scheduleId && rs.no_kursi == seat);
    //         if (isReserved) {
    //             button.classList.add('reserved');
    //         } else {
    //             button.classList.remove('reserved');
    //         }
    //     });
    // }

    function selectSchedule(scheduleId) {
        const scheduleButtons = document.querySelectorAll('.schedule-button');
        scheduleButtons.forEach(button => {
            button.classList.remove('selected');
        });

        const selectedButton = document.querySelector(`.schedule-button[data-schedule="${scheduleId}"]`);
        selectedButton.classList.add('selected');

        selectedSchedule = scheduleId;
        document.getElementById('selectedScheduleInput').value = selectedSchedule;

        // filter reserved seats berdasarkan data dari database
        document.querySelectorAll('.seat-button').forEach(button => {
            const seat = button.dataset.seat;
            const isReserved = reservedSeats.some(rs => rs.schedule_id == scheduleId && rs.no_kursi == seat);
            if (isReserved) {
                button.classList.add('reserved');
            } else {
                button.classList.remove('reserved');
            }
        });

        // menghapus kelas css reserved kalau current time > jam_selesai_film dari DB
        const endTime = movieEndTimes.find(mt => mt.schedule_id == scheduleId).jam_selesai_film;
        const endTimeDate = new Date(endTime);
        if (currentTime > endTimeDate) {
            document.querySelectorAll('.seat-button.reserved').forEach(button => {
                button.classList.remove('reserved');
            });
        }
    }

    document.querySelectorAll('.schedule-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            selectSchedule(this.dataset.schedule);
        });
    });

    document.querySelector('[data-bs-toggle="modal"]').addEventListener('click', function() {
        const schedule = document.querySelector('.schedule-button.selected').textContent;
        const seats = selectedSeats.join(', ');
        const total = ticketPrice * selectedSeats.length;

        document.getElementById('modalSchedule').textContent = schedule;
        document.getElementById('modalSeats').textContent = seats;
        document.getElementById('modalTotal').textContent = total;
    });

    document.getElementById('metode_pembayaran').addEventListener('change', function() {
        var qrisContainer = document.getElementById('qris-container');
        if (this.value === 'QRIS') {
            qrisContainer.style.display = 'block';
        } else {
            qrisContainer.style.display = 'none';
        }
    });

</script>
@endsection
