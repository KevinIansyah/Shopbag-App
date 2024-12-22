<div
  class="fixed z-40 w-full h-16 max-w-lg -translate-x-1/2 bg-white border border-gray-200 bottom-0 left-1/2 dark:bg-gray-700 dark:border-gray-600 md:hidden">
  <div class="grid h-full max-w-lg grid-cols-5 mx-auto">
    <div class="flex items-center justify-center">
      <a href="/" data-tooltip-target="tooltip-home" type="button"
        class="{{ request()->is('/') ? 'inline-flex items-center justify-center w-10 h-10 font-medium bg-red-500 rounded-full hover:bg-red-600 group focus:ring-4 focus:ring-red-300 focus:outline-none text-white' : 'inline-flex flex-col items-center justify-center px-5 text-gray-400 group' }}">
        <i class="fa-sharp fa-solid fa-house text-lg"></i>
        <span class="sr-only">Home</span>
      </a>
    </div>
    <div id="tooltip-home" role="tooltip"
      class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
      Home
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div class="flex items-center justify-center">
      <a href="{{ route('product.index') }}" data-tooltip-target="tooltip-sale" type="button"
        class="{{ request()->routeIs('product.*') ? 'inline-flex items-center justify-center w-10 h-10 font-medium bg-red-500 rounded-full hover:bg-red-600 group focus:ring-4 focus:ring-red-300 focus:outline-none text-white' : 'inline-flex flex-col items-center justify-center px-5 text-gray-400 group' }}">
        <i class="fa-sharp fa-solid fa-tags text-lg"></i>
        <span class="sr-only">Sale</span>
      </a>
    </div>
    <div id="tooltip-sale" role="tooltip"
      class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
      Sale
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div class="flex items-center justify-center">
      <a href="{{ route('profile.index', ['p' => 'transaction-list']) }}" data-tooltip-target="tooltip-transaction"
        type="button"
        class="{{ request()->routeIs('profile.index') && request()->get('p') == 'transaction-list' ? 'inline-flex items-center justify-center w-10 h-10 font-medium bg-red-500 rounded-full hover:bg-red-600 group focus:ring-4 focus:ring-red-300 focus:outline-none text-white' : 'inline-flex flex-col items-center justify-center px-5 text-gray-400 group' }}">
        <i class="fa-sharp fa-solid fa-arrow-right-arrow-left text-lg"></i>
        <span class="sr-only">Trancastion</span>
      </a>
    </div>
    <div id="tooltip-transaction" role="tooltip"
      class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
      Trancastion
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div class="flex items-center justify-center">
      <a href="{{ route('blog.index') }}" data-tooltip-target="tooltip-blog" type="button"
        class="{{ request()->routeIs('blog.*') ? 'inline-flex items-center justify-center w-10 h-10 font-medium bg-red-500 rounded-full hover:bg-red-600 group focus:ring-4 focus:ring-red-300 focus:outline-none text-white' : 'inline-flex flex-col items-center justify-center px-5 text-gray-400 group' }}">
        <i class="fa-sharp fa-solid fa-list text-lg"></i>
        <span class="sr-only">Blog</span>
      </a>
    </div>
    <div id="tooltip-blog" role="tooltip"
      class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
      Blog
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    @auth
      <div class="flex items-center justify-center">
        <a href="{{ route('profile.index') }}" data-tooltip-target="tooltip-profile" type="button"
          class="{{ request()->routeIs('profile.index') && !(request()->get('p') == 'transaction-list') ? 'inline-flex items-center justify-center w-10 h-10 font-medium bg-red-500 rounded-full hover:bg-red-600 group focus:ring-4 focus:ring-red-300 focus:outline-none text-white' : 'inline-flex flex-col items-center justify-center px-5 text-gray-400 group' }}">
          <i class="fa-sharp fa-solid fa-user text-lg"></i>
          <span class="sr-only">Profile</span>
        </a>
      </div>
      <div id="tooltip-profile" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Profile
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>
    @else
      <div class="flex items-center justify-center">
        <a href="{{ route('profile.index') }}" data-tooltip-target="tooltip-login" type="button"
          class="{{ request()->is('/login') || request()->is('/register') ? 'inline-flex items-center justify-center w-10 h-10 font-medium bg-red-500 rounded-full hover:bg-red-600 group focus:ring-4 focus:ring-red-300 focus:outline-none text-white' : 'inline-flex flex-col items-center justify-center px-5 text-gray-400 group' }}">
          <i class="fa-sharp fa-solid fa-right-to-bracket text-lg"></i>
          <span class="sr-only">Login</span>
        </a>
      </div>
      <div id="tooltip-login" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Login
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>
    @endauth


  </div>
</div>
