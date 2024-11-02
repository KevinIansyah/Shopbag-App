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
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

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

  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if (session('success_sweet'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success_sweet') }}',
        timer: 3000,
        timerProgressBar: true,
      });
    </script>
  @endif

  @if (session('error_sweet'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error_sweet') }}',
        timer: 13000,
        timerProgressBar: true,
      });
    </script>
  @endif

  @stack('scripts')
</body>

</html>
