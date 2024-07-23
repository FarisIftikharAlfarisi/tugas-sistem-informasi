<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }

        .ticket {
            max-width: 400px;
            margin: 20px auto;
            border: 2px dashed #333;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .ticket-header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 1.2em;
        }

        .ticket-body {
            padding: 20px;
        }

        .ticket-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ticket-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .ticket-table td:first-child {
            font-weight: bold;
            color: #333;
        }

        .seat-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .seat-button:disabled {
            background-color: #ccc;
            cursor: default;
        }
    </style>
</head>

<body>
    @foreach ($data_orders as $order)
        <div class="ticket">
            <div class="ticket-header">
                CINEMATIX
            </div>
            <div class="ticket-body">
                <table class="ticket-table">
                    <tr>
                        <td>No.Pemesanan</td>
                        <td>{{ $order->receipt_number }}</td>
                    </tr>
                    <tr>
                        <td>Film</td>
                        <td>{{ $order->schedule->movie->judul }}</td>
                    </tr>
                    <tr>
                        <td>Studio</td>
                        <td>{{ $order->schedule->theater->nama_theater }}</td>
                    </tr>
                    <tr>
                        <td>Jadwal</td>
                        <td>{{ \Carbon\Carbon::parse($order->schedule->show_start)->format('H:i') }}</td>
                    </tr>
                    <tr>
                        <td>Kursi</td>
                        <td>
                            {{ $order->no_kursi }}
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah Kursi</td>
                        <td>{{ $order->amount }}</td>
                    </tr>
                    <tr>
                        <td>Harga Tiket</td>
                        <td>{{ $order->schedule->movie->harga }}</td>
                    </tr>
                    <tr>
                        <td>Total Pembayaran</td>
                        <td>{{ $order->total_payment }}</td>
                    </tr>
                </table>
            </div>
        </div>
    @endforeach
    <script type="text/javascript">
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.history.back();
            }, 1000);
        };
    </script>
</body>

</html>
