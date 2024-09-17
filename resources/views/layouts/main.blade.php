<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Shopbag</title>

  <link rel="shortcut icon" href="{{ asset('images/tab-icon.png') }}" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>

  <link rel="stylesheet" href="{{ asset('css/main.css') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    [x-cloak] {
      display: none;
    }
  </style>
</head>

<body x-data="{ openModal: @js(session('loginModal') ? 'login' : null) }">
  @include('partials.navbar')
  @yield('main')
  @include('partials.footer')
  @include('partials.bottombar')

  {{-- <div 
    tabindex="-1"
    x-cloak 
    x-show="openModal === 'login'" 
    class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden"
  >
    <div @click="openModal = null" class="fixed inset-0 bg-black bg-opacity-75"></div>
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

        <div class="flex items-center justify-between px-4 pt-4 md:px-5 md:pt-5 rounded-t">
          <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              Welcome!
            </h3>
            <p class="text-sm text-gray-400">Please enter details below to continue.</p>
          </div>
          <button @click="openModal = null" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition-all duration-200">
            <svg class="w-3 h-3" x-bind:aria-hidden="openModal !== 'login'"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>

        <div class="p-4 md:p-5">
          <button type="button" class="w-full text-white bg-gray-400 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800 transition-all duration-200">
            <i class="fa-brands fa-google mr-2"></i>
            Google
          </button>

          <div class="inline-flex items-center justify-center w-full">
            <hr class="w-64 h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <span class="absolute px-3 font-light text-sm text-gray-300 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">or</span>
          </div>

          <form id="login-form" method="POST" action="{{ route('login') }}" class="flex flex-col gap-3">
            @csrf
            <div>
              <input type="email" name="email" id="email-login" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="youremail@gmail.com" required />
            </div>
            
            <div>
              <input type="password" name="password" id="password-login" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
            </div>

            <div id="login-error-alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 hidden" role="alert">
              <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg>
              <span class="sr-only">Danger</span>
              <div>
                <span class="font-medium">Ensure that these requirements are met:</span>
                  <ul id="login-confirmation-errors" class="mt-1.5 list-disc list-inside">
                </ul>
              </div>
            </div>

            <div class="flex justify-between">
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input id="remember" type="checkbox" value="" class="w-4 h-4 text-red-500 bg-gray-100 border-gray-300 rounded focus:ring-red-300 dark:focus:ring-red-500 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required />
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
              </div>
              <a href="#" class="text-sm text-red-600 hover:underline dark:text-red-500 transition-all duration-200">
                Lost Password?
              </a>
            </div>
            <button type="submit" class="w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
              <span id="button-text-login">Login to your account</span>
            </button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
              Not registered? 
              <button @click="openModal = 'register'" type="button" class="text-red-600 hover:underline dark:text-red-500 transition-all duration-200">Create account</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div 
    tabindex="-1"
    x-cloak 
    x-show="openModal === 'register'" 
    class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto h-[calc(100%-1rem)]"
  >
    <div @click="openModal = null" class="fixed inset-0 bg-black bg-opacity-75"></div>
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

        <div class="flex items-center justify-between px-4 pt-4 md:px-5 md:pt-5 rounded-t">
          <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              Create an Account!
            </h3>
            <p class="text-sm text-gray-400">Please enter details below to continue.</p>
          </div>
          <button @click="openModal = null" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition-all duration-200">
            <svg class="w-3 h-3" x-bind:aria-hidden="openModal !== 'register'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>

        <div class="p-4 md:p-5">
          <button type="button" class="w-full text-white bg-gray-400 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800 transition-all duration-200">
            <i class="fa-brands fa-google mr-2"></i>
            Google
          </button>

          <div class="inline-flex items-center justify-center w-full">
            <hr class="w-64 h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <span class="absolute px-3 font-light text-sm text-gray-300 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">or</span>
          </div>

          <form id="register-form" method="POST" action="{{ route('register') }}" class="flex flex-col gap-3">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <input type="text" id="name-register" name="name" value="{{ old('name') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-400 dark:focus:border-red-400 dark:shadow-sm-light" placeholder="e.g. Your Name" required />
              </div>
              
              <div>
                <input type="email" id="email-register" name="email" value="{{ old('email') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-400 dark:focus:border-red-400 dark:shadow-sm-light" placeholder="youremail@gmail.com" required />
              </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <input type="password" id="password-register" name="password" autocomplete="new-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-400 dark:focus:border-red-400 dark:shadow-sm-light" placeholder="Password" required />
              </div>
              
              <div>
                <input type="password" id="repeat-password-register" name="password_confirmation" autocomplete="new-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-400 dark:focus:border-red-400 dark:shadow-sm-light" placeholder="Confirm Password" required />
              </div>
            </div>

            <div id="register-error-alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 hidden" role="alert">
              <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg>
              <span class="sr-only">Danger</span>
              <div>
                <span class="font-medium">Ensure that these requirements are met:</span>
                  <ul id="register-confirmation-errors" class="mt-1.5 list-disc list-inside">
                </ul>
              </div>
            </div>

            <div class="flex items-start">
              <div class="flex items-center h-5">
                  <input id="terms" type="checkbox" value="" class="w-4 h-4 text-red-500 bg-gray-100 border-gray-300 rounded focus:ring-red-300 dark:focus:ring-red-500 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required />
              </div>
              <label for="terms" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a href="#" class="text-red-600 hover:underline dark:text-red-500">terms and conditions</a></label>
            </div>
            <button type="submit" class="w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
              <span id="button-text-register">Register new account</span>
            </button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
              Already have an account?
              <button @click="openModal = 'login'" type="button" class="text-red-600 hover:underline dark:text-red-500 transition-all duration-200">Sign in here</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> --}}



  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
    // let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // $(document).ready(function() {
    //   $('#register-form').on('submit', function(event) {
    //     event.preventDefault();

    //     let form = $(this);
    //     let formData = form.serialize();
    //     $('#button-text-register').text('Loading...');

    //     $.ajax({
    //       url: form.attr('action'),
    //       type: 'POST',
    //       data: formData,
    //       success: function(response) {
    //         window.location.reload();
    //       },
    //       error: function(xhr) {
    //         $('#button-text-register').text('Register new account');
    //         $('#register-confirmation-errors').html('');
    //         $('#register-error-alert').addClass('hidden');

    //         if (xhr.responseJSON && xhr.responseJSON.errors) {
    //           let errors = xhr.responseJSON.errors;
    //           let allErrors = '';

    //           $.each(errors, function(key, value) {
    //               allErrors += '<li>' + value.join('</li><li>') + '</li>';
    //           });

    //           $('#register-confirmation-errors').html(allErrors);
    //           $('#register-error-alert').removeClass('hidden').addClass('flex');
    //         }
    //       },
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       }
    //     });
    //   });
    // });

    // $(document).ready(function() {
    //   $('#login-form').on('submit', function(event) {
    //     event.preventDefault();

    //     let form = $(this);
    //     let formData = form.serialize();
    //     $('#button-text-login').text('Loading...');

    //     $.ajax({
    //       url: form.attr('action'),
    //       type: 'POST',
    //       data: formData,
    //       success: function(response) {
    //         if (response.user === 'user') {
    //           window.location.reload();
    //         } else {
    //           window.location.href = '/dashboard';
    //         }
    //       },
    //       error: function(xhr) {
    //         console.log(xhr.responseJSON);
    //         $('#button-text-login').text('Login to your account');
    //         $('#login-confirmation-errors').html('');
    //         $('#login-error-alert').addClass('hidden');

    //         if (xhr.responseJSON && xhr.responseJSON.errors) {
    //           let errors = xhr.responseJSON.errors;
    //           let allErrors = '';

    //           $.each(errors, function(key, value) {
    //               allErrors += '<li>' + value.join('</li><li>') + '</li>';
    //           });

    //           $('#login-confirmation-errors').html(allErrors);
    //           $('#login-error-alert').removeClass('hidden').addClass('flex');
    //         }
    //       },
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       }
    //     });
    //   });
    // });
  </script>

  @stack('scripts')
</body>

</html>
