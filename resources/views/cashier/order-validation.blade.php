@extends('layouts.main')

@section('content')
<h1>Order Validation</h1>
<hr>
    <div class="card rounded">

        <table class="table mt-2">
            @foreach ($data_order as $item)
            @if ($loop->first)
            <tr>
                <td>Jumlah Tiket</td>
                <td>{{ $item->amount }}</td>
            </tr>
            <tr>
                <td>Total Pembayaran</td>
                <td>{{ $item->total_payment }}</td>
            </tr>
            @endif
            @endforeach
            @foreach ($data_kursi as $kursi)
            <tr>
                <td>Nomor Kursi</td>
                    <td> </td><span> {{ $kursi }} </span>
            </tr>
            @endforeach
            </table>
    </div>

    <form action="#" method="post">
        @csrf
        <select name="metode_pembayaran" id="metode_pembayaran">
            <option value="null">Pilih Metode Pembayaran</option>
            <option value="CASH">Cash</option>
            <option value="QRIS">QRIS</option>
        </select>
    </form>

    <div id="qris-container" style="display:none; width:18rem;">
        <img id="qris-image" src="{{ asset('storage/img/add-on/QR_dana_faris.jpeg') }}" alt="QRIS">
    </div>

    <script>
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
