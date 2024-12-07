@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh]">
      <div class="lg:flex lg:gap-4">
        <div class="w-full h-auto bg-white">
          <div class="lg:rounded-lg">
            <div class="flex flex-col items-center justify-center">
              <img class="w-full md:w-[50%]" src="{{ asset('images/no-data.jpg') }}" alt="No data available">
              <h6 class="text-lg font-semibold text-black">No blogs available yet!</h6>
              <p class="text-sm font-normal text-black">We currently don't have any blogs to show. Stay tuned for our
                latest updates!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
