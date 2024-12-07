@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh]">
      <div class="lg:flex lg:gap-4">
        @include('profile.partials.aside')

        <div class="w-full h-auto bg-white dark:bg-gray-800">
          <div class="lg:rounded-lg lg:p-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 pb-6">
              <div class="flex items-center justify-between w-[100%]">
                <div>
                  <h2 class="text-xl font-semibold">Waiting For Payment</h2>
                  <p class="text-sm font-normal">Manage your payment here!</p>
                </div>
                <button data-drawer-target="profile-sidebar" data-drawer-toggle="profile-sidebar"
                  aria-controls="profile-sidebar" type="button"
                  class="w-10 h-10 inline-flex items-center justify-center bg-red-500 hover:bg-red-600  text-white rounded-lg lg:hidden focus:outline-none focus:ring-2 focus:ring-red-300">
                  <span class="sr-only">Open sidebar</span>
                  <i class="fa-sharp fa-regular fa-bars text-base"></i>
                </button>
              </div>
            </div>

            <div class="space-y-4">
              @if ($orders->isEmpty())
                <div class="flex flex-col items-center justify-center">
                  <img class="w-full md:w-[50%]" src="{{ asset('images/no-data.jpg') }}" alt="No data available">
                  <h6 class="text-lg font-semibold text-black">No pending payments!</h6>
                  <p class="text-sm font-normal text-black">You don’t have any orders awaiting payment.</p>
                </div>
              @else
                @foreach ($orders as $order)
                  @php
                    $totalItems = $order->orderItems->sum('quantity');
                    $totalWeight = $order->orderItems->sum(function ($item) {
                        return $item->quantity * $item->product->weight;
                    });
                  @endphp
                  <div class="px-4 pt-4 border border-gray-200 rounded">
                    <div>
                      <div class="flex items-start justify-between flex-col md:flex-row gap-2 mb-3">
                        <div class="mb-3 flex items-start md:items-center flex-col md:flex-row gap-2">
                          <p class="text-sm font-bold uppercase">{{ $order->midtrans_order_id }}</p>
                          <span
                            class="bg-yellow-100 text-yellow-500 text-xs font-medium px-2.5 py-0.5 rounded capitalize">
                            {{ $order->status }}
                          </span>
                        </div>

                        <div class="flex gap-2">
                          <button type="button"
                            class="ring-1 focus:outline-none font-medium rounded-lg text-sm text-red-500 ring-red-500 hover:bg-red-500 hover:text-white px-5 py-2.5 transition-all duration-200">
                            Pay
                          </button>
                          <button type="button" onclick="cancelOrder({{ $order->id }})"
                            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-pointer">
                            Cancel
                          </button>
                        </div>
                      </div>

                      <div class="mb-1 flex flex-col md:flex-row gap-1 md:gap-2">
                        <p class="text-sm font-normal text-black">Recipient : <span
                            class="font-semibold text-black">{{ $order->address->recipient_name }}
                            ({{ $order->address->recipient_contact }})
                          </span>
                        </p>
                        <span class="text-xs font-normal text-gray-500 mb-1 hidden md:block">•</span>
                        <p class="text-sm font-normal text-black">Shipping Address : <span
                            class="font-semibold text-black">{{ $order->address->address }}</span>
                        </p>
                      </div>


                      <div class="mb-1 flex flex-col md:flex-row gap-1 md:gap-2">
                        <p class="text-sm font-normal text-black">Total Price : <span
                            class="font-semibold text-black">{{ 'Rp ' . number_format($order->total_price, 0, ',', '.') }}</span>
                        </p>
                        <span class="text-xs font-normal text-gray-500 mb-1 hidden md:block">•</span>
                        <p class="text-sm font-normal text-black">Total Item : <span
                            class="font-semibold text-black">{{ $totalItems }} pcs</span>
                        </p>
                        <span class="text-xs font-normal text-gray-500 mb-1 hidden md:block">•</span>
                        <p class="text-sm font-normal text-black">Total Weight : <span
                            class="font-semibold text-black">{{ $totalWeight }} gram</span>
                        </p>
                      </div>
                      <p class="text-sm font-normal text-black mb-4">Purchased products :
                      </p>
                    </div>

                    @foreach ($order->orderItems as $orderItem)
                      <div class="space-y-4 md:flex md:items-center md:gap-4 md:space-y-0 border-t border-gray-200 py-4">
                        <div class="shrink-0 md:order-1">
                          <img class="h-16 w-16 square object-cover object-center"
                            src="{{ asset('storage/image-filepond/' . $orderItem->product->images->first()->image_url) }}"
                            alt="imac image" />
                        </div>

                        <div class="w-full md:order-2">
                          <p class="text-sm font-semibold mb-1">{{ $orderItem->product->name }}</p>
                          <p class="text-sm font-semibold text-red-500 mb-1">
                            {{ 'Rp ' . number_format($orderItem->product->price, 0, ',', '.') }} x
                            {{ $orderItem->quantity }}
                            =
                            {{ 'Rp ' . number_format($orderItem->product->price * $orderItem->quantity, 0, ',', '.') }}
                          </p>

                          <div class="flex items-center gap-2">
                            <p class="text-sm font-normal text-black">Size <span
                                class="font-semibold text-black">({{ $orderItem->stock->size->name }})</span></p>
                            <span class="text-xs font-normal text-gray-500 mb-1">•</span>
                            <p class="text-sm font-normal text-black">Total <span
                                class="font-semibold text-black">({{ $orderItem->quantity }} pcs)</span>
                            </p>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function cancelOrder(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "Are you sure you want to cancel this order?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, cancel it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = '/order/cancel/' + id;

          const csrfInput = document.createElement('input');
          csrfInput.type = 'hidden';
          csrfInput.name = '_token';
          csrfInput.value = CSRF_TOKEN;
          form.appendChild(csrfInput);

          document.body.appendChild(form);
          form.submit();

          // $.ajax({
          //   url: "/order/cancel-order/" + id,
          //   type: 'POST',
          //   data: {
          //     _token: CSRF_TOKEN
          //   },
          //   success: function(response) {
          //     if (response.success) {
          //       Swal.fire({
          //         title: 'Success!',
          //         text: response.message,
          //         icon: 'success',
          //         timer: 3000,
          //         timerProgressBar: true,
          //       }).then((result) => {
          //         location.reload();
          //       });
          //     } else {
          //       Swal.fire({
          //         title: 'Failed!',
          //         text: response.message,
          //         icon: 'error',
          //         timer: 3000,
          //         timerProgressBar: true,
          //       });
          //     }
          //   },
          //   error: function(xhr, status, error) {
          //     Swal.fire({
          //       title: 'Failed!',
          //       text: xhr.responseText,
          //       icon: 'error',
          //       timer: 3000,
          //       timerProgressBar: true,
          //     });
          //   }
          // });
        }
      });
    }
  </script>
@endpush
