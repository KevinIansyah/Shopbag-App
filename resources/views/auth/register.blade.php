@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1"
      class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 flex flex-col lg:flex-row items-center justify-center gap-10 lg:gap-40 min-h-[100vh]">
      <div class="relative w-full max-w-xl max-h-full">
        <div class="flex items-center justify-between pb-4">
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
              Create an Account!
            </h3>
            <p class="text-sm text-gray-400">Please enter details below to continue.</p>
          </div>

        </div>

        <div class="">
          <a href="{{ route('auth.redirect') }}"
            class="w-full text-gray-400 bg-white hover:bg-gray-200 border border-gray-300 hover:border-white font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800 transition-all duration-200 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 48 48">
              <path fill="#FFC107"
                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
              </path>
              <path fill="#FF3D00"
                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
              </path>
              <path fill="#4CAF50"
                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
              </path>
              <path fill="#1976D2"
                d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
              </path>
            </svg>
            <span>Google</span>
          </a>

          <div class="inline-flex items-center justify-center w-full">
            <hr class="w-64 h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <span
              class="absolute px-3 font-light text-sm text-gray-300 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">or</span>
          </div>

          <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-3">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <input type="text" id="name-register" name="name" value="{{ old('name') }}"
                  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-400 dark:focus:border-red-400 dark:shadow-sm-light"
                  placeholder="e.g. Your Name" value="{{ old('name') }}" required />
              </div>

              <div>
                <input type="email" id="email-register" name="email" value="{{ old('email') }}"
                  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-400 dark:focus:border-red-400 dark:shadow-sm-light"
                  placeholder="youremail@gmail.com" value="{{ old('email') }}" required />
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <div class="relative w-full">
                  <div class="absolute inset-y-0 end-2.5 flex items-center ps-3 pointer-events-none">
                    <i class="fa-duotone fa-solid fa-calendar-days text-red-500"></i>
                  </div>
                  <input datepicker id="default-datepicker" type="text" name="birthday"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Select date" value="{{ old('birthday') }}" required>
                </div>
              </div>

              <div>
                <select id="gender" name="gender"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                  required>
                  @php
                    $oldGender = old('gender');
                  @endphp
                  <option value="" disabled {{ !$oldGender ? 'selected' : '' }}>Select gender</option>
                  <option value="male" {{ $oldGender === 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ $oldGender === 'female' ? 'selected' : '' }}>Female</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <input type="password" id="password-register" name="password" autocomplete="new-password"
                  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-400 dark:focus:border-red-400 dark:shadow-sm-light"
                  placeholder="Password" required />
              </div>

              <div>
                <input type="password" id="repeat-password-register" name="password_confirmation"
                  autocomplete="new-password"
                  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-400 dark:focus:border-red-400 dark:shadow-sm-light"
                  placeholder="Confirm Password" required />
              </div>
            </div>

            @if ($errors->any())
              <div id="register-error-alert"
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
                  <ul id="register-confirmation-errors" class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->get('name') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                    @foreach ($errors->get('email') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                    @foreach ($errors->get('password') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                    @foreach ($errors->get('password_confirmation') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @endif

            <div class="flex items-start">
              <div class="flex items-center h-5">
                <input id="terms" type="checkbox" value=""
                  class="w-4 h-4 text-red-500 bg-gray-100 border-gray-300 rounded focus:ring-red-300 dark:focus:ring-red-500 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                  required />
              </div>
              <label for="terms" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the
                <a href="#" class="text-red-600 hover:underline dark:text-red-500">
                  terms and conditions
                </a>
              </label>
            </div>
            <button type="submit"
              class="w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
              <span id="button-text-register">Register new account</span>
            </button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
              Already have an account?
              <a href="{{ route('login') }}"
                class="text-red-600 hover:underline dark:text-red-500 transition-all duration-200">
                Sign in here
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="block">
        <img class="w-[28rem]" src="{{ asset('images/register.png') }}" alt="Register images">
      </div>
    </div>
  </main>
@endsection

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
