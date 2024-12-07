@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh]">
      <div class="lg:flex lg:gap-4">
        {{-- @include('profile.partials.aside') --}}
        <aside id="profile-sidebar"
          class="absolute top-0 left-0 z-50 w-64 h-screen lg:h-auto transition-transform -translate-x-full lg:relative lg:top-auto lg:left-auto lg:translate-x-0 lg:z-0 lg:min-w-64"
          aria-label="Sidenav">
          <div class="overflow-y-auto h-full lg:h-auto p-4 bg-white lg:rounded-lg">

            <form action="{{ route('product.index') }}" method="GET">
              <div class="grid grid-cols-2 gap-2 ">
                <button type="submit"
                  class="w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200">
                  Filter
                </button>
                <a href="{{ route('product.index') }}"
                  class="w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200">
                  Reset
                </a>
              </div>

              <input type="text" name="search" id="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 mt-4"
                placeholder="Search...">

              <div class="space-y-2 my-4">
                @foreach ($categories as $item)
                  <div class="flex items-start">
                    <div class="flex items-center h-5">
                      <input type="checkbox" name="categories[]" id="checkbox-{{ $item->id }}"
                        value="{{ $item->id }}"
                        {{ in_array($item->id, request()->input('categories', [])) ? 'checked' : '' }}
                        class="w-4 h-4 text-red-500 bg-gray-100 border-gray-300 rounded focus:ring-red-300 dark:focus:ring-red-500 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                    </div>
                    <label for="checkbox-{{ $item->id }}"
                      class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->name }}</label>
                  </div>
                @endforeach
              </div>
            </form>

            {{-- <ul class="space-y-2 mt-2">
              <li>
                <button type="button"
                  class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-gray-300 flex items-center px-2 py-2.5 w-full text-sm font-normal rounded-lg focus:ring-4 focus:outline-none group transition-all duration-200"
                  aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                  <div class="w-6 h-6 flex items-center justify-center">
                    <i class="fa-light fa-circle-dollar"></i>
                  </div>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Transaction</span>
                  <i class="fa-sharp fa-solid fa-chevron-down text-xs"></i>
                </button>
                <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                  <li>
                    <a href=""
                      class="flex items-center px-2 py-2.5 pl-11 w-full text-sm font-normal rounded-lg transition duration-75 group">Waiting
                      For Payment</a>
                  </li>
                  <li>
                    <a href=""
                      class="flex items-center px-2 py-2.5 pl-11 w-full text-sm font-normal rounded-lg transition duration-75 group">Transaction
                      List</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href=""
                  class="'text-gray-900 bg-white hover:bg-gray-100 focus:ring-gray-300 flex items-center p-2 text-sm font-normal rounded-lg focus:ring-4 focus:outline-none group transition-all duration-200">
                  <div class="w-6 h-6 flex items-center justify-center">
                    <i class="fa-light fa-lock"></i>
                  </div>
                  <span class="ml-3">Set Password</span>
                </a>
              </li>
            </ul> --}}
          </div>
        </aside>


        <div class="w-full h-auto">
          <div class="lg:rounded-lg lg:pt-4">
            @if ($products->isEmpty())
              <div class="flex flex-col items-center justify-center">
                <img class="w-full md:w-[50%]" src="{{ asset('images/no-data.jpg') }}" alt="No data available">
                <h6 class="text-lg font-semibold text-black">No Products Found!</h6>
                <p class="text-sm font-normal text-black">We couldn't find any products matching your search criteria.
                  Please try adjusting your filters or search terms.</p>
              </div>
            @else
              <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                  <a href="{{ route('product.show', ['product' => $product->slug]) }}"
                    class="max-w-sm bg-white border-[0.5px] border-gray-200/50 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    @if (!empty($product->images) && isset($product->images[0]->image_url))
                      <img class="rounded-t-lg aspect-square object-cover object-center"
                        src="{{ asset('storage/image-filepond/' . $product->images[0]->image_url) }}"
                        alt="photo {{ $product->name }}" />
                    @else
                      <img class="rounded-t-lg aspect-square object-cover object-center"
                        src="{{ asset('storage/default-image.jpg') }}" alt="default photo for {{ $product->name }}" />
                    @endif
                    <div class="px-2 py-2">
                      <h5 class="text-sm font-bold tracking-tight text-gray-900 line-clamp-2">
                        {{ $product->name }}</h5>
                      <div class="flex items-center mt-2.5 mb-5">
                        <div class="flex items-center space-x-1 rtl:space-x-reverse" x-data="{ rating: {{ $product->avg_rating }} }">
                          <template x-for="i in 5" :key="i">
                            <svg :class="i <= rating ? 'text-yellow-300' : 'text-gray-300'" class="w-4 h-4"
                              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                              viewBox="0 0 22 20">
                              <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                          </template>
                        </div>
                        <span
                          class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded ms-3">{{ number_format($product->avg_rating, 1) }}</span>
                      </div>
                      <div class="flex items-center justify-between gap-2">
                        <p class="text-sm font-bold text-gray-900">
                          {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
                        </p>
                        <span
                          class="text-xs font-bold text-gray-900 ml-3">({{ number_format($product->sold >= 1000 ? $product->sold / 1000 : $product->sold, $product->sold >= 1000 ? 1 : 0) . ($product->sold >= 1000 ? 'k' : '') }}
                          Sold)
                        </span>
                      </div>
                    </div>
                  </a>
                @endforeach
              </div>

              <div class="flex justify-between mt-4">
                @if ($products->onFirstPage())
                  <span
                    class="text-white focus:ring-4 bg-gray-400 hover:bg-gray-400 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-not-allowed">Prev</span>
                @else
                  <a href="{{ $products->previousPageUrl() }}"
                    class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-pointe">Prev</a>
                @endif

                @if ($products->hasMorePages())
                  <a href="{{ $products->nextPageUrl() }}"
                    class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-pointe">Next</a>
                @else
                  <span
                    class="text-white focus:ring-4 bg-gray-400 hover:bg-gray-400 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200 cursor-not-allowed">Next</span>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
