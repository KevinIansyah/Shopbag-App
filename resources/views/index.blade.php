@extends('layouts.main')

@section('main')
  <main>
    <div id="controls-carousel" class="relative w-full h-[50vh] lg:h-screen" data-carousel="static">
      <div class="relative h-full overflow-hidden">
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ asset('images/hero/hero-1.jpg') }}"
            class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
            alt="...">
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
          <img src="{{ asset('images/hero/hero-2.jpg') }}"
            class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
            alt="...">
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ asset('images/hero/hero-3.jpg') }}"
            class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
            alt="...">
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ asset('images/hero/hero-4.jpg') }}"
            class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
            alt="...">
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ asset('images/hero/hero-5.jpg') }}"
            class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
            alt="...">
        </div>
      </div>
      <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 1 1 5l4 4" />
          </svg>
          <span class="sr-only">Previous</span>
        </span>
      </button>
      <button type="button"
        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span
          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 9 4-4-4-4" />
          </svg>
          <span class="sr-only">Next</span>
        </span>
      </button>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
      <div class="pb-10">
        {{-- <h1 class="text-xl font-bold mb-6">Best Seller Produk</h1> --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

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
                  <div class="flex items-center space-x-[1px] md:space-x-1 rtl:space-x-reverse" x-data="{ rating: {{ $product->avg_rating }} }">
                    <template x-for="i in 5" :key="i">
                      <svg :class="i <= rating ? 'text-yellow-300' : 'text-gray-300'" class="w-4 h-4" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
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
      </div>

      {{-- <div>
        <h1 class="text-xl font-bold mb-6">Flash Sale</h1>

      </div> --}}
    </div>
  </main>
@endsection
