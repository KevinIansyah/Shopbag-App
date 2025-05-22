<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Invoice Order #{{ $order->midtrans_order_id }}</title>
  <style>
    body {
      font-family: 'Nunito', sans-serif;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      background-color: white;
    }

    .header {
      padding: 10px 20px;
      background-color: rgb(239, 68, 68);
      color: white;
      text-align: start;
    }

    .header h1 {
      margin: 0;
      font-size: 24px;
    }

    .invoice-info {
      padding: 20px;
      border-bottom: 1px solid #eee;
    }

    .invoice-info table {
      width: 100%;
    }

    .invoice-info td {
      padding: 5px 0;
    }

    .invoice-info .label {
      font-weight: bold;
      width: 150px;
    }

    .content {
      padding: 20px;
    }

    .content h2 {
      font-size: 18px;
      margin-bottom: 15px;
      border-bottom: 1px solid #eee;
      padding-bottom: 5px;
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

    .order-details th,
    .order-details td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    .order-details th {
      background-color: #f2f2f2;
    }

    .total-section {
      margin-top: 20px;
      text-align: right;
    }

    .total-section table {
      width: 300px;
      margin-left: auto;
    }

    .total-section th,
    .total-section td {
      padding: 5px 10px;
      text-align: right;
    }

    .total-row {
      font-weight: bold;
      font-size: 16px;
      border-top: 2px solid #333;
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

<body>
  <div class="container">
    <div class="header">
      <h1>INVOICE</h1>
      <p>Shopbag</p>
    </div>

    <div class="invoice-info">
      <table>
        <tr>
          <td class="label">Invoice Number:</td>
          <td>INV-{{ $order->midtrans_order_id }}</td>
          <td class="label">Date:</td>
          <td>{{ $order->created_at->format('d M Y') }}</td>
        </tr>
        <tr>
          <td class="label">Order Number:</td>
          <td>{{ $order->midtrans_order_id }}</td>
          <td class="label">Status:</td>
          <td>{{ ucfirst($order->status) }}</td>
        </tr>
      </table>
    </div>

    <div class="content">
      <div class="customer-info">
        <h2>Customer Information</h2>
        <table>
          <tr>
            <td class="label">Name:</td>
            <td>{{ $user->name }}</td>
          </tr>
          <tr>
            <td class="label">Email:</td>
            <td>{{ $user->email }}</td>
          </tr>
          <tr>
            <td class="label">Delivery Address:</td>
            <td>
              {{ $order->address->recipient_name }}
              ({{ $order->address->recipient_contact }})<br>
              {{ $order->address->address }}<br>
              {{ $order->address->city }}, {{ $order->address->province }}
            </td>
          </tr>
        </table>
      </div>

      <h2>Order Details</h2>
      <div class="order-details">
        <table>
          <tr>
            <th>Product</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
          @foreach ($order->orderItems as $item)
            <tr>
              <td>{{ $item->product->name }}</td>
              <td>{{ $item->stock->size->name }}</td>
              <td>{{ $item->quantity }}</td>
              <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
          @endforeach
        </table>
      </div>

      <div class="total-section">
        <table>
          <tr>
            <td>Subtotal:</td>
            <td>Rp
              {{ number_format($order->orderItems->sum(function ($item) {return $item->price * $item->quantity;}),0,',','.') }}
            </td>
          </tr>
          <tr>
            <td>Shipping:</td>
            <td>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
          </tr>
          @if ($order->discount > 0)
            <tr>
              <td>Discount:</td>
              <td>-Rp {{ number_format($order->discount, 0, ',', '.') }}</td>
            </tr>
          @endif
          <tr class="total-row">
            <td>Total:</td>
            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="footer">
      <p>Thank you for shopping at Shopbag!</p>
      <p>Surabaya, East Java, Indonesia</p>
      <p>If you have any questions, please contact us at shopbag@gmail.com</p>
    </div>
  </div>
</body>

</html>
