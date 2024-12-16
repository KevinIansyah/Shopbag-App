<!-- resources/views/mail/confirmationPayment.blade.php -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Konfirmasi Pembayaran</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
    }

    .header {
      background-color: #4CAF50;
      color: #fff;
      padding: 15px;
      text-align: center;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

    .content {
      padding: 20px;
    }

    .footer {
      text-align: center;
      padding: 10px;
      font-size: 0.9em;
      color: #777;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      color: #fff;
      background-color: #4CAF50;
      border-radius: 5px;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>Konfirmasi Pembayaran</h2>
    </div>
    <div class="content">
      <p>Halo, {{ $user->name }}</p>
      <p>Terima kasih atas pembelian Anda! Berikut adalah rincian pembayaran Anda:</p>

      <h4>Detail Pembayaran:</h4>
      <ul>
        <li><strong>ID Order:</strong> {{ $order->id }}</li>
        <li><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</li>
        <li><strong>Status Pembayaran:</strong> {{ ucfirst($order->status) }}</li>
      </ul>

      <h4>Detail Produk:</h4>
      <ul>
        @foreach ($order->orderItems as $item)
          <li>
            <strong>Produk:</strong> {{ $item->product->name }}<br>
            <strong>Ukuran:</strong> {{ $item->stock->size->name }}<br>
            <strong>Jumlah:</strong> {{ $item->quantity }}<br>
            <strong>Harga:</strong> Rp {{ number_format($item->price, 0, ',', '.') }}
          </li>
        @endforeach
      </ul>

      <p>Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi kami.</p>

      <a href="http://127.0.0.1:8000/profile?p=order-history" class="btn">Lihat Pesanan Anda</a>
    </div>
    <div class="footer">
      <p>&copy; {{ date('Y') }} Zalfeet. All rights reserved.</p>
    </div>
  </div>
</body>

</html>
