<aside
  class="fixed top-0 left-0 z-40 w-64 h-screen mt-14 transition-transform -translate-x-full bg-white lg:translate-x-0 dark:bg-gray-800"
  aria-label="Sidenav" id="drawer-navigation">
  <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
    {{-- <form action="#" method="GET" class="md:hidden mb-2">
      <label for="sidebar-search" class="sr-only">Search</label>
      <div class="relative">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
          <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
            </path>
          </svg>
        </div>
        <input type="text" name="search" id="sidebar-search"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
          placeholder="Search" />
      </div>
    </form> --}}
    <ul class="space-y-2">
      <li>
        <a href="{{ route('dashboard.index') }}"
          class="{{ request()->routeIs('dashboard.index') ? 'text-white bg-red-500 hover:bg-red-500' : 'text-gray-900 bg-white hover:bg-gray-100' }} flex items-center p-3 text-sm font-medium rounded-lg group">
          <div class="w-6 h-6 flex justify-center items-center">
            <i class="fa-light fa-gauge"></i>
          </div>
          <span class="ml-3">Dashboard</span>
        </a>
      </li>
      <li x-data="{ openusers: false }">
        <button type="button"
          class="{{ request()->routeIs('dashboard.user.*') ? 'text-white bg-red-500 hover:bg-red-500' : 'text-gray-900 bg-white hover:bg-gray-100' }} w-full flex items-center p-3 text-sm font-medium rounded-lg group"
          aria-controls="dropdown-users" x-on:click="openusers = !openusers">
          <div class="w-6 h-6 flex justify-center items-center">
            <i class="fa-light fa-users"></i>
          </div>
          <span class="flex-1 ml-3 text-left whitespace-nowrap">Users</span>
          <i
            :class="openusers ? 'fa-sharp fa-regular fa-chevron-right text-xs' : 'fa-sharp fa-regular fa-chevron-down text-xs'"></i>
        </button>
        <ul id="dropdown-users" x-show="openusers" class="py-2 space-y-2">
          <li>
            <a href="{{ route('dashboard.user.admin.index') }}"
              class="flex items-center p-3 pl-12 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              Admin
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.user.client.index') }}"
              class="flex items-center p-3 pl-12 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              Client
            </a>
          </li>
        </ul>
      </li>

      <li x-data="{ openproducts: false }">
        <button type="button"
          class="{{ request()->routeIs('dashboard.product.*') ? 'text-white bg-red-500 hover:bg-red-500' : 'text-gray-900 bg-white hover:bg-gray-100' }} w-full flex items-center p-3 text-sm font-medium rounded-lg group"
          aria-controls="dropdown-users" x-on:click="openproducts = !openproducts">
          <div class="w-6 h-6 flex justify-center items-center">
            <i class="fa-light fa-shirt"></i>
          </div>
          <span class="flex-1 ml-3 text-left whitespace-nowrap">Product</span>
          <i
            :class="openproducts ? 'fa-sharp fa-regular fa-chevron-right text-xs' : 'fa-sharp fa-regular fa-chevron-down text-xs'"></i>
        </button>
        <ul id="dropdown-users" x-show="openproducts" class="py-2 space-y-2">
          <li>
            <a href="{{ route('dashboard.product.category.index') }}"
              class="flex items-center p-3 pl-12 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              Category
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.user.client.index') }}"
              class="flex items-center p-3 pl-12 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              Product
            </a>
          </li>
        </ul>
      </li>
      <li x-data="{ openpages: false }">
        <button type="button"
          class="flex items-center p-3 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
          aria-controls="dropdown-pages" x-on:click="openpages = !openpages">
          <div class="w-6 h-6 flex justify-center items-center">
            <i class="fa-light fa-file-circle-plus"></i>
          </div>
          <span class="flex-1 ml-3 text-left whitespace-nowrap">Pages</span>
          <i
            :class="openpages ? 'fa-sharp fa-regular fa-chevron-right text-xs' : 'fa-sharp fa-regular fa-chevron-down text-xs'"></i>
        </button>
        <ul id="dropdown-pages" x-show="openpages" class="py-2 space-y-2">
          <li>
            <a href="#"
              class="flex items-center p-3 pl-12 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              Settings
            </a>
          </li>
          <li>
            <a href="#"
              class="flex items-center p-3 pl-12 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              Kanban
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#"
          class="flex items-center p-3 text-sm font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <div class="w-6 h-6 flex justify-center items-center">
            <i class="fa-light fa-message-lines"></i>
          </div>
          <span class="flex-1 ml-3 whitespace-nowrap">Messages</span>
          <span
            class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800">
            4
          </span>
        </a>
      </li>
    </ul>
  </div>
</aside>
