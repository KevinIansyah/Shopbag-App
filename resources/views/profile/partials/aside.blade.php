<aside id="profile-sidebar"
  class="absolute top-0 left-0 z-50 w-64 h-screen lg:h-auto transition-transform -translate-x-full lg:relative lg:top-auto lg:left-auto lg:translate-x-0 lg:z-0 lg:min-w-64"
  aria-label="Sidenav">
  <div
    class="overflow-y-auto h-full lg:h-auto p-4 bg-white lg:rounded-lg dark:bg-gray-800 dark:border-gray-700">
    @php
      $currentPage = request()->query('p') ?? 'profile';
    @endphp
    <ul class="space-y-2">
      <li>
        <a href="{{ route('profile.index', ['p' => 'profile']) }}"
          class="{{ $currentPage === 'profile' ? 'text-white bg-red-500 hover:bg-red-600 focus:ring-red-300' : 'text-gray-900 bg-white hover:bg-gray-100 focus:ring-gray-300' }} flex items-center p-2 text-sm font-normal rounded-lg focus:ring-4 focus:outline-none group transition-all duration-200">
          <div class="w-6 h-6 flex items-center justify-center">
            <i class="fa-light fa-user"></i>
          </div>
          <span class="ml-3">Profile</span>
        </a>
      </li>
      <li>
        <a href="{{ route('profile.index', ['p' => 'shipping-address']) }}"
          class="{{ $currentPage === 'shipping-address' ? 'text-white bg-red-500 hover:bg-red-600 focus:ring-red-300' : 'text-gray-900 bg-white hover:bg-gray-100 focus:ring-gray-300' }} flex items-center p-2 text-sm font-normal rounded-lg focus:ring-4 focus:outline-none group transition-all duration-200">
          <div class="w-6 h-6 flex items-center justify-center">
            <i class="fa-light fa-truck-fast"></i>
          </div>
          <span class="ml-3">Shipping Address</span>
        </a>
      </li>
      <li>
        <button type="button"
          class="{{ $currentPage === 'waiting-for-payment' || $currentPage === 'transaction-list' ? 'text-white bg-red-500 hover:bg-red-600 focus:ring-red-300' : 'text-gray-900 bg-white hover:bg-gray-100 focus:ring-gray-300' }} flex items-center p-2 w-full text-sm font-normal rounded-lg focus:ring-4 focus:outline-none group transition-all duration-200"
          aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
          <div class="w-6 h-6 flex items-center justify-center">
            <i class="fa-light fa-circle-dollar"></i>
          </div>
          <span class="flex-1 ml-3 text-left whitespace-nowrap">Transaction</span>
          <i class="fa-sharp fa-solid fa-chevron-down text-xs"></i>
        </button>
        <ul id="dropdown-pages" class="hidden py-2 space-y-2">
          <li>
            <a href="{{ route('profile.index', ['p' => 'waiting-for-payment']) }}"
              class="flex items-center p-2 pl-11 w-full text-sm font-normal rounded-lg transition duration-75 group">Waiting
              For Payment</a>
          </li>
          <li>
            <a href="{{ route('profile.index', ['p' => 'transaction-list']) }}"
              class="flex items-center p-2 pl-11 w-full text-sm font-normal rounded-lg transition duration-75 group">Transaction
              List</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="{{ route('profile.index', ['p' => 'set-password']) }}"
          class="{{ $currentPage === 'set-password' ? 'text-white bg-red-500 hover:bg-red-600 focus:ring-red-300' : 'text-gray-900 bg-white hover:bg-gray-100 focus:ring-gray-300' }} flex items-center p-2 text-sm font-normal rounded-lg focus:ring-4 focus:outline-none group transition-all duration-200">
          <div class="w-6 h-6 flex items-center justify-center">
            <i class="fa-light fa-lock"></i>
          </div>
          <span class="ml-3">Set Password</span>
        </a>
      </li>
      {{-- <li>
        <a href="{{ route('profile.index', ['p' => 'deactive-account']) }}"
           class="{{ $currentPage === 'deactive-account' ? 'text-white bg-red-500 hover:bg-red-600 focus:ring-red-300' : 'text-gray-900 bg-white hover:bg-gray-100 focus:ring-gray-300' }} flex items-center p-2 text-sm font-normal rounded-lg focus:ring-4 focus:outline-none group transition-all duration-200">
          <div class="w-6 h-6 flex items-center justify-center">
            <i class="fa-duotone fa-solid fa-user-xmark text-base"></i>
          </div>
          <span class="ml-3">Deactive Account</span>
        </a>
      </li> --}}
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
            class="{{ $currentPage === 'logout' ? 'text-white bg-red-500 hover:bg-red-600 focus:ring-red-300' : 'text-gray-900 bg-white hover:bg-gray-100 focus:ring-gray-300' }} flex items-center p-2 text-sm font-normal rounded-lg focus:ring-4 focus:outline-none group transition-all duration-200">
            <div class="w-6 h-6 flex items-center justify-center">
              <i class="fa-light fa-right-from-bracket"></i>
            </div>
            <span class="ml-3">Logout</span>
          </a>
        </form>
      </li>
    </ul>
  </div>
</aside>
