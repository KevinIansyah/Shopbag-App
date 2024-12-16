<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
  <title>Order Confirmation</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Nunito', sans-serif;
      background-color: rgb(239, 68, 68);
      color: #333;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: white;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      padding: 0 20px;
      text-align: start;
    }

    .header img {
      padding: 10px 10px 20px 10px;
      height: 80px;
      background-color: rgb(239, 68, 68);
    }

    .content {
      padding: 20px;
    }

    .content h1 {
      font-size: 22px;
      margin-bottom: 20px;
    }

    .content p {
      line-height: 1.6;
      margin-bottom: 15px;
    }

    .order-details {
      background-color: #f9f9f9;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .order-details .order-id {
      text-transform: uppercase;
    }

    .order-details table {
      width: 100%;
      border-collapse: collapse;
    }

    table tr {
      line-height: 1.6;
    }

    table tr td {
      line-height: 1.6;
    }

    .order-details th,
    .order-details td {
      padding: 10px;
      text-align: left;
    }

    .order-details th {
      background-color: #f2f2f2;
    }

    .button-container {
      text-align: center;
    }

    .button-container a {
      display: inline-block;
      padding: 12px 20px;
      background-color: #000000;
      color: white;
      text-decoration: none;
      border-radius: 4px;
      font-weight: bold;
    }

    .footer {
      text-align: center;
      padding: 20px;
      font-size: 12px;
      color: white;
      background-color: rgb(239, 68, 68);
    }
  </style>
</head>

<body
  style="margin: 0; padding: 30px 0 0 0; font-family: 'Nunito', sans-serif; background-color: rgb(239, 68, 68); color: #333;">
  <div class="container">
    <!-- Header -->
    <div class="header">
      <img src="https://i.postimg.cc/J4W4TNWj/shopbag-2.png" alt="Logo">
    </div>

    <!-- Content -->
    <div class="content">
      <h1>Haii, {{ $user->name }}</h1>
      <p>{{ $message_mail['open_message'] }}</p>

      <!-- Order Details -->
      <div class="order-details">
        <table>
          <tr>
            <th>Order Number</th>
            <td class="order-id">{{ $order->midtrans_order_id }}</td>
          </tr>
          <tr>
            <th>Order Status</th>
            <td class="order-id">{{ $order->status }}</td>
          </tr>
          <tr>
            <th>Order Price</th>
            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
          </tr>
          <tr>
            <th>Delivery Address</th>
            <td>{{ $order->address->recipient_name }}
              ({{ $order->address->recipient_contact }})<br>{{ $order->address->address }}<br>{{ $order->address->city }},
              {{ $order->address->province }}</td>
          </tr>
        </table>
      </div>

      <!-- Product Details -->
      <div class="order-details">
        <table>
          <tr>
            <th>Product</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Price</th>
          </tr>
          @foreach ($order->orderItems as $item)
            <tr>
              <td>{{ $item->product->name }}</td>
              <td>{{ $item->stock->size->name }}</td>
              <td>{{ $item->quantity }}</td>
              <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            </tr>
          @endforeach
        </table>
      </div>

      <p>{{ $message_mail['close_message'] }}</p>

      <!-- Button -->
      <div class="button-container">
        <a href="{{ $message_mail['link'] }}">YOUR ORDER</a>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p style="color: white">Surabaya, East Java, Indonesia</p>
      <p><a href="#" style="color: white;">Unsubscribe</a> | <a href="#" style="color: white;">Privacy
          policy</a> | <a href="#" style="color: white;">Contact us</a></p>
    </div>
  </div>
</body>

</html>
