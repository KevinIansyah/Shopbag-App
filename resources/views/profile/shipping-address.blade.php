@extends('layouts.main')

@section('main')
  <main>
    <div tabindex="-1" class="mx-auto max-w-7xl pt-28 pb-20 px-4 md:px-6 lg:px-8 min-h-[100vh]">
      <div class="lg:flex lg:gap-4">
        @include('profile.partials.aside')

        <div class="w-full h-auto bg-white dark:bg-gray-800">
          <div class="lg:rounded-lg lg:p-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 pb-6">
              <div class="flex items-center justify-between w-[100%]">
                <div>
                  <h2 class="text-xl font-semibold">Shipping Address</h2>
                  <p class="text-sm font-normal">Manage your shipping address here!</p>
                </div>
                <button data-drawer-target="profile-sidebar" data-drawer-toggle="profile-sidebar"
                  aria-controls="profile-sidebar" type="button"
                  class="w-10 h-10 inline-flex items-center justify-center bg-red-500 hover:bg-red-600  text-white rounded-lg lg:hidden focus:outline-none focus:ring-2 focus:ring-red-300">
                  <span class="sr-only">Open sidebar</span>
                  <i class="fa-sharp fa-regular fa-bars text-base"></i>
                </button>
              </div>
            </div>

            <div>
              <button id="shippingAddresButton" data-modal-target="shippingAddres" data-modal-toggle="shippingAddres"
                type="button"
                class="w-full border border-dashed border-red-500 hover:border-red-600 text-red-500 font-bold rounded-lg text-sm px-5 py-3 transition-all duration-200">
                Add New Address
              </button>

              <div class="space-y-4 mt-4">
                @if ($address->isEmpty())
                  <div class="flex flex-col items-center justify-center">
                    <img class="w-full md:w-[50%]" src="{{ asset('images/no-data.jpg') }}" alt="No data available">
                    <h6 class="text-lg font-semibold text-black">Address is still empty!</h6>
                    <p class="text-sm font-normal text-black">You haven't added a address to your account</p>
                  </div>
                @else
                  @foreach ($address as $item)
                    <div
                      class="p-4 border border-gray-200 rounded flex flex-col md:flex-row items:start md:items-center gap-4">
                      <div class="w-full">
                        <p class="text-sm font-bold mb-2">{{ $item->recipient_name }}
                          @if ($item->is_primary == true)
                            <span
                              class="ml-2 bg-red-100 text-red-600 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-500">
                              Primary Address
                            </span>
                          @endif
                        </p>
                        <p class="text-sm font-normal mb-1">{{ $item->recipient_contact }}</p>
                        <p class="text-sm font-normal mb-1">{{ $item->city }}, {{ $item->province }}</p>
                        <p class="text-sm font-normal mb-1">{{ $item->address }}</p>
                        <p class="text-sm font-normal">Notes: {{ $item->notes }}</p>
                      </div>
                      <div class="flex justify-start md:justify-end gap-2 w-auto">
                        <button type="button"
                          class="w-8 h-8 text-white bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                          <i class="fa-sharp fa-solid fa-pen"></i>
                        </button>
                        <button type="button"
                          class="w-8 h-8 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                          <i class="fa-sharp fa-solid fa-trash"></i>
                        </button>
                      </div>
                    </div>
                  @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Main modal -->
  <div id="shippingAddres" tabindex="-1" aria-hidden="true"
    class="hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0">
    <div class="relative w-full max-w-2xl h-full md:h-auto">
      <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
          <h3 class="text-base font-semibold text-gray-900 dark:text-white">
            Add Shipping Address
          </h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="shippingAddres">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form action="{{ route('address.store') }}" method="POST"
          class="h-[calc(100vh-96px)] md:h-auto md:max-h-[70vh] overflow-y-auto">
          @csrf
          <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div>
              <label for="recipient_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recipient
                Name</label>
              <input type="text" name="recipient_name" id="recipient_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="Recipent name" required>
            </div>
            <div>
              <label for="recipient_contact"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recipient Contact</label>
              <input type="text" name="recipient_contact" id="recipient_contact"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="08xxxxxxxxxx" required>
            </div>
            <div>
              <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
              <input type="text" name="province" id="province"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="Province name" required>
            </div>
            <div>
              <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
              <input type="text" name="city" id="city"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="City name" required>
            </div>
            <div class="sm:col-span-2">
              <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                Address</label>
              <textarea name="address" id="address" rows="4"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="Street Name, Building, House Number"></textarea>
            </div>
            <div class="sm:col-span-2">
              <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes For
                Courier</label>
              <input type="text" name="notes" id="notes"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="Other Details (e.g., Block/Unit No., Landmark)" required>
            </div>
            <div class="sm-col-span-2">
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input id="is_primary" name="is_primary" type="checkbox"
                    class="w-4 h-4 text-red-500 bg-gray-100 border-gray-300 rounded focus:ring-red-300 focus:ring-2" />
                </div>
                <label for="is_primary" class="ms-2 text-sm font-medium text-gray-900">Make the primary address</label>
              </div>
            </div>
          </div>
          <button type="submit"
            class="w-full md:w-24 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
            Save
          </button>
        </form>
      </div>
    </div>
  </div>

  {{-- <div>
    <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
    <select id="province" name="province"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
      required>
      <option selected disabled>Select province</option>
      @if (!empty($provinces))
        @foreach ($provinces as $item)
          <option value="{{ $item['province_id'] }}">{{ $item['province'] }}</option>
        @endforeach
      @else
        <option disabled>No provinces available</option>
      @endif
    </select>
  </div>
  <div>
    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
    <select id="city" name="city"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
      required disabled>
      <option selected disabled>Select city</option>
    </select>
  </div> --}}
@endsection

@push('scripts')
  {{-- <script>
    $(document).ready(function() {
      $('#province').change(function() {
        var provinceId = $(this).val();
        if (provinceId) {
          $.ajax({
            url: 'profile/api/cities',
            type: 'GET',
            data: {
              province: provinceId
            },
            success: function(response) {
              if (response.rajaongkir && response.rajaongkir.results) {
                console.log(response);
                $('#city').empty();
                $('#city').append('<option selected disabled>Select city</option>');

                $.each(response.rajaongkir.results, function(index, city) {
                  $('#city').append('<option value="' + city.city_id + '">' + city.type + ' ' + city
                    .city_name +
                    '</option>');
                });
                $('#city').prop('disabled', false);
              } else {
                $('#city').empty();
                $('#city').append('<option disabled>No cities available</option>');
                $('#city').prop('disabled', true);
              }
            },
            error: function(xhr) {
              // Handle error
              Swal.fire({
                title: 'Error!',
                text: xhr.responseJSON.message || 'Failed to fetch cities.',
                icon: 'error',
              });
            }
          });
        } else {
          $('#city').empty();
          $('#city').append('<option selected disabled>Select city</option>');
        }
      });
    });
  </script> --}}
@endpush
