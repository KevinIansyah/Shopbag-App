@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh]">
      <div class="lg:flex lg:gap-4">
        <div class="w-full h-auto bg-white">
          <div class="lg:rounded-lg">
            @if ($carts->isEmpty())
              <div class="flex flex-col items-center justify-center">
                <img class="w-full md:w-[50%]" src="{{ asset('images/no-data.jpg') }}" alt="No data available">
                <h6 class="text-lg font-semibold text-black">Cart is still empty!</h6>
                <p class="text-sm font-normal text-black">You haven't added a product to your cart</p>
              </div>
            @else
              <h2 class="text-xl font-semibold">Checkout</h2>
              <p class="text-sm font-normal mb-4">Checkout your product here!</p>

              <ol class="items-center flex w-1/3 max-w-2xl text-center text-sm font-medium sm:text-base">
                <li
                  class="after:border-1 flex items-center text-red-500 text-sm after:mx-2 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-2">
                  <span class="flex items-center after:mx-1 after:text-red-200 after:content-['/'] sm:after:hidden">
                    <i class="fa-duotone fa-solid fa-circle-check mr-2"></i>
                    Cart
                  </span>
                </li>

                <li
                  class="after:border-1 flex items-center text-red-500 text-sm after:mx-2 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-2">
                  <span class="flex items-center after:mx-1 after:text-gray-200 after:content-['/'] sm:after:hidden">
                    <i class="fa-duotone fa-solid fa-circle-check mr-2"></i>
                    Checkout
                  </span>
                </li>

                <li class="flex shrink-0 items-center text-sm">
                  <i class="fa-duotone fa-solid fa-circle-check mr-2"></i>
                  Order summary
                </li>
              </ol>

              <div class="mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                  <div class="rounded-lg border border-gray-200 bg-white p-4 mb-4">
                    <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-4 md:space-y-0">
                      <div class="w-full md:order-2">
                        <p class="text-base font-semibold mb-2">Shipping Address</p>
                        <div class="w-full">
                          @if ($address)
                            <p class="text-sm font-bold mb-2">{{ $address->recipient_name }}
                              @if ($address->is_primary == true)
                                <span
                                  class="ml-2 bg-red-100 text-red-600 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-500">
                                  Primary Address
                                </span>
                              @endif
                            </p>
                            <p class="text-sm font-normal mb-1">{{ $address->recipient_contact }}</p>
                            <p class="text-sm font-normal mb-1">{{ $address->city }}, {{ $address->province }}</p>
                            <p class="text-sm font-normal mb-1">{{ $address->address }}</p>
                            <p class="text-sm font-normal">Notes: {{ $address->notes }}</p>
                          @else
                            <p class="text-sm font-normal">You have not added a shipping address yet. Please add one <a
                                href="{{ route('profile.index', ['p' => 'shipping-address']) }}"
                                class="text-red-500 underline">here</a>.</p>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="rounded-lg border border-gray-200 bg-white p-4">
                    <div class="space-y-4">
                      @foreach ($carts as $item)
                        <div
                          class="space-y-4 md:flex md:items-center md:justify-between md:gap-4 md:space-y-0 border-b border-gray-300">
                          <div class="space-y-4 md:flex md:items-center md:gap-4 md:space-y-0">
                            <div class="shrink-0 md:order-1">
                              <img class="h-20 w-20 square object-cover object-center"
                                src="{{ asset('storage/image-filepond/' . $item->product->images->first()->image_url) }}"
                                alt="imac image" />
                            </div>

                            <div class="w-full md:order-2 md:max-w-md">
                              <p class="text-base font-semibold mb-2">{{ $item->product->name }}</p>
                              <p class="text-sm font-semibold text-red-500 mb-2">
                                {{ 'Rp ' . number_format($item->product->price, 0, ',', '.') }} x {{ $item->quantity }}
                                =
                                {{ 'Rp ' . number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>

                              <div class="flex items-center gap-2 mb-4">
                                <p class="text-sm font-normal text-black">Size <span
                                    class="font-semibold text-black">({{ $item->stock->size->name }})</span></p>
                                <span class="text-xs font-normal text-gray-500 mb-1">•</span>
                                <p class="text-sm font-normal text-black">Total <span
                                    class="font-semibold text-black">({{ $item->quantity }} pcs)</span>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>

                    <div class="mt-4 flex justify-between items-center">
                      <p class="text-sm text-black font-normal">Total Weight<span
                          class="font-semibold text-black">({{ $totalWeight }}
                          gram)</span></p>
                      <p class="text-sm text-black font-normal">Total Price <span class="font-semibold text-black">(
                          {{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }})</span></p>
                    </div>
                  </div>
                </div>

                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-4 lg:mt-0 lg:w-full">
                  <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                    <p class="text-base font-semibold mb-2">Order summary</p>

                    <div class="space-y-4">
                      <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4">
                          <dt class="text-sm font-normal text-gray-500">Original price</dt>
                          <dd class="text-sm font-medium text-black">
                            {{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }} <span
                              class="text-xs">({{ $totalQuantity }} product)</span></dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                          <dt class="text-sm font-normal text-gray-500">Discount</dt>
                          <dd class="text-sm font-medium text-green-600">-</dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                          <dt class="text-sm font-normal text-gray-500">Store Pickup</dt>
                          <dd class="text-sm font-medium text-black">{{ 'Rp ' . number_format(0, 0, ',', '.') }}</dd>
                        </dl>
                      </div>

                      <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                        <dt class="text-base font-semibold text-black">Total</dt>
                        <dd class="text-base font-semibold text-black">
                          {{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }}</dd>
                      </dl>
                    </div>

                    @if ($address)
                      <button id="pay-button" data-address-id="{{ $address->id }}"
                        class="flex justify-center w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-pointer">
                        Proceed to Payment
                      </button>
                    @else
                      <button
                        class="flex justify-center w-full text-white bg-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-not-allowed"
                        disabled>
                        Proceed to Payment
                      </button>
                    @endif
                  </div>

                  {{-- <div
                  class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                  <form class="space-y-4">
                    <div>
                      <label for="voucher" class="mb-2 block text-sm font-medium text-black"> Do you
                        have a voucher or gift card? </label>
                      <input type="text" id="voucher"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-black focus:border-primary-500 focus:ring-primary-500"
                        placeholder="" required />
                    </div>
                    <a href="#"
                      class="flex justify-center w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200">Apply
                      Code</a>
                  </form>
                </div> --}}
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </main>

  <div id="progress-modal" tabindex="-1"
    class="overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 hidden bg-gray-900/50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="p-4 md:p-5">
          <div class="mx-auto w-full mb-4" style="width: 130px">
            <img src="{{ asset('images/info.png') }}" alt="image info">
          </div>
          <h6 class="mb-1 text-lg font-bold text-gray-900 dark:text-white">Hmm, Payment is not yet complete!</h6>
          <p class="text-gray-500 dark:text-gray-400 mb-6">Your order cannot be processed yet. Please complete the payment
            in the 'Waiting for Payment' menu.
          <p>
          <div class="flex items-center mt-6 space-x-4 rtl:space-x-reverse">
            <a href="{{ route('profile.index', ['p' => 'waiting-for-payment']) }}"
              class="flex justify-center text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-pointer">
              Go to Payment
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
  </script>

  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#pay-button').click(function() {
      const addressId = $(this).data('address-id');
      console.log(addressId);

      $.ajax({
        url: '{{ route('checkout.store') }}',
        type: 'POST',
        data: {
          address_id: addressId,
          _token: CSRF_TOKEN
        },
        success: function(data) {
          console.log(data);
          if (data.snapToken) {
            snap.pay(data.snapToken, {
              onSuccess: function(result) {
                console.log(result);
                $.ajax({
                  url: '{{ route('checkout.update', ['checkout' => 'orderId']) }}'.replace('orderId',
                    data.orderId),
                  type: 'PUT',
                  data: {
                    _token: CSRF_TOKEN
                  },
                  success: function(result) {
                    if (result.success) {
                      window.location.href =
                        '{{ route('profile.index', ['p' => 'transaction-list']) }}';
                    } else {
                      console.error('Error:', result.message);
                    }
                  },
                  error: function(xhr, status, error) {
                    console.error('Error updating stock:', xhr.status, error);
                    console.error('Response:', xhr.responseText);
                  }
                });
              },
              onPending: function(result) {
                console.log(result);
              },
              onError: function(result) {
                console.log(result);
              },
              onClose: function() {
                const progressModal = document.getElementById("progress-modal");
                if (progressModal) {
                  progressModal.classList.remove("hidden");
                  progressModal.classList.add("flex");
                  document.body.classList.add("overflow-x-hidden");
                  progressModal.addEventListener('click', function(e) {
                    e.stopPropagation();
                  });
                }
              }
            });
          } else {
            console.error('Gagal mendapatkan snap token:', data.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          console.error('Response:', xhr.responseText);
        }
      });
    });
  </script>
@endpush
