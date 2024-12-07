<nav x-data="{ isNavOpen: false, isScrolled: false, isMenOpen: false, isWomanOpen: false, isKidsOpen: false }" x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 0; })" x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 0; })"
  :class="[
      (isScrolled || isMenOpen || isWomanOpen || isKidsOpen || @if(
      request()->is('/')) false @else true @endif) ?
      'bg-white transition-all duration-200' :
      'backdrop-blur-sm bg-black/25 transition-all duration-200',
      isScrolled ? 'shadow-lg' : ''
  ]"
  class="fixed top-0 z-40 w-full">
  {{-- <div class="px-4 md:px-6 lg:px-8">
    @if (session('success'))
      <x-alert-success :messages="session('success')" />
    @endif

    @if (session('error'))
      <x-alert-error :messages="session('error')" />
    @endif
  </div> --}}

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
              <a href="#"
                :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                    @if (request()->is('/')) false @else true @endif ? 'text-black' : 'text-white'"
                class="rounded-md px-2 py-2 text-sm uppercase font-[700] hover:text-red-500 transition ease-in-out duration-200">
                Men
              </a>
            </div>
            <div @mouseenter="isWomanOpen = true, isMenOpen = false, isKidsOpen = false">
              <a href="#"
                :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                    @if (request()->is('/')) false @else true @endif ? 'text-black' : 'text-white'"
                class="rounded-md px-2 py-2 text-sm uppercase font-[700] hover:text-red-500 transition ease-in-out duration-200">
                Woman
              </a>
            </div>
            <div @mouseenter="isKidsOpen = true, isMenOpen = false, isWomanOpen = false">
              <a href="#"
                :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                    @if (request()->is('/')) false @else true @endif ? 'text-black' : 'text-white'"
                class="rounded-md px-2 py-2 text-sm uppercase font-[700] hover:text-red-500 transition ease-in-out duration-200">
                Kids
              </a>
            </div>
            <a href="#" @mouseenter="isMenOpen = false, isWomanOpen = false, isKidsOpen = false"
              :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                  @if (request()->is('/')) false @else true @endif ? 'text-black' : 'text-white'"
              class="rounded-md px-2 py-2 text-sm uppercase font-[700] hover:text-red-500 transition ease-in-out duration-200">
              Sale
            </a>
            <a href="#" @mouseenter="isMenOpen = false, isWomanOpen = false, isKidsOpen = false"
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

          <button type="button" class="relative mx-3 flex justify-center items-center rounded-md">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <i :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
                @if (request()->is('/')) false @else true @endif ? 'text-red-500' : 'text-white'"
              class="fa-duotone fa-bell text-lg transition-all duration-200"></i>
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
            <a href="{{ route('profile.index') }}" class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0">
              <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                alt="User photo">
              {{-- <span class="">Open user menu</span> --}}
            </a>
            {{-- <button type="button" class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
              <div class="py-3 px-4">
                @php
                  $nameParts = explode(' ', Auth::user()->name);
                @endphp
                <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ $nameParts[0] }}{{ isset($nameParts[1]) ? ' ' . $nameParts[1] : '' }}</span>
                <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
              </div>
              <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                <li>
                  <a href="{{ route('profile.edit') }}" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My profile</a>
                </li>
              </ul>
              <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" type="butoon" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                      Log out
                    </a>  
                  </form>
                </li>
              </ul>
            </div> --}}
          @else
            {{-- <button @click="openModal = 'login'" type="button" :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen || @if (request()->is('/')) false @else true @endif ? 'text-red-500 ring-red-500 hover:bg-red-500 hover:text-white' : 'text-white ring-white hover:bg-white hover:text-gray-600'" type="button" class="ring-1 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 ml-3 transition-all duration-200">
              Login
            </button> --}}
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
      {{-- <div class="-mr-2 flex md:hidden">
        <!-- Mobile menu button -->
        <button @click="isNavOpen = !isNavOpen" type="button"
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
        </button>
      </div> --}}
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
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Top</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Polo
          Shirts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Long
          Shirts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Short
          Shirts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Hoodies</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sweaters</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jackets</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Knitwears</a>
      </div>
      <div class="ml-20">
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Bottom</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jeans</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Chinos</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jogger
          & Cargo</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shorts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Pants</a>
      </div>
      <div class="ml-20">
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Accesoris</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Backpack
          & Travel Bags</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Waist
          & Sling Bags</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Hats
          & Beanies</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sandals</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shoes</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Wallets</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Watches</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Belts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sunglasses</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Others</a>
      </div>
      <div class="ml-20">
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Apparel</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Bodysuit</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">One
          Set</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Tops</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Bottoms</a>
      </div>
    </div>
  </div>

  <!-- Woman -->
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
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Top</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts
          (Short Sleeve)</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts
          (Long Sleeve)</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shirts
          & Blouses</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Dresses
          | Tunic | Jumpsuits</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sweaters</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jackets</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Knitwears</a>
      </div>
      <div class="ml-20">
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Bottom</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Skirts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Pants</a>
      </div>
      <div class="ml-20">
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Accesoris</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Scarves</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Bags</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Hats
          & Beanies</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sandals</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shoes</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Wallets</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Socks</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Hats</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sunglasses</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Tumbler</a>
        <a href="#"
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
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Boys</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shirts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sweaters
          | Hoodies</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jackets</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Pants</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Accesoris</a>
      </div>
      <div class="ml-20">
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Girls</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">T-Shirts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Dress
          & Blouses</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Shirts
          & Pajamas</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Sweaters</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Jackets</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Pants</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Skirts</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">Accesoris</a>
      </div>
      <div class="ml-20">
        <a href="#"
          class="block text-sm font-semibold text-black hover:text-red-500 transition ease-in-out duration-200 mb-8">Baby</a>
        <a href="#"
          class="block text-sm font-normal text-black hover:text-red-500 transition ease-in-out duration-200 mb-3">New
          Born | Toddler</a>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  {{-- <div x-show="isNavOpen" class="md:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="#"
        :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
            @if (request()->is('/')) false @else true @endif ?
            'text-gray-900' :
            'text-white'"
        class="block rounded-md px-3 py-2 text-base font-medium">Men</a>
      <a href="#"
        :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
            @if (request()->is('/')) false @else true @endif ?
            'text-gray-900' :
            'text-white'"
        class="block rounded-md px-3 py-2 text-base font-medium">Woman</a>
      <a href="#"
        :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
            @if (request()->is('/')) false @else true @endif ?
            'text-gray-900' :
            'text-white'"
        class="block rounded-md px-3 py-2 text-base font-medium">kids</a>
      <a href="#"
        :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
            @if (request()->is('/')) false @else true @endif ?
            'text-gray-900' :
            'text-white'"
        class="block rounded-md px-3 py-2 text-base font-medium">Sale</a>
      <a href="#"
        :class="isScrolled || isMenOpen || isWomanOpen || isKidsOpen ||
            @if (request()->is('/')) false @else true @endif ?
            'text-gray-900' :
            'text-white'"
        class="block rounded-md px-3 py-2 text-base font-medium">Blog</a>
    </div>
    <div class="border-t border-gray-700 pb-3 pt-4">
      <div class="flex items-center px-5">
        <div class="flex-shrink-0">
          <img class="h-10 w-10 rounded-full"
            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            alt="">
        </div>
        <div class="ml-3">
          <div class="text-base font-medium leading-none text-white">Tom Cook</div>
          <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
        </div>
        <button type="button"
          class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
          <span class="absolute -inset-1.5"></span>
          <span class="sr-only">View notifications</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
          </svg>
        </button>
      </div>
      <div class="mt-3 space-y-1 px-2">
        <a href="#"
          class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Your
          Profile</a>
        <a href="#"
          class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">
          Logout</a>
      </div>
    </div>
  </div> --}}
</nav>
