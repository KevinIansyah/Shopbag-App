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

      <!-- Notifications -->
      <button type="button" data-dropdown-toggle="notification-dropdown"
        class="h-5 w-5 flex items-center justify-center ml-4 text-gray-500">
        <span class="sr-only">View notifications</span>
        <i class="fa-duotone fa-bell text-xl transition-all duration-200 text-red-500"></i>
      </button>
      <!-- Dropdown menu -->
      <div
        class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg"
        id="notification-dropdown">
        <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50">
          Notifications
        </div>
        <div>
          <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100">
            <div class="flex-shrink-0">
              <img class="w-11 h-11 rounded-full"
                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"
                alt="Bonnie Green avatar" />
              <div
                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-primary-700">
                <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                  </path>
                  <path
                    d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                  </path>
                </svg>
              </div>
            </div>
            <div class="pl-3 w-full">
              <div class="text-gray-500 font-normal text-sm mb-1.5">
                New message from
                <span class="font-semibold text-gray-900">Bonnie Green</span>
                : "Hey, what's up? All set for the presentation?"
              </div>
              <div class="text-xs font-medium text-primary-600">
                a few moments ago
              </div>
            </div>
          </a>
          <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100">
            <div class="flex-shrink-0">
              <img class="w-11 h-11 rounded-full"
                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                alt="Jese Leos avatar" />
              <div
                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-gray-900 rounded-full border border-white">
                <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                  </path>
                </svg>
              </div>
            </div>
            <div class="pl-3 w-full">
              <div class="text-gray-500 font-normal text-sm mb-1.5">
                <span class="font-semibold text-gray-900">Jese leos</span>
                and
                <span class="font-medium text-gray-900">5 others</span>
                started following you.
              </div>
              <div class="text-xs font-medium text-primary-600">
                10 minutes ago
              </div>
            </div>
          </a>
          <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100">
            <div class="flex-shrink-0">
              <img class="w-11 h-11 rounded-full"
                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"
                alt="Joseph McFall avatar" />
              <div
                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-red-600 rounded-full border border-white">
                <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                    clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
            <div class="pl-3 w-full">
              <div class="text-gray-500 font-normal text-sm mb-1.5">
                <span class="font-semibold text-gray-900">Joseph Mcfall</span>
                and
                <span class="font-medium text-gray-900">141 others</span>
                love your story. See it and view more stories.
              </div>
              <div class="text-xs font-medium text-primary-600">
                44 minutes ago
              </div>
            </div>
          </a>
          <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100">
            <div class="flex-shrink-0">
              <img class="w-11 h-11 rounded-full"
                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"
                alt="Roberta Casas image" />
              <div
                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-green-400 rounded-full border border-white">
                <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                    clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
            <div class="pl-3 w-full">
              <div class="text-gray-500 font-normal text-sm mb-1.5">
                <span class="font-semibold text-gray-900">Leslie Livingston</span>
                mentioned you in a comment:
                <span class="font-medium text-primary-600">@bonnie.green</span>
                what do you say?
              </div>
              <div class="text-xs font-medium text-primary-600">
                1 hour ago
              </div>
            </div>
          </a>
          <a href="#" class="flex py-3 px-4 hover:bg-gray-100">
            <div class="flex-shrink-0">
              <img class="w-11 h-11 rounded-full"
                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/robert-brown.png"
                alt="Robert image" />
              <div
                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-purple-500 rounded-full border border-white">
                <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                  </path>
                </svg>
              </div>
            </div>
            <div class="pl-3 w-full">
              <div class="text-gray-500 font-normal text-sm mb-1.5">
                <span class="font-semibold text-gray-900">Robert Brown</span>
                posted a new video: Glassmorphism - learn how to implement
                the new design trend.
              </div>
              <div class="text-xs font-medium text-primary-600">
                3 hours ago
              </div>
            </div>
          </a>
        </div>
        <a href="#"
          class="block py-2 text-md font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100">
          <div class="inline-flex items-center">
            <svg aria-hidden="true" class="mr-2 w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
              <path fill-rule="evenodd"
                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                clip-rule="evenodd"></path>
            </svg>
            View all
          </div>
        </a>
      </div>

      <!-- User profile -->
      <button type="button" class="flex ml-5 text-sm bg-gray-800 rounded-full md:mr-0" id="user-menu-button"
        aria-expanded="false" data-dropdown-toggle="dropdown">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full"
          src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png" alt="user photo" />
      </button>
      <!-- Dropdown menu -->
      <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow"
        id="dropdown">
        <div class="py-3 px-4">
          <span class="block text-sm font-semibold text-gray-900">Neil Sims</span>
          <span class="block text-sm text-gray-900 truncate">name@flowbite.com</span>
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
            {{-- <a href="#"
              class="block py-2 px-4 text-sm hover:bg-gray-100">Sign
              out</a> --}}
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
