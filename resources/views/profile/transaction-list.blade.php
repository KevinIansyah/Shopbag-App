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
                  <h2 class="text-xl font-semibold">Transaction List</h2>
                  <p class="text-sm font-normal">Manage your transaction here!</p>
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
                  <h6 class="text-lg font-semibold text-black">No transactions found!</h6>
                  <p class="text-sm font-normal text-black text-center">You don’t have any transactions in your list.</p>
                </div>
              @else
                @foreach ($orders as $order)
                  @php
                    $totalItems = $order->orderItems->sum('quantity');
                    $totalWeight = $order->orderItems->sum(function ($item) {
                        return $item->quantity * $item->product->weight;
                    });
                  @endphp
                  <div class="p-4 border border-gray-200 rounded">
                    <div>
                      <div class="flex items-start justify-between flex-col md:flex-row gap-2 mb-3">
                        <div class="mb-3 flex items-start md:items-center flex-col md:flex-row gap-2">
                          <p class="text-sm font-bold uppercase">{{ $order->midtrans_order_id }}</p>
                          <span
                            class=" @if ($order->status == 'paid') bg-green-100 text-green-800
                              @elseif($order->status == 'processed') bg-orange-100 text-orange-500
                              @elseif($order->status == 'shipped') bg-blue-100 text-blue-800
                              @elseif($order->status == 'delivered') bg-purple-100 text-purple-800
                              @elseif($order->status == 'completed') bg-gray-100 text-gray-800
                              @elseif($order->status == 'canceled') bg-red-100 text-red-600 @endif text-xs font-medium px-2.5 py-0.5 rounded capitalize">
                            {{ $order->status }}
                          </span>
                        </div>

                        <div class="flex gap-2">
                          @if ($order->status == 'delivered')
                            <button type="button" onclick="acceptDelivered({{ $order->id }})"
                              class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-pointer">
                              Finish Order
                            </button>
                          @elseif ($order->status != 'canceled' && $order->status != 'completed')
                            <button type="button"
                              class="text-white focus:ring-4 bg-gray-400 hover:bg-gray-400 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-not-allowed"
                              disabled>
                              Finish Order
                            </button>
                          @endif

                          @if ($order->status == 'completed' && $order->is_review == false)
                            <button type="button" data-modal-target="review-modal" data-modal-toggle="review-modal"
                              data-order-id="{{ $order->id }}"
                              class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-pointer">
                              Add Review
                            </button>
                          @endif
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
                      <div class="space-y-4 md:flex md:items-center md:gap-4 md:space-y-0 border-t border-gray-200 pt-4">
                        <div class="shrink-0 md:order-1">
                          <img class="h-16 w-16 square object-cover object-center"
                            src="{{ asset('storage/image-filepond/' . $orderItem->product->images->first()->image_url) }}"
                            alt="imac image" />
                        </div>

                        <div class="w-full md:order-2">
                          <p class="text-sm font-semibold mb-1">{{ $orderItem->product->name }}</p>

                          <p class="text-sm font-semibold text-red-500 mb-2">
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

  <!-- Add review modal -->
  <div id="review-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0">
    <div class="relative w-full max-w-2xl h-full md:h-auto">
      <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
          <h3 class="text-base font-semibold text-gray-900 dark:text-white">
            Add Review
          </h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="review-modal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form action="{{ route('order.review') }}" method="POST"
          class="h-[calc(100vh-96px)] md:h-auto md:max-h-[70vh] overflow-y-auto">
          @csrf
          <input type="hidden" name="order_id" id="modal-order-id">
          <input type="hidden" name="rating" id="rating-input" value="3">
          <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div class="sm-col-span-2">
              <div class="flex items-center gap-2">
                <svg class="h-6 w-6 text-yellow-300 rating-star" data-value="1" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="h-6 w-6 text-yellow-300 rating-star" data-value="2" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="h-6 w-6 text-yellow-300 rating-star" data-value="3" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="h-6 w-6 text-gray-300 dark:text-gray-500 rating-star" data-value="4" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="h-6 w-6 text-gray-300 dark:text-gray-500 rating-star" data-value="5" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <span class="ms-2 text-base font-medium text-gray-900 dark:text-white"><span
                    id="rating-display">(3</span>
                  out of 5)</span>
              </div>
            </div>
            <div class="sm:col-span-2">
              <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Review
                description
              </label>
              <textarea name="comment" id="comment" rows="4"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="Review description about product"></textarea>
            </div>
            <div class="sm:col-span-2">
              <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add real photos
                of the product to help other customers (Optional)</label>
              <input type="file" class="filepond image" name="image">
            </div>
          </div>
          <button type="submit"
            class="w-full md:w-24 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
            Save
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function acceptDelivered(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "Are you sure you have received this order?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, confirm!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = '/order/accept/' + id;

          const csrfInput = document.createElement('input');
          csrfInput.type = 'hidden';
          csrfInput.name = '_token';
          csrfInput.value = CSRF_TOKEN;
          form.appendChild(csrfInput);

          document.body.appendChild(form);
          form.submit();

          // $.ajax({
          //   url: "/order/accept-delivered/" + id,
          //   type: 'POST',
          //   data: {
          //     _token: CSRF_TOKEN
          //   },
          //   success: function(response) {
          //     if (response.success) {
          //       Swal.fire({
          //         title: 'Berhasil!',
          //         text: response.message,
          //         icon: 'success',
          //         timer: 3000,
          //         timerProgressBar: true,
          //       }).then((result) => {
          //         location.reload();
          //       });
          //     } else {
          //       Swal.fire({
          //         title: 'Gagal!',
          //         text: response.message,
          //         icon: 'error',
          //         timer: 3000,
          //         timerProgressBar: true,
          //       });
          //     }
          //   },
          //   error: function(xhr, status, error) {
          //     Swal.fire({
          //       title: 'Gagal!',
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

    const modal = document.getElementById('review-modal');
    const modalOrderIdInput = document.getElementById('modal-order-id');

    document.querySelectorAll('[data-modal-toggle="review-modal"]').forEach(button => {
      button.addEventListener('click', function() {
        const orderId = this.getAttribute('data-order-id');
        modalOrderIdInput.value = orderId;
      });
    });

    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating-input');
    const ratingDisplay = document.getElementById('rating-display');

    stars.forEach(star => {
      star.addEventListener('click', function() {
        const value = this.dataset.value;
        ratingInput.value = value;
        ratingDisplay.textContent = value;

        stars.forEach(s => s.classList.remove('text-yellow-300'));
        stars.forEach(s => s.classList.add('text-gray-300'));

        for (let i = 0; i < value; i++) {
          stars[i].classList.add('text-yellow-300');
          stars[i].classList.remove('text-gray-300');
        }
      });
    });

    FilePond.create(
      document.querySelector('.image'), {
        server: {
          process: "/upload-image-multiple",
          revert: "/cancel-image-multiple",
          headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
          }
        },
        allowMultiple: true,
        allowReorder: true,
        allowFileSizeValidation: true,
        allowFileTypeValidation: true,
        maxFiles: 5,
        maxFileSize: '2MB',
        labelMaxFileSize: 'Maximum file size is {filesize}',
        acceptedFileTypes: ['image/*'],
        labelFileTypeNotAllowed: 'File of invalid type. Please upload PNG, JPG, or JPEG files only.',
      }
    );
  </script>
@endpush
