{{-- @dd($notifications) --}}
<nav x-data="{ isNavOpen: false, isScrolled: false, isMenOpen: false, isWomanOpen: false, isKidsOpen: false }" x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 0; })" x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 0; })"
  :class="[
      (isScrolled || isMenOpen || isWomanOpen || isKidsOpen || @if(
      request()->is('/')) false @else true @endif) ?
      'bg-white transition-all duration-200' :
      'backdrop-blur-sm bg-black/25 transition-all duration-200',
      isScrolled ? 'shadow-lg' : ''
  ]"
  class="fixed top-0 z-40 w-full">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
    @if (session('success'))
      <x-alert-success :messages="session('success')" />
    @endif

    @if (session('error'))
      <x-alert-error :messages="session('error')" />
    @endif

    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <a href="/" class="flex-shrink-0">
          <img class="h-8" src="{{ asset('images/logo.png') }}" alt="logo">
        </a>
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline md:space-x-2 lg:space-x-4">
            <div @mouseenter="isMenOpen = true, isWomanOpen = false, isKidsOpen = false">
              <a href="{{ route('product.index', ['categories' => [1]]) }}"
                :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                    @if (request()->is('/')) false @else true @endif ? 'text-black' : 'text-white'"
                class="rounded-md px-2 py-2 text-sm uppercase font-[700] hover:text-red-500 transition ease-in-out duration-200">
                Men
              </a>
            </div>
            <div @mouseenter="isWomanOpen = true, isMenOpen = false, isKidsOpen = false">
              <a href="{{ route('product.index', ['categories' => [2]]) }}"
                :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                    @if (request()->is('/')) false @else true @endif ? 'text-black' : 'text-white'"
                class="rounded-md px-2 py-2 text-sm uppercase font-[700] hover:text-red-500 transition ease-in-out duration-200">
                Ladies
              </a>
            </div>
            <div @mouseenter="isKidsOpen = true, isMenOpen = false, isWomanOpen = false">
              <a href="{{ route('product.index', ['categories' => [3]]) }}"
                :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                    @if (request()->is('/')) false @else true @endif ? 'text-black' : 'text-white'"
                class="rounded-md px-2 py-2 text-sm uppercase font-[700] hover:text-red-500 transition ease-in-out duration-200">
                Kids
              </a>
            </div>
            <a href="{{ route('product.index') }}"
              @mouseenter="isMenOpen = false, isWomanOpen = false, isKidsOpen = false"
              :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                  @if (request()->is('/')) false @else true @endif ? 'text-black' : 'text-white'"
              class="rounded-md px-2 py-2 text-sm uppercase font-[700] hover:text-red-500 transition ease-in-out duration-200">
              Sale
            </a>
            <a href="{{ route('blog.index') }}" @mouseenter="isMenOpen = false, isWomanOpen = false, isKidsOpen = false"
              :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                  @if (request()->is('/')) false @else true @endif ? 'text-black' : 'text-white'"
              class="rounded-md px-2 py-2 text-sm uppercase font-[700] hover:text-red-500 transition ease-in-out duration-200">
              Blog
            </a>
          </div>
        </div>
      </div>
      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
          {{-- <form class="flex items-center max-w-sm mr-3">   
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
              </div>
              <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search branch name..." required />
            </div>
          </form> --}}

          <button type="button" data-dropdown-toggle="notification_dropdown_2"
            class="relative mx-3 flex justify-center items-center rounded-md">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <i :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                @if (request()->is('/')) false @else true @endif ? 'text-red-500' : 'text-white'"
              class="fa-duotone fa-bell text-lg transition-all duration-200"></i>
            @if ($unread_count !== 0)
              <span
                :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                    @if (request()->is('/')) false @else true @endif ? 'bg-red-500/50' : 'bg-white/50'"
                class="w-5 h-4 font-bold rounded-full flex items-center justify-center absolute -top-1 -right-4"
                style="font-size: 0.6rem">{{ $unread_count }}</span>
            @endif
          </button>

          <a href="{{ route('cart.index') }}" class="relative mx-3 flex justify-center items-center rounded-md">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View cart</span>
            <i :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                @if (request()->is('/')) false @else true @endif ? 'text-red-500' : 'text-white'"
              class="fa-duotone fa-bag-shopping text-lg transition-all duration-200"></i>
            @if ($cartCount !== 0)
              <span
                :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                    @if (request()->is('/')) false @else true @endif ? 'bg-red-500/50' : 'bg-white/50'"
                class="w-5 h-4 font-bold rounded-full flex items-center justify-center absolute -top-1 -right-4"
                style="font-size: 0.6rem">{{ $cartCount }}</span>
            @endif
          </a>

          <div
            :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                @if (request()->is('/')) false @else true @endif ? 'bg-gray-200' : 'bg-white'"
            class="w-px h-6 mx-3"></div>

          @auth
            @if (Auth::user()->image)
              <a href="{{ route('profile.index') }}" class="flex mx-3 text-sm rounded-full md:mr-0">
                <img class="w-8 h-8 rounded-full" src="{{ asset('storage/image-filepond/' . Auth::user()->image) }}"
                  alt="User photo">
              </a>
            @else
              <a href="{{ route('profile.index') }}" class="flex mx-3 text-sm rounded-full md:mr-0">
                <img class="w-8 h-8 rounded-full" src="{{ asset('images/default-profile.png') }}" alt="User photo">
              </a>
            @endif
          @else
            <a href="{{ route('login') }}"
              :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                  @if (request()->is('/')) false @else true @endif ?
                  'text-red-500 ring-red-500 hover:bg-red-500 hover:text-white' :
                  'text-white ring-white hover:bg-white hover:text-gray-600'"
              type="button"
              class="ring-1 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 ml-3 transition-all duration-200">
              Login
            </a>
          @endauth
        </div>
      </div>
      <div class="-mr-2 flex md:hidden">
        <!-- Mobile menu button -->

        <button type="button" data-dropdown-toggle="notification_dropdown_1"
          class="relative mx-3 flex justify-center items-center rounded-md">
          <span class="absolute -inset-1.5"></span>
          <span class="sr-only">View notifications</span>
          <i :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
              @if (request()->is('/')) false @else true @endif ? 'text-red-500' : 'text-white'"
            class="fa-duotone fa-bell text-lg transition-all duration-200"></i>
          @if ($unread_count !== 0)
            <span
              :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                  @if (request()->is('/')) false @else true @endif ? 'bg-red-500/50' : 'bg-white/50'"
              class="w-5 h-4 font-bold rounded-full flex items-center justify-center absolute -top-1 -right-4"
              style="font-size: 0.6rem">{{ $unread_count }}</span>
          @endif
        </button>

        <a href="{{ route('cart.index') }}" class="relative mx-3 flex justify-center items-center rounded-md">
          <span class="absolute -inset-1.5"></span>
          <span class="sr-only">View cart</span>
          <i :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
              @if (request()->is('/')) false @else true @endif ? 'text-red-500' : 'text-white'"
            class="fa-duotone fa-bag-shopping text-lg transition-all duration-200"></i>
          @if ($cartCount !== 0)
            <span
              :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                  @if (request()->is('/')) false @else true @endif ? 'bg-red-500/50' : 'bg-white/50'"
              class="w-5 h-4 font-bold rounded-full flex items-center justify-center absolute -top-1 -right-4"
              style="font-size: 0.6rem">{{ $cartCount }}</span>
          @endif
        </a>
        {{-- <button @click="isNavOpen = !isNavOpen" type="button"
          :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
              @if (request()->is('/')) false @else true @endif ?
              'text-red-500 hover:text-red-500 focus:ring-red-500 focus:ring-2 focus:ring-offset-1' :
              'text-white hover:text-white focus:ring-white focus:ring-1 focus:ring-offset-1'"
          class="relative inline-flex items-center justify-center rounded-md p-2 focus:outline-none"
          aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!-- Menu open: "hidden", Menu closed: "block" -->
          <svg :class="{ 'hidden': isNavOpen, 'block': !isNavOpen }" class="block h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!-- Menu open: "block", Menu closed: "hidden" -->
          <svg :class="{ 'block': isNavOpen, 'hidden': !isNavOpen }" class="hidden h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button> --}}
      </div>
    </div>
  </div>

  <!-- Backdrop -->
  <div x-cloak x-show="isMenOpen || isWomanOpen || isKidsOpen" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2" class="fixed inset-0 bg-gray-900/50 z-10 top-16"
    @click="isMenOpen = false, isWomanOpen = false, isKidsOpen = false">
  </div>

  <!-- Men -->
  <div @click.away="isMenOpen = false" @mouseleave="isMenOpen = false" x-cloak x-show="isMenOpen"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
    class="absolute z-20 left-0 top-16 bg-white rounded-b-md shadow-lg w-full">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 bg-white flex">
      <img class="w-44 h-44" src="{{ asset('images/cat_men.jpg') }}" alt="">
      <div class="ml-10">
        <a href="{{ route('product.index', ['categories' => [1, 4]]) }}"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Top</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 11]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 12]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts
          (Striped)</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 13]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts
          (Oversized)</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 15]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts
          (Long Sleeve)</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 16]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Polo
          Shirts</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 17]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Long
          Shirts</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 18]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Short
          Shirts</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 21]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Hoodies</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 22]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sweaters</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 23]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jackets</a>
        <a href="{{ route('product.index', ['categories' => [1, 4, 24]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Knitwears</a>
      </div>
      <div class="ml-20">
        <a href="{{ route('product.index', ['categories' => [1, 5]]) }}"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Bottom</a>
        <a href="{{ route('product.index', ['categories' => [1, 5, 25]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jeans</a>
        <a href="{{ route('product.index', ['categories' => [1, 5, 26]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Chinos</a>
        <a href="{{ route('product.index', ['categories' => [1, 5, 27]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jogger
          & Cargo</a>
        <a href="{{ route('product.index', ['categories' => [1, 5, 28]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shorts</a>
        <a href="{{ route('product.index', ['categories' => [1, 5, 29]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Pants</a>
      </div>
      <div class="ml-20">
        <a href="{{ route('product.index', ['categories' => [1, 6]]) }}"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Accesoris</a>
        <a href="{{ route('product.index', ['categories' => [1, 6, 32]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Backpack
          & Travel Bags</a>
        <a href="{{ route('product.index', ['categories' => [1, 6, 33]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Waist
          & Sling Bags</a>
        <a href="{{ route('product.index', ['categories' => [1, 6, 34]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Hats
          & Beanies</a>
        <a href="{{ route('product.index', ['categories' => [1, 6, 35]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sandals</a>
        <a href="{{ route('product.index', ['categories' => [1, 6, 36]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shoes</a>
        <a href="{{ route('product.index', ['categories' => [1, 6, 38]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Wallets</a>
        <a href="{{ route('product.index', ['categories' => [1, 6, 39]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Watches</a>
        <a href="{{ route('product.index', ['categories' => [1, 6, 40]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Belts</a>
        <a href="{{ route('product.index', ['categories' => [1, 6, 41]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sunglasses</a>
      </div>
    </div>
  </div>

  <!-- Ladies -->
  <div @click.away="isWomanOpen = false" @mouseleave="isWomanOpen = false" x-cloak x-show="isWomanOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
    class="absolute z-20 left-0 top-16 bg-white rounded-b-md shadow-lg w-full">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 bg-white flex">
      <img class="w-44 h-44" src="{{ asset('images/cat_ladies.jpg') }}" alt="">
      <div class="ml-10">
        <a href="{{ route('product.index', ['categories' => [2, 4]]) }}"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Top</a>
        <a href="{{ route('product.index', ['categories' => [2, 4, 14]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts
          (Short Sleeve)</a>
        <a href="{{ route('product.index', ['categories' => [2, 4, 15]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts
          (Long Sleeve)</a>
        <a href="{{ route('product.index', ['categories' => [2, 4, 19]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shirts
          & Blouses</a>
        <a href="{{ route('product.index', ['categories' => [2, 4, 20]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Dresses
          | Tunic | Jumpsuits</a>
        <a href="{{ route('product.index', ['categories' => [2, 4, 22]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sweaters</a>
        <a href="{{ route('product.index', ['categories' => [2, 4, 23]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jackets</a>
        <a href="{{ route('product.index', ['categories' => [2, 4, 24]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Knitwears</a>
      </div>
      <div class="ml-20">
        <a href="{{ route('product.index', ['categories' => [2, 5]]) }}"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Bottom</a>
        <a href="{{ route('product.index', ['categories' => [2, 5, 30]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Skirts</a>
        <a href="{{ route('product.index', ['categories' => [2, 5, 29]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Pants</a>
      </div>
      <div class="ml-20">
        <a href="{{ route('product.index', ['categories' => [2, 6]]) }}"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Accesoris</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 43]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Scarves</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 31]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Bags</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 34]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Hats
          & Beanies</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 35]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sandals</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 36]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shoes</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 38]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Wallets</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 37]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Socks</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 41]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sunglasses</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 42]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Tumbler</a>
        <a href="{{ route('product.index', ['categories' => [2, 6, 39]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Watches</a>
      </div>
    </div>
  </div>

  {{-- Kids --}}
  <div @click.away="isKidsOpen = false" @mouseleave="isKidsOpen = false" x-cloak x-show="isKidsOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
    class="absolute z-20 left-0 top-16 bg-white rounded-b-md shadow-lg w-full">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 bg-white flex">
      <img class="w-44 h-44" src="{{ asset('images/cat_kids.jpg') }}" alt="">
      <div class="ml-10">
        <a href="{{ route('product.index', ['categories' => [3, 7]]) }}"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Boys</a>
        <a href="{{ route('product.index', ['categories' => [3, 7, 11]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts</a>
        <a href="{{ route('product.index', ['categories' => [3, 7, 22]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sweaters
          | Hoodies</a>
        <a href="{{ route('product.index', ['categories' => [3, 7, 23]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jackets</a>
        <a href="{{ route('product.index', ['categories' => [3, 7, 29]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Pants</a>
        <a href="{{ route('product.index', ['categories' => [3, 7, 6]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Accesoris</a>
      </div>
      <div class="ml-20">
        <a href="{{ route('product.index', ['categories' => [3, 8]]) }}"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Girls</a>
        <a href="{{ route('product.index', ['categories' => [3, 8, 11]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts</a>
        <a href="{{ route('product.index', ['categories' => [3, 8, 22]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sweaters</a>
        <a href="{{ route('product.index', ['categories' => [3, 8, 23]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jackets</a>
        <a href="{{ route('product.index', ['categories' => [3, 8, 29]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Pants</a>
        <a href="{{ route('product.index', ['categories' => [3, 8, 30]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Skirts</a>
        <a href="{{ route('product.index', ['categories' => [3, 8, 6]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Accesoris</a>
      </div>
      <div class="ml-20">
        <a href="{{ route('product.index', ['categories' => [3, 9]]) }}"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Baby</a>
        <a href="{{ route('product.index', ['categories' => [3, 9, 10]]) }}"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">New
          Born | Toddler</a>
      </div>
    </div>
  </div>

  <div id="notification_dropdown_1"
    class="hidden z-10 mx-auto w-full max-h-[75vh] space-y-2 overflow-auto scroll-hidden rounded-lg bg-white p-4 antialiased shadow-lg">
    @if ($notifications->count())

      @foreach ($notifications as $notification)
        <a href="{{ route('notifications.read', $notification->id) }}"
          class="grid grid-cols-12 p-2 {{ $notification->read_at ? 'bg-white' : 'bg-gray-100' }}">
          <div class="col-span-12">
            <p class="text-sm font-semibold text-gray-900">
              {{ $notification->data['subject'] }}</p>
            <p class="text-xs font-semibold text-gray-500 mb-2">{{ $notification->created_at->diffForHumans() }}</p>
            <p class="mt-0.5 text-sm font-normal text-gray-500">{{ $notification->data['message'] }}
            </p>
          </div>
        </a>
      @endforeach
    @else
      <div class="grid grid-cols-12 p-4 bg-white">
        <div class="col-span-12">
          <p class="mt-0.5 text-sm text-center font-normal text-gray-500">No notifications yet</p>
        </div>
      </div>
    @endif
  </div>

  <div id="notification_dropdown_2"
    class="hidden z-10 max-w-md max-h-[75vh] space-y-2 overflow-auto scroll-hidden rounded-lg bg-white p-2 antialiased shadow-lg absolute left-0">
    @if ($notifications->count())
      @foreach ($notifications as $notification)
        <a href="{{ route('notifications.read', $notification->id) }}"
          class="grid grid-cols-12 p-2 {{ $notification->read_at ? 'bg-white' : 'bg-gray-100' }}">
          <div class="col-span-12">
            <p class="text-sm font-semibold text-gray-900">
              {{ $notification->data['subject'] }}</p>
            <p class="text-xs font-semibold text-gray-500 mb-2">{{ $notification->created_at->diffForHumans() }}</p>
            <p class="mt-0.5 text-sm font-normal text-gray-500">{{ $notification->data['message'] }}
            </p>
          </div>
        </a>
      @endforeach
    @else
      <div class="grid grid-cols-12 p-4 bg-white">
        <div class="col-span-12">
          <p class="mt-0.5 text-sm text-center font-normal text-gray-500">No notifications yet</p>
        </div>
      </div>
    @endif
  </div>
</nav>
