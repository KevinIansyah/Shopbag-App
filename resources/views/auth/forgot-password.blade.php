@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1"
      class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 flex flex-col lg:flex-row items-center justify-center gap-10 lg:gap-40 min-h-[100vh]">
      <div class="w-full max-w-md max-h-full">
        <div class="flex items-center justify-between pb-4">
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
              Forgot your password?
            </h3>
            <p class="text-sm text-gray-400">No problem. Just let us know your email address and we will email you a
              password reset link that will allow you to choose a new one.</p>
          </div>
        </div>

        <div class="">
          @if (session('status'))
            <div
              class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
              role="alert">
              <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
              </svg>
              <span class="sr-only">Info</span>
              <div>
                <span class="font-medium">Success!</span> {{ session('status') }}
              </div>
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-3">
            @csrf
            <div>
              <input type="email" name="email" id="email-login"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="youremail@gmail.com" required />
            </div>

            @if ($errors->any())
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
                    @foreach ($errors->get('email') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @endif

            <button type="submit"
              class="w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
              <span id="button-text-login">Email Password Reset Link</span>
            </button>
          </form>
        </div>
      </div>
      <div class="block">
        <img class="w-[28rem]" src="{{ asset('images/forgot-password.png') }}" alt="Forgot password images">
      </div>
    </div>
  </main>
@endsection



{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
