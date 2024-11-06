@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh] relative">
      <div class="lg:flex lg:gap-4">
        <div class="w-full h-auto bg-white">
          <div class="lg:rounded-lg">
            <div x-data="productPage()" class="flex flex-col lg:flex-row gap-8">
              <div class="lg:w-1/3">
                <div class="flex flex-col gap-6">
                  <div class="relative flex-shrink-0">
                    <a :href="activeImg" data-fancybox="gallery">
                      <img :src="activeImg" alt="image of {{ $product->name }}"
                        class="w-full h-full object-cover rounded-xl" />
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

              <div class="lg:w-2/3">


                <div class="flex flex-col gap-4">
                  <div class="">
                    <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                      {{ $product->name }}
                    </h1>
                    <div class="mt-4">
                      <p class="text-2xl font-bold sm:text-3xl text-red-500">
                        {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
                      </p>

                      <div class="flex items-center gap-2 mt-2 sm:mt-2">
                        <div class="flex items-center gap-1">
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                        </div>
                        <p class="text-sm font-medium leading-none text-gray-500">
                          (5.0)
                        </p>
                        <a href="#"
                          class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline">
                          345 Reviews
                        </a>
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

            <div class="grid grid-cols-12 gap-8">
              {{-- COntent here --}}
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Add modal -->
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
    Fancybox.bind('[data-fancybox="gallery"]', {

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
