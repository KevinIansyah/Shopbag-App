@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh] relative">
      <div class="lg:flex lg:gap-4">
        <div class="w-full h-auto bg-white">
          <div class="lg:rounded-lg">
            <div x-data="productPage()" class="flex flex-col lg:flex-row gap-12">
              <div class="lg:w-2/5">
                <div class="flex flex-col gap-6">
                  <div class="relative flex-shrink-0">
                    <a :href="activeImg" data-fancybox="gallery">
                      <img :src="activeImg" alt="image of {{ $product->name }}"
                        class="w-full aspect-square object-cover rounded-xl" />
                    </a>

                    <button @click="prevImage"
                      class="absolute top-1/2 left-5 transform -translate-y-1/2 bg-gray-400/50 text-white h-12 w-12 flex items-center justify-center rounded-full">
                      <i class="fa-sharp fa-regular fa-chevron-left"></i>
                    </button>
                    <button @click="nextImage"
                      class="absolute top-1/2 right-5 transform -translate-y-1/2 bg-gray-400/50 text-white h-12 w-12 flex items-center justify-center rounded-full">
                      <i class="fa-sharp fa-regular fa-chevron-right"></i>
                    </button>
                  </div>
                  <div class="flex flex-row gap-4 h-auto overflow-x-auto p-1 scroll-hidden">
                    <template x-for="(img, index) in images" :key="index">
                      <img :src="img" alt="image of {{ $product->name }}"
                        :class="activeImg == img ? 'ring-red-500 hover:ring-red-600' : 'ring-gray-200 hover:ring-gray-300'"
                        class="w-24 h-24 ring-2 rounded-md cursor-pointer aspect-square object-cover"
                        @click="setActiveImage(img)" />
                    </template>
                  </div>

                  <div id="fancy_box" class="hidden">
                    <template x-for="(img, index) in images" :key="index">
                      <a v-if="activeImg !== img" :href="img" data-fancybox="gallery">
                        <img :src="img" alt="image of {{ $product->name }}"
                          class="hidden w-full h-full aspect-square object-cover rounded-xl" />
                      </a>
                    </template>
                  </div>
                </div>
              </div>

              <div class="lg:w-3/5">
                <div class="flex flex-col gap-4">
                  <div class="">
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                      {{ $product->name }}
                    </h1>
                    <div class="mt-4">
                      <p class="text-3xl font-bold sm:text-4xl text-red-500">
                        {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
                      </p>

                      <div class="flex items-center gap-2 mt-2 sm:mt-2" x-data="{ rating: {{ $averageRating }} }">
                        <div class="flex items-center gap-1">
                          <template x-for="i in 5" :key="i">
                            <svg :class="i <= rating ? 'text-yellow-300' : 'text-gray-300'" class="h-4 w-4"
                              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                              fill="currentColor" viewBox="0 0 24 24">
                              <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                          </template>
                        </div>
                        <p class="text-sm font-medium leading-none text-gray-500">
                          ({{ number_format($averageRating, 1) }})
                        </p>
                        <a href="#reviews"
                          class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline">
                          {{ $totalReviews }} Reviews
                        </a>
                      </div>

                      <div class="flex items-center gap-2 mt-2 sm:mt-2">
                        <i class="fa-solid fa-cart-circle-check text-xs text-red-500"></i>
                        <p class="text-sm font-medium leading-none text-gray-900">
                          ({{ number_format($product->sold >= 1000 ? $product->sold / 1000 : $product->sold, $product->sold >= 1000 ? 1 : 0) . ($product->sold >= 1000 ? 'k' : '') }}
                          Sold)
                        </p>
                      </div>

                      <button id="addCartModalButton" data-modal-target="addCartModal" data-modal-toggle="addCartModal"
                        type="button"
                        class="text-white mt-8 bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none flex items-center justify-center w-fit"
                        role="button">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                          width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>
                        Add to cart
                      </button>
                    </div>
                  </div>
                </div>

                <hr class="my-6 md:my-8 border-gray-200" />

                <div class="ck-editor-front">
                  {!! $product->description !!}
                </div>
              </div>
            </div>

            @if ($reviews->isNotEmpty())
              <div id="reviews" class="pt-8 antialiased dark:bg-gray-900 md:pt-16">
                <div class="flex items-center gap-2">
                  <h2 class="text-xl font-bold text-gray-900">Reviews</h2>

                  <div class="mt-2 flex items-center gap-2 sm:mt-0" x-data="{ rating: {{ $averageRating }} }">
                    <div class="flex items-center gap-0.5">
                      <template x-for="i in 5" :key="i">
                        <svg :class="i <= rating ? 'text-yellow-300' : 'text-gray-300'" class="h-4 w-4"
                          aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                          fill="currentColor" viewBox="0 0 24 24">
                          <path
                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                      </template>
                    </div>
                    <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                      ({{ number_format($averageRating, 1) }})
                    </p>
                    <a href="#"
                      class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline">
                      {{ $totalReviews }} Reviews </a>
                  </div>
                </div>

                <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
                  <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
                    @foreach ([5, 4, 3, 2, 1] as $rating)
                      <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900">
                          {{ $rating }}</p>
                        <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                          <div class="h-1.5 rounded-full bg-yellow-300"
                            style="width: {{ ($ratingBreakdown[$rating] / $reviews->count()) * 100 }}%"></div>
                        </div>
                        <a href="#"
                          class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">
                          {{ $ratingBreakdown[$rating] }}
                          <span class="hidden sm:inline">reviews</span>
                        </a>
                      </div>
                    @endforeach
                  </div>
                </div>

                <div class="mt-6 divide-y divide-gray-200 dark:divide-gray-700">
                  @foreach ($reviews as $review)
                    <div class="gap-3 py-6 sm:flex sm:items-start">
                      <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                        <div class="flex items-center gap-0.5" x-data="{ rating: {{ $review->rating }} }">
                          <template x-for="i in 5" :key="i">
                            <svg :class="i <= rating ? 'text-yellow-300' : 'text-gray-300'" class="h-4 w-4"
                              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                              fill="currentColor" viewBox="0 0 24 24">
                              <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                          </template>
                        </div>

                        <div class="flex items-center gap-2">
                          @if ($review->user->image)
                            <a href="{{ asset('storage/image-filepond/' . $review->user->image) }}" data-fancybox
                              data-caption="{{ $review->user->name }} profile picture">
                              <img class="w-8 h-8 rounded-full"
                                src="{{ asset('storage/image-filepond/' . $review->user->image) }}" alt="User photo">
                            </a>
                          @else
                            <a href="{{ route('profile.index') }}" class="flex mx-3 text-sm rounded-full md:mr-0">
                              <img class="w-8 h-8 rounded-full" src="{{ asset('images/default-profile.png') }}"
                                alt="User photo">
                            </a>
                          @endif
                          <div class="space-y-0.5">
                            <p class="text-base font-semibold text-gray-900">{{ $review->user->name }}
                            </p>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                              {{ \Carbon\Carbon::parse($review->created_at)->format('F d Y \a\t H:i') }}</p>
                          </div>
                        </div>

                        <div class="inline-flex items-center gap-1">
                          <svg class="h-5 w-5 text-blue-700 dark:text-blue-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                              d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                              clip-rule="evenodd" />
                          </svg>
                          <p class="text-sm font-medium text-gray-900">Verified purchase</p>
                        </div>
                      </div>

                      <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $review->comment }}</p>

                        @if ($review->images->isNotEmpty())
                          <div class="flex gap-2">
                            @foreach ($review->images as $image)
                              <a href="{{ asset('storage/image-filepond/' . $image->image_url) }}"
                                data-fancybox="review" data-caption="Review image by {{ $review->user->name }}">
                                <img class="h-32 w-20 rounded-lg object-cover"
                                  src="{{ asset('storage/image-filepond/' . $image->image_url) }}"
                                  alt="image of {{ $product->name }}" />
                              </a>
                            @endforeach
                          </div>
                        @endif

                        <div class="flex items-center gap-4">
                          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Was it helpful to you?</p>
                          <div class="flex items-center">
                            <input id="reviews-radio-3" type="radio" value="" name="reviews-radio-2"
                              class="h-4 w-4 border-red-300 bg-red-100 text-red-600 focus:ring-2 focus:ring-red-500 dark:border-red-600 dark:bg-red-700 dark:ring-offset-red-800 dark:focus:ring-red-600" />
                            <label for="reviews-radio-3"
                              class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Yes: 0 </label>
                          </div>
                          <div class="flex items-center">
                            <input id="reviews-radio-4" type="radio" value="" name="reviews-radio-2"
                              class="h-4 w-4 border-red-300 bg-red-100 text-red-600 focus:ring-2 focus:ring-red-500 dark:border-red-600 dark:bg-red-700 dark:ring-offset-red-800 dark:focus:ring-red-600" />
                            <label for="reviews-radio-4"
                              class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">No: 0 </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>

                @if ($totalReviews > 10)
                  <div class="mt-6 text-center">
                    <button type="button"
                      class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">View
                      more reviews</button>
                  </div>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Add cart modal -->
  <div id="addCartModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full"
    x-data="{
        amount: 1,
        selectedStock: null,
        stocks: {{ json_encode($stocks) }},
        updateAmount(quantity) {
            this.selectedStock = quantity;
            this.amount = 1;
        }
    }">
    <div class="relative p-4 w-full max-w-lg md:h-auto">
      <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
        <div id="messages_add" class="relative"></div>
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
          <h3 class="text-lg font-semibold text-gray-900">Add to cart</h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-cente transition-all duration-200"
            data-modal-toggle="addCartModal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form id="add_category_form" method="POST" action="{{ route('cart.store') }}">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <input type="hidden" name="quantity" :value="amount">
          <div class="grid gap-4 mb-4">
            <div>
              <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Size</label>
              <div class="grid grid-cols-3 gap-4 md:grid-cols-4">
                @foreach ($stocks as $stock)
                  <div
                    class="rounded-lg border p-2 ps-2 {{ $stock->quantity === 0 ? 'border-gray-300 bg-gray-50' : 'border-red-300 bg-red-50' }}">
                    <div class="flex items-start">
                      <div class="flex h-5 items-center">
                        <input id="stock_{{ $stock->stock_id }}" aria-describedby="stock-text-{{ $stock->id }}"
                          type="radio" name="stock_id" value="{{ $stock->id }}" required
                          class="h-4 w-4 border-red-300 bg-white text-red-500 focus:ring-2 focus:ring-red-500"
                          {{ $stock->quantity === 0 ? 'disabled' : '' }}
                          @change="updateAmount({{ $stock->quantity }})" />
                      </div>
                      <div class="ms-2 text-sm">
                        <p id="size-text-{{ $stock->id }}" class="text-sm font-normal text-gray-500">
                          {{ $stock->size->name }}</p>
                      </div>
                    </div>
                    <p id="stock-text-{{ $stock->id }}" class="text-xs font-normal text-gray-500 mt-2">Sisa:
                      {{ $stock->quantity }}</p>
                  </div>
                @endforeach
              </div>
            </div>

            <div>
              <label for="size" class="block mb-2 text-sm font-medium text-gray-900">Quantity</label>
              <div class="flex flex-row items-center">
                <button type="button"
                  class="bg-red-50 w-10 h-10 items-center rounded-lg text-gray-500 focus:ring-2 focus:ring-red-500 text-xl"
                  @click="amount = Math.max(amount - 1, 1)" :disabled="!selectedStock || amount <= 1">-</button>
                <div class="w-10 h-10 flex justify-center items-center rounded-lg">
                  <span class="leading-none text-center text-gray-500 text-sm font-normal" x-text="amount"></span>
                </div>
                <button type="button"
                  class="bg-red-50 w-10 h-10 items-center rounded-lg text-gray-500 focus:ring-2 focus:ring-red-500 text-xl"
                  @click="amount = Math.min(amount + 1, selectedStock)" :disabled="!selectedStock">+</button>
              </div>
            </div>
          </div>
          <button type="submit"
            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200">
            <span id="button_text_add_category">Save</span>
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    Fancybox.bind('[data-fancybox=""]', {

    });

    Fancybox.bind('[data-fancybox="gallery"]', {

    });

    Fancybox.bind('[data-fancybox="review"]', {

    });


    function productPage() {
      const imageArray = @json($product->images->pluck('image_url')->map(fn($url) => asset('storage/image-filepond/' . $url)));

      return {
        images: imageArray.reduce((acc, img, index) => {
          acc[`img${index + 1}`] = img;
          return acc;
        }, {}),
        activeImg: imageArray[0],
        amount: 1,
        currentIndex: 0,
        setActiveImage(img) {
          this.activeImg = img;
          this.currentIndex = imageArray.indexOf(img);
        },
        prevImage() {
          this.currentIndex = (this.currentIndex - 1 + imageArray.length) % imageArray.length;
          this.activeImg = imageArray[this.currentIndex];
        },
        nextImage() {
          this.currentIndex = (this.currentIndex + 1) % imageArray.length;
          this.activeImg = imageArray[this.currentIndex];
        }
      }
    }
  </script>
@endpush
