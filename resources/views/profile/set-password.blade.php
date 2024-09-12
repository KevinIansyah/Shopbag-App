@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh]">
      <div class="lg:flex lg:gap-4">
        @include('profile.partials.aside')

        <div class="w-full h-auto bg-white dark:bg-gray-800">
          <div class="lg:rounded-lg lg:p-4">
            <div class="relative pb-6">
              <div>
                <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
                  aria-controls="default-sidebar" type="button"
                  class="inline-flex items-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                  <span class="sr-only">Open sidebar</span>
                  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                      d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                  </svg>
                </button>
                <h2 class="text-lg font-semibold">Set Password</h2>
                <p class="text-sm font-normal">Manage your password here!</p>
              </div>

              @if (session('success'))
                <x-alert-success class="mt-2" :messages="session('success')" />
              @endif
            </div>

            <div class="grid grid-cols-12 gap-8">
              <div class="col-span-12 md:col-span-8">
                <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-3">
                  @csrf
                  @method('PUT')

                  <div>
                    <label for="update_password_current_password"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                      Current Password</label>

                    <input type="password" name="current_password" id="update_password_current_password"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="••••••••" autocomplete="current-password" required />
                  </div>

                  <div>
                    <label for="update_password_password"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                      New Password</label>

                    <input type="password" name="password" id="update_password_password"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="••••••••" autocomplete="new-password" required />
                  </div>

                  <div>
                    <label for="update_password_password_confirmation"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                      Confirm Password</label>

                    <input type="password" name="password_confirmation" id="update_password_password_confirmation"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="••••••••" autocomplete="new-password" required />
                  </div>

                  @if ($errors->updatePassword->any())
                    <div id="login-error-alert"
                      class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                      role="alert">
                      <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                      </svg>
                      <span class="sr-only">Danger</span>
                      <div>
                        <span class="font-medium">Ensure that these requirements are met:</span>
                        <ul id="login-confirmation-errors" class="mt-1.5 list-disc list-inside">
                          @foreach ($errors->updatePassword->get('current_password') as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                          @foreach ($errors->updatePassword->get('password') as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                          @foreach ($errors->updatePassword->get('password_confirmation') as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  @endif

                  <div class="flex justify-start w-full">
                    <button type="submit"
                      class="w-full md:w-24 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
                      Save
                    </button>
                  </div>
                </form>
                {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                  <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
