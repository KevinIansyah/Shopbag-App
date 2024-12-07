@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh]">
      <div class="lg:flex lg:gap-4">
        @include('profile.partials.aside')

        <div class="w-full h-auto bg-white dark:bg-gray-800">
          <div class="lg:rounded-lg lg:p-4">
            <div class="pb-6">
              <div class="flex items-center justify-between w-[100%]">
                <div>
                  <h2 class="text-xl font-semibold">Profile</h2>
                  <p class="text-sm font-normal">Manage your profile here!</p>
                </div>
                <button data-drawer-target="profile-sidebar" data-drawer-toggle="profile-sidebar"
                  aria-controls="profile-sidebar" type="button"
                  class="w-10 h-10 inline-flex items-center justify-center bg-red-500 hover:bg-red-600  text-white rounded-lg lg:hidden focus:outline-none focus:ring-2 focus:ring-red-300">
                  <span class="sr-only">Open sidebar</span>
                  <i class="fa-sharp fa-regular fa-bars text-base"></i>
                </button>
              </div>
            </div>

            <div class="grid grid-cols-12 gap-8">
              <div class="col-span-12 md:col-span-4">
                @if (Auth::user()->image)
                  <img class="w-full aspect-square object-cover rounded-lg"
                    src="{{ asset('storage/image-filepond/' . Auth::user()->image) }}" alt="User photo">
                @else
                  <img class="w-full aspect-square object-cover rounded-lg"
                    src="{{ asset('images/default-profile.png') }}" alt="User photo">
                @endif

                <ul class="list-disc text-[12px] font-semibold ml-4 py-2">
                  <li>File type (jpg/png/jpeg)</li>
                  <li>max size 10 Mb</li>
                </ul>
                <button type="button" data-modal-target="profile-modal" data-modal-toggle="profile-modal"
                  class="w-full text-red-500 ring-red-500 hover:bg-red-500 hover:text-white ring-1 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 transition-all duration-200">
                  Change Profile Picture
                </button>
              </div>

              <div class="col-span-12 md:col-span-8">
                @if ($errors->any())
                  <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
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
                        @foreach ($errors->get('name') as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                        @foreach ($errors->get('email') as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                        @foreach ($errors->get('phone') as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                        @foreach ($errors->get('gender') as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                        @foreach ($errors->get('birthday') as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                @endif

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                  @csrf
                </form>

                <form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-3">
                  @csrf
                  @method('PUT')
                  <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                      Phone</label>
                    <input type="text" name="phone"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="08xxxxxxxxxx" value="{{ old('phone', $user->phone) }}" />
                  </div>

                  <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                      Email</label>

                    <input type="email" name="email"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="youremail@gmail.com" value="{{ old('email', $user->email) }}" required />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                      <div id="alert-additional-content-2"
                        class="p-4 mt-2 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                        role="alert">
                        <div class="flex items-center">
                          <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                              d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                          </svg>
                          <span class="sr-only">Info</span>
                          <h3 class="text-sm font-semibold">This is a danger alert</h3>
                        </div>
                        <div class="mt-2 mb-4 text-sm">
                          Your email address is unverified. Click the button for verification!
                        </div>
                        <div class="flex">
                          <button form="send-verification"
                            class="text-red-500 ring-red-500 hover:bg-red-500 hover:text-white ring-1 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 transition-all duration-200">
                            Click Here!
                          </button>
                        </div>
                      </div>

                      @if (session('status') === 'verification-link-sent')
                        <div
                          class="flex items-center p-4 mt-2 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                          role="alert">
                          <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                              d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                          </svg>
                          <span class="sr-only">Info</span>
                          <div>
                            A new verification link has been sent to your email address.
                          </div>
                        </div>
                      @endif
                    @endif
                  </div>

                  <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                      Name</label>

                    <input type="text" name="name"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="Your name" value="{{ old('name', $user->name) }}" required />
                  </div>

                  <div>
                    <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                      Birthday</label>
                    <div class="relative w-full">
                      <div class="absolute inset-y-0 end-2.5 flex items-center ps-3 pointer-events-none">
                        <i class="fa-duotone fa-solid fa-calendar-days text-red-500"></i>
                      </div>
                      <input datepicker id="default-datepicker" type="text" name="birthday"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Select date" value="{{ old('birthday', $user->birthday) }}">
                    </div>
                  </div>

                  <div>
                    <label for="gender"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                    <select id="gender" name="gender"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                      @php
                        $oldGender = old('gender', $user->gender);
                      @endphp
                      <option value="" disabled {{ !$oldGender ? 'selected' : '' }}>Select gender</option>
                      <option value="male" {{ $oldGender === 'male' ? 'selected' : '' }}>Male</option>
                      <option value="female" {{ $oldGender === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                  </div>

                  <div class="flex justify-start md:justify-end w-full">
                    <button type="submit"
                      class="w-full md:w-24 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
                      Save
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <div id="profile-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0">
    <div class="relative w-full max-w-md h-full md:h-auto">
      <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
          <h3 class="text-base font-semibold text-gray-900 dark:text-white">
            Change Profile Picture
          </h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="profile-modal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form action="{{ route('profile.store') }}" method="POST"
          class="h-[calc(100vh-96px)] md:h-auto md:max-h-[70vh] overflow-y-auto">
          @csrf
          <div class="mb-4">
            <input type="file" class="filepond image" name="image" required>
          </div>
          <button type="submit"
            class="w-full md:w-24 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
            Save
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    FilePond.create(
      document.querySelector('.image'), {
        server: {
          load: (source, load, error, progress, abort, headers) => {
            fetch(source)
              .then(response => response.blob())
              .then(load)
              .catch(error);
          },
          process: "/upload-image",
          revert: "/cancel-image",
          remove: (source, load, error) => {
            fetch('/profile/remove-image', {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': CSRF_TOKEN,
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  source: source
                })
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  load();
                } else {
                  error('An error occurred while removing the file.');
                }
              })
              .catch(err => {
                error(err.message);
              });
          },
          headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
          },
        },
        allowReorder: true,
        allowFileSizeValidation: true,
        allowFileTypeValidation: true,
        maxFileSize: '2MB',
        labelMaxFileSize: 'Maximum file size is {filesize}',
        acceptedFileTypes: ['image/*'],
        labelFileTypeNotAllowed: 'File of invalid type. Please upload PNG, JPG, or JPEG files only.',
        files: [
          @if (Auth::user()->image)
            {
              source: "{{ asset('storage/image-filepond/' . Auth::user()->image) }}",
              options: {
                type: 'local'
              }
            },
          @endif
        ],
      }
    );
  </script>
@endpush
