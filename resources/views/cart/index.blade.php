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
              <h2 class="text-xl font-semibold">Shopping Cart</h2>
              <p class="text-sm font-normal mb-4">Manage your cart here!</p>

              <ol class="items-center flex w-1/3 max-w-2xl text-center text-sm font-medium sm:text-base">
                <li
                  class="after:border-1 flex items-center text-red-500 text-sm after:mx-2 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-2">
                  <span class="flex items-center after:mx-1 after:text-red-200 after:content-['/'] sm:after:hidden">
                    <i class="fa-duotone fa-solid fa-circle-check mr-2"></i>
                    Cart
                  </span>
                </li>

                <li
                  class="after:border-1 flex items-center text-primary-700 text-sm after:mx-2 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-2">
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
                  <div class="space-y-4">
                    @foreach ($carts as $item)
                      <div class="rounded-lg border border-gray-200 bg-white p-4">
                        <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-4 md:space-y-0">
                          <a href="{{ route('product.show', ['product' => $item->product->slug]) }}"
                            class="space-y-4 md:flex md:items-center md:gap-4 md:space-y-0">
                            <div class="shrink-0 md:order-1">
                              <img class="h-20 w-20 square object-cover object-center"
                                src="{{ asset('storage/image-filepond/' . $item->product->images->first()->image_url) }}"
                                alt="imac image" />
                            </div>

                            <div class="w-full md:order-2 md:max-w-md">
                              <p class="text-base font-semibold mb-2">{{ $item->product->name }}</p>
                              <p class="text-sm font-semibold text-red-500 mb-2">
                                {{ 'Rp ' . number_format($item->product->price, 0, ',', '.') }} x {{ $item->quantity }} =
                                {{ 'Rp ' . number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>

                              <div class="flex items-center gap-2">
                                <p class="text-sm font-normal text-black">Size <span
                                    class="font-semibold text-black">({{ $item->stock->size->name }})</span></p>
                                <span class="text-xs font-normal text-gray-500 mb-1">•</span>
                                <p class="text-sm font-normal text-black">Total <span
                                    class="font-semibold text-black">({{ $item->quantity }} pcs)</span>
                                </p>
                              </div>
                            </div>
                          </a>

                          <form method="POST" action="{{ route('cart.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                              class="w-8 h-8 flex justify-center items-center text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center transition-all duration-200">
                                <i class="fa-light fa-trash"></i>
                            </button>
                          </form>

                          {{-- <label for="counter-input" class="sr-only">Choose quantity:</label>
                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                          <div class="flex items-center">
                            <button type="button" id="decrement-button" data-input-counter-decrement="counter-input"
                              class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                              <svg class="h-2.5 w-2.5 text-black" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M1 1h16" />
                              </svg>
                            </button>
                            <input type="text" id="counter-input" data-input-counter
                              class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-black focus:outline-none focus:ring-0"
                              placeholder="" value="2" required />
                            <button type="button" id="increment-button" data-input-counter-increment="counter-input"
                              class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                              <svg class="h-2.5 w-2.5 text-black" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M9 1v16M1 9h16" />
                              </svg>
                            </button>
                          </div>
                        </div> --}}

                        </div>
                      </div>
                    @endforeach

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
                            {{ 'Rp ' . number_format($originalPrice, 0, ',', '.') }} <span
                              class="text-xs">({{ $totalQuantity }} product)</span></dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                          <dt class="text-sm font-normal text-gray-500">Discount</dt>
                          <dd class="text-sm font-medium text-green-600">-</dd>
                        </dl>

                        {{-- <dl class="flex items-center justify-between gap-4">
                        <dt class="text-sm font-normal text-gray-500">Store Pickup</dt>
                        <dd class="text-sm font-medium text-black">{{ 'Rp ' . number_format(0, 0, ',', '.') }}</dd>
                      </dl> --}}

                        {{-- <dl class="flex items-center justify-between gap-4">
                        <dt class="text-sm font-normal text-gray-500">Tax</dt>
                        <dd class="text-sm font-medium text-black">$799</dd>
                      </dl> --}}
                      </div>

                      <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                        <dt class="text-base font-semibold text-black">Total</dt>
                        <dd class="text-base font-semibold text-black">
                          {{ 'Rp ' . number_format($originalPrice, 0, ',', '.') }}</dd>
                      </dl>
                    </div>

                    <a href="{{ route('checkout.index') }}"
                      class="flex justify-center w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200">
                      <span id="button-text-login">Proceed
                        to Checkout</span>
                    </a>

                    <div class="flex items-center justify-center gap-2">
                      <span class="text-sm font-normal text-gray-500"> or </span>
                      <div href="#"
                        class="inline-flex items-center gap-2 text-sm font-medium text-red-500 underline hover:no-underline">
                        Continue Shopping
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                      </div>
                    </div>
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
@endsection

@push('scripts')
  <script></script>
@endpush
