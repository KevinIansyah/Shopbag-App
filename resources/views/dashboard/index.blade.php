@extends('dashboard.layouts.main')

@section('main')
  <main class="lg:ml-64 min-h-screen px-4 md:px-8 lg:px-10 pt-14 pb-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 py-10">
      <div>
        <h2 class="text-2xl font-bold mb-1 md:mb-0">Dashboard</h2>
        <p class="text-sm font-normal">Welcome {{ Auth::user()->name }}!</p>
      </div>
      
      <nav class="flex text-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-medium text-red-500 hover:text-red-600">
              <i class="fa-solid fa-house text-xs mr-2"></i>
              Dashboard
            </a>
          </li>
        </ol>
      </nav>
    </div>

    <div class="h-72 md:h-96 mb-4">
      <img class="object-cover object-top w-full h-full" src="{{ asset('images/dashboard-2.png') }}" alt="">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
      <div class="border-2 border-dashed border-gray-300 rounded-lg h-32 md:h-64"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-32 md:h-64"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-32 md:h-64"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-32 md:h-64"></div>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-48 md:h-72"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-48 md:h-72"></div>
    </div>
  </main>
@endsection
