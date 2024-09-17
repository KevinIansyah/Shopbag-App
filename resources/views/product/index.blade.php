@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh]">
      <div class="lg:flex lg:gap-4">
        {{-- @include('profile.partials.aside') --}}

        <div class="w-full h-auto bg-white dark:bg-gray-800">
          <div class="lg:rounded-lg">
            {{-- <div class="relative pb-6">
              <div class="flex items-center justify-between">
                <div>
                  <h2 class="text-lg font-semibold">Profile</h2>
                  <p class="text-sm font-normal">Manage your profile here!</p>
                </div>
                <button data-drawer-target="profile-sidebar" data-drawer-toggle="profile-sidebar"
                  aria-controls="profile-sidebar" type="button"
                  class="w-10 h-10 inline-flex items-center justify-center bg-red-500 hover:bg-red-600  text-white rounded-lg lg:hidden focus:outline-none focus:ring-2 focus:ring-red-300">
                  <span class="sr-only">Open sidebar</span>
                  <i class="fa-sharp fa-regular fa-bars text-base"></i>
                </button>
              </div>

              @if (session('success'))
                <x-alert-success class="mt-2" :messages="session('success')" />
              @endif
            </div> --}}

            {{-- <div class="flex flex-col gap-4 lg:w-3/5">
              <div>
                <span class="text-violet-600 font-semibold">Special Sneaker</span>
                <h1 class="text-3xl font-bold">Nike Invincible 3</h1>
              </div>
              <p class="text-gray-700">
                Con un'ammortizzazione incredibile per sostenerti in tutti i tuoi chilometri, Invincible 3 offre un
                livello di comfort elevatissimo sotto il piede per aiutarti a dare il massimo oggi, domani e oltre.
                Questo modello incredibilmente elastico e sostenitivo, è pensato per dare il massimo lungo il tuo
                percorso preferito e fare ritorno a casa carico di energia, in attesa della prossima corsa.
              </p>
              <h6 class="text-2xl font-semibold">$ 199.00</h6>
              <div class="flex flex-row items-center gap-12">
                <div class="flex flex-row items-center">
                  <button class="bg-gray-200 py-2 px-5 rounded-lg text-violet-800 text-3xl"
                    @click="amount = Math.max(amount - 1, 1)">-</button>
                  <span class="py-4 px-6 rounded-lg" x-text="amount"></span>
                  <button class="bg-gray-200 py-2 px-4 rounded-lg text-violet-800 text-3xl"
                    @click="amount = amount + 1">+</button>
                </div>
                <button class="bg-violet-800 text-white font-semibold py-3 px-16 rounded-xl h-full">Add to Cart</button>
              </div>
            </div> --}}

            <div x-data="productPage()" class="flex flex-col lg:flex-row gap-16">
              <!-- Image Gallery -->
              <div class="lg:w-1/3">
                <div class="flex flex-col gap-6">
                  <div class="relative flex-shrink-0">
                    <a :href="activeImg" data-fancybox="gallery">
                      <img :src="activeImg" alt=""
                        class="w-full h-full aspect-square object-cover rounded-xl" />
                    </a>

                    <button @click="prevImage"
                      class="absolute top-1/2 left-5 transform -translate-y-1/2 bg-gray-400/50 text-white h-12 w-12 flex items-center justify-center rounded-full">
                      <i class="fa-sharp fa-regular fa-chevron-left"></i>
                    </button>
                    <button @click="nextImage"
                      class="absolute top-1/2 right-5 transform -translate-y-1/2 bg-gray-400/50 text-white h-12 w-12 flex items-center justify-center rounded-full">
                      <i class="fa-sharp fa-regular fa-chevron-right"></i>
                    </button>
                  </div>
                  <div class="flex flex-row gap-4 h-auto overflow-x-auto p-1">
                    <img :src="images.img1" alt=""
                      :class="activeImg == images.img1 ? 'ring-red-500 hover:ring-red-600' : 'ring-gray-200 hover:ring-gray-300'"
                      class="w-24 h-24 ring-2 rounded-md cursor-pointer aspect-square object-cover"
                      @click="setActiveImage(images.img1)" />
                    <img :src="images.img2" alt=""
                      :class="activeImg == images.img2 ? 'ring-red-500 hover:ring-red-600' : 'ring-gray-200 hover:ring-gray-300'"
                      class="w-24 h-24 ring-2 rounded-md cursor-pointer aspect-square object-cover"
                      @click="setActiveImage(images.img2)" />
                    <img :src="images.img3" alt=""
                      :class="activeImg == images.img3 ? 'ring-red-500 hover:ring-red-600' : 'ring-gray-200 hover:ring-gray-300'"
                      class="w-24 h-24 ring-2 rounded-md cursor-pointer aspect-square object-cover"
                      @click="setActiveImage(images.img3)" />
                  </div>

                  <div id="fancy_box" class="hidden">
                    <template x-if="activeImg !== images.img1">
                      <a :href="images.img1" data-fancybox="gallery">
                        <img :src="images.img1" alt=""
                          class="hidden w-full h-full aspect-square object-cover rounded-xl" />
                      </a>
                    </template>
                    <template x-if="activeImg !== images.img2">
                      <a :href="images.img2" data-fancybox="gallery">
                        <img :src="images.img2" alt=""
                          class="hidden w-full h-full aspect-square object-cover rounded-xl" />
                      </a>
                    </template>
                    <template x-if="activeImg !== images.img3">
                      <a :href="images.img3" data-fancybox="gallery">
                        <img :src="images.img3" alt=""
                          class="hidden w-full h-full aspect-square object-cover rounded-xl" />
                      </a>
                    </template>
                  </div>
                </div>
              </div>

              <!-- About -->
              <div class="lg:w-2/3">
                <div class="flex gap-4">
                  <div class="lg:w-1/2">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                      Apple iMac 24" All-In-One Computer, Apple M1, 8GB RAM, 256GB SSD,
                      Mac OS, Pink
                    </h1>
                    <div class="mt-4">
                      <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                        IDR 200.000,00
                      </p>

                      <div class="flex items-center gap-2 mt-2 sm:mt-0">
                        <div class="flex items-center gap-1">
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                          <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                        </div>
                        <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                          (5.0)
                        </p>
                        <a href="#"
                          class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
                          345 Reviews
                        </a>
                      </div>
                    </div>
                  </div>

                  {{-- <div class="bg-gray-200 w-px h-auto mx-3"></div> --}}

                  <div class=" lg:w-1/2">
                    <div class="space-y-4">
                      <h6 class="text-base font-semibold text-gray-900 dark:text-white">Sizes</h6>

                      <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                        <div
                          class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                          <div class="flex items-start">
                            <div class="flex h-5 items-center">
                              <input id="dhl" aria-describedby="dhl-text" type="radio" name="delivery-method"
                                value=""
                                class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            </div>

                            <div class="ms-2 text-sm">
                              <p id="dhl-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">S</p>
                            </div>
                          </div>
                        </div>

                        <div
                          class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                          <div class="flex items-start">
                            <div class="flex h-5 items-center">
                              <input id="dhl" aria-describedby="dhl-text" type="radio" name="delivery-method"
                                value=""
                                class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            </div>

                            <div class="ms-2 text-sm">
                              <p id="dhl-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">M</p>
                            </div>
                          </div>
                        </div>

                        <div
                          class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                          <div class="flex items-start">
                            <div class="flex h-5 items-center">
                              <input id="fedex" aria-describedby="fedex-text" type="radio"
                                name="delivery-method" value=""
                                class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            </div>

                            <div class="ms-2 text-sm">
                              <p id="fedex-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">L</p>
                            </div>
                          </div>
                        </div>

                        <div
                          class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                          <div class="flex items-start">
                            <div class="flex h-5 items-center">
                              <input id="express" aria-describedby="express-text" type="radio"
                                name="delivery-method" value=""
                                class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            </div>

                            <div class="ms-2 text-sm">
                              <p id="express-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">XL
                              </p>
                            </div>
                          </div>
                        </div>

                        <div
                          class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                          <div class="flex items-start">
                            <div class="flex h-5 items-center">
                              <input id="express" aria-describedby="express-text" type="radio"
                                name="delivery-method" value=""
                                class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            </div>

                            <div class="ms-2 text-sm">
                              <p id="express-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">XXL
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">


                      <a href="#" title=""
                        class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        role="button">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                          width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                        </svg>
                        Add to favorites
                      </a>

                      <a href="#" title=""
                        class="text-white mt-4 sm:mt-0 bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none flex items-center justify-center"
                        role="button">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                          width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>

                        Add to cart
                      </a>
                    </div>
                  </div>


                </div>

                <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                <p class="mb-6 text-gray-500 dark:text-gray-400">
                  Studio quality three mic array for crystal clear calls and voice
                  recordings. Six-speaker sound system for a remarkably robust and
                  high-quality audio experience. Up to 256GB of ultrafast SSD storage.
                </p>

                <p class="text-gray-500 dark:text-gray-400">
                  Two Thunderbolt USB 4 ports and up to two USB 3 ports. Ultrafast
                  Wi-Fi 6 and Bluetooth 5.0 wireless. Color matched Magic Mouse with
                  Magic Keyboard or Magic Keyboard with Touch ID.
                </p>
              </div>
            </div>

            <div class="grid grid-cols-12 gap-8">
              <div class="col-span-12 md:col-span-8">
                {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                  @csrf
                </form>

                <form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-3">
                  @csrf
                  @method('PUT')
                  <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                      Nomor Telepon</label>
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
                          @foreach ($errors->get('name') as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                          @foreach ($errors->get('email') as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  @endif
                </form> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

@push('scripts')
  <script>
    Fancybox.bind('[data-fancybox="gallery"]', {

    });

    function productPage() {
      const imageArray = [
        "{{ asset('images/product/man-1/man-1-1.jpeg') }}",
        "{{ asset('images/product/man-1/man-1-2.jpeg') }}",
        "{{ asset('images/product/man-1/man-1-3.jpeg') }}",
      ];

      return {
        images: imageArray.reduce((acc, img, index) => {
          acc[`img${index + 1}`] = img;
          return acc;
        }, {}),
        activeImg: imageArray[0],
        amount: 1,
        currentIndex: 0,
        setActiveImage(img) {
          this.activeImg = img;
          this.currentIndex = imageArray.indexOf(img);
        },
        prevImage() {
          this.currentIndex = (this.currentIndex - 1 + imageArray.length) % imageArray.length;
          this.activeImg = imageArray[this.currentIndex];
        },
        nextImage() {
          this.currentIndex = (this.currentIndex + 1) % imageArray.length;
          this.activeImg = imageArray[this.currentIndex];
        }
      }
    }
  </script>
  {{-- <script>
    function productPage() {
      return {
        images: {
          img1: "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,b_rgb:f5f5f5/3396ee3c-08cc-4ada-baa9-655af12e3120/scarpa-da-running-su-strada-invincible-3-xk5gLh.png",
          img2: "https://static.nike.com/a/images/f_auto,b_rgb:f5f5f5,w_440/e44d151a-e27a-4f7b-8650-68bc2e8cd37e/scarpa-da-running-su-strada-invincible-3-xk5gLh.png",
          img3: "https://static.nike.com/a/images/f_auto,b_rgb:f5f5f5,w_440/44fc74b6-0553-4eef-a0cc-db4f815c9450/scarpa-da-running-su-strada-invincible-3-xk5gLh.png",
          img4: "https://static.nike.com/a/images/f_auto,b_rgb:f5f5f5,w_440/d3eb254d-0901-4158-956a-4610180545e5/scarpa-da-running-su-strada-invincible-3-xk5gLh.png"
        },
        activeImg: "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,b_rgb:f5f5f5/3396ee3c-08cc-4ada-baa9-655af12e3120/scarpa-da-running-su-strada-invincible-3-xk5gLh.png",
        amount: 1,
        setActiveImage(img) {
          this.activeImg = img;
        }
      }
    }
  </script> --}}
@endpush


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
