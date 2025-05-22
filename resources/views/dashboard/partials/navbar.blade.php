<nav class="bg-white px-4 py-2.5 fixed left-0 right-0 top-0 z-40">
  <div class="flex flex-wrap justify-between items-center">
    <div class="flex justify-start items-center">
      <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
        aria-controls="drawer-navigation"
        class="w-10 h-10 flex items-center justify-center mr-2 text-gray-600 rounded-lg cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100">
        <i class="fa-sharp fa-regular fa-bars"></i>
        <span class="sr-only">Toggle sidebar</span>
      </button>
      <a href="https://flowbite.com" class="flex items-center justify-center mr-3">
        <img class="h-10" src="{{ asset('images/logo-2.png') }}" alt="Logo shopbag">
        {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap">Shopbag</span> --}}
      </a>

      {{-- <a href="/" class="flex-shrink-0">
        <img class="h-8" src="{{ asset('images/logo.png') }}" alt="logo">
      </a> --}}
      <form action="#" method="GET" class="hidden md:block md:pl-2">
        <label for="topbar-search" class="sr-only">Search</label>
        <div class="relative md:w-64 lg:w-96">
          <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
              </path>
            </svg>
          </div>
          <input type="text" name="email" id="topbar-search"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5"
            placeholder="Search" />
        </div>
      </form>
    </div>
    <div class="flex items-center lg:order-2">
      {{-- <button type="button" data-drawer-toggle="drawer-navigation" aria-controls="drawer-navigation"
        class="h-5 w-5 flex items-center justify-center text-gray-500 md:hidden">
        <span class="sr-only">Toggle search</span>
        <i class="fa-duotone fa-magnifying-glass text-xl transition-all duration-200 text-red-500"></i>
      </button> --}}

      <button type="button" data-dropdown-toggle="notification-dropdown"
        class="h-5 w-5 flex items-center justify-center ml-4 text-gray-500">
        <span class="sr-only">View notifications</span>
        <i class="fa-duotone fa-bell text-xl transition-all duration-200 text-red-500"></i>
      </button>
      <div
        class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg"
        id="notification-dropdown">
        <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50">
          Notifications
        </div>
        <div>
          @foreach ($notifications as $notification)
            @if ($notifications->count())
              @foreach ($notifications as $notification)
                <a href="{{ route('notifications.read', $notification->id) }}"
                  class="flex py-3 px-4 border-b {{ $notification->read_at ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                  <div class="pl-3 w-full">
                    <div class="text-gray-500 font-normal text-sm mb-1.5">
                      <span class="font-semibold text-gray-900">{{ $notification->data['subject'] }}</span>
                      <br>
                      {{ $notification->data['message'] }}
                    </div>
                    <div class="text-xs font-medium text-primary-600">
                      {{ $notification->created_at->diffForHumans() }}
                    </div>
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
          @endforeach
        </div>
      </div>

      @if (Auth::user()->image)
        <button type="button" class="flex ml-5 text-sm rounded-full md:mr-0" id="user-menu-button"
          aria-expanded="false" data-dropdown-toggle="dropdown">
          <span class="sr-only">Open user menu</span>
          <img class="w-8 h-8 rounded-full" src="{{ asset('storage/image-filepond/' . Auth::user()->image) }}"
            alt="user photo" />
        </button>
      @else
        <button type="button" class="flex ml-5 text-sm rounded-full md:mr-0" id="user-menu-button"
          aria-expanded="false" data-dropdown-toggle="dropdown">
          <span class="sr-only">Open user menu</span>
          <img class="w-8 h-8 rounded-full" src="{{ asset('images/default-profile.png') }}" alt="user photo" />
        </button>
      @endif
      <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow"
        id="dropdown">
        <div class="py-3 px-4">
          <span class="block text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</span>
          <span class="block text-sm text-gray-900 truncate">{{ Auth::user()->email }}</span>
        </div>
        <ul class="py-1 text-gray-700" aria-labelledby="dropdown">
          <li>
            <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-100">My
              profile</a>
          </li>
          <li>
            <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-100">Account
              settings</a>
          </li>
        </ul>
        <ul class="py-1 text-gray-700" aria-labelledby="dropdown">
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                class="block py-2 px-4 text-sm hover:bg-gray-100">
                Sign out
              </a>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
