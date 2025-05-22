@extends('dashboard.layouts.main')

@section('main')
  <main class="lg:ml-64 min-h-screen px-4 md:px-8 lg:px-10 pt-14 pb-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 py-10">
      <div>
        <h2 class="text-2xl font-bold mb-1 md:mb-0">Sale Data</h2>
        <p class="text-sm font-normal">Manage your sale data here!</p>
      </div>

      <nav class="flex text-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a href="{{ route('dashboard.index') }}"
              class="inline-flex items-center text-sm font-medium text-red-500 hover:text-red-600">
              <i class="fa-solid fa-house text-xs mr-2"></i>
              Dashboard
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <p class="text-sm text-gray-400">/</p>
              <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Sale</p>
            </div>
          </li>
        </ol>
      </nav>
    </div>

    <div class="rounded-lg mb-4">
      <section class="bg-gray-50">
        <div class="">
          <div class="bg-white relative sm:rounded-lg overflow-hidden p-4">
            <div class="overflow-x-auto">
              {{-- biarkan tabel body kosong, sesuaikan id tabel untuk digunakan di request ajax --}}
              <table id="sale-table" class="table-custom w-full text-sm text-left text-black">
                <thead class="text-sm text-white text-bold bg-red-500 rounded">
                  <tr>
                    <th dir="ltr" scope="col" class="px-2 py-2 text-white rounded-s-lg">No</th>
                    <th scope="col" class="px-2 py-2 text-white">Order Item</th>
                    <th scope="col" class="px-2 py-2 text-white">Price</th>
                    <th scope="col" class="px-2 py-2 text-white">Weight</th>
                    <th scope="col" class="px-2 py-2 text-white">Quantity</th>
                    <th scope="col" class="px-2 py-2 text-white">Status</th>
                    <th scope="col" class="px-2 py-2 text-white">Buyer</th>
                    <th dir="rtl" scope="col" class="px-2 py-2 text-white rounded-s-lg">Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <div id="edit_sale_modal" tabindex="-1" x-cloak x-show="open"
    class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div @click="open = false" class="fixed inset-0 bg-black bg-opacity-50"></div>
    <div class="relative p-4 w-full max-w-lg md:h-auto">
      <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
        <div id="messages_edit" class="relative"></div>
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
          <h3 class="text-lg font-semibold text-gray-900">
            Edit status
          </h3>
          <button type="button" @click="open = false"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ml-auto w-8 h-8 inline-flex items-center justify-center">
            <i class="fa-regular fa-xmark text-base"></i>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form id="edit_sale_form" method="POST" action="">
          @csrf
          @method('PUT')
          <div class="grid gap-4 mb-4">
            <div>
              <label for="status_edit" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
              <select id="status_edit" name="status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5"
                required>
              </select>
            </div>
          </div>
          <button type="submit"
            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200">
            <span id="button_text_edit_sale">Save</span>
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // Ajax untuk mengirim request datatable ke backend
    // Kolom yang dipakai harus sama dengan di backend
    $('#sale-table').DataTable({
      fixedHeader: true,
      pageLength: 3,
      lengthChange: true,
      autoWidth: false,
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: {
        // Jangan lupa bikin route nya dulu di routes/web.php
        url: "/dashboard/sale/data",
        type: 'GET',
      },
      columns: [{
          data: 'DT_RowIndex',
          name: '',
          orderable: false,
          searchable: false,
          className: 'text-center',
        },
        {
          data: 'order_item',
          name: 'order_item'
        },
        {
          data: 'price',
          name: 'price'
        },
        {
          data: 'weight',
          name: 'weight'
        },
        {
          data: 'quantity',
          name: 'quantity'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          data: 'user',
          name: 'user'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    function updateSale(id) {
      $.ajax({
        url: "/dashboard/sale/" + id + "/edit",
        type: 'GET',
        success: function(response) {
          if (response.success) {
            $('#edit_sale_modal form').attr('action', "/dashboard/sale/" + id);

            $('#status_edit').empty();
            const statuses = ['pending', 'paid', 'processed', 'shipped', 'delivered', 'canceled'];
            statuses.forEach(status => {
              $('#status_edit').append(
                `<option value="${status}" ${response.data.status === status ? 'selected' : ''}>${status.charAt(0).toUpperCase() + status.slice(1)}</option>`
              );
            });
          }
        },
        error: function(response) {
          $('#messages_edit').html(`
          <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="absolute top-0 left-0 w-full flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
            role="alert">
            <i class="fa-solid fa-circle-info mr-2"></i>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">Failed!</span> ${response.message}
            </div>
          </div>
        `);
        }
      });
    }

    $('#edit_sale_form').on('submit', function(event) {
      event.preventDefault();

      let form = $(this);
      let formData = form.serialize();
      $('#button_text_edit_sale').text('Loading...');

      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        success: function(response) {
          $('#status_edit').empty();
          const statuses = ['pending', 'paid', 'processed', 'shipped', 'delivered', 'canceled'];
          statuses.forEach(status => {
            $('#status_edit').append(
              `<option value="${status}" ${response.data.status === status ? 'selected' : ''}>${status.charAt(0).toUpperCase() + status.slice(1)}</option>`
            );
          });
          $('#messages_edit').html(`
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
              class="absolute top-0 left-0 w-full flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50"
              role="alert">
              <i class="fa-solid fa-circle-info mr-2"></i>
              <span class="sr-only">Info</span>
              <div>
                <span class="font-medium">Success!</span> ${response.message}
              </div>
            </div>
          `);
          $('#button_text_edit_sale').text('Save');
          $('#sale-table').DataTable().ajax.reload();
        },
        error: function(response) {
          $('#messages_edit').html(`
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
              class="absolute top-0 left-0 w-full flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
              role="alert">
              <i class="fa-solid fa-circle-info mr-2"></i>
              <span class="sr-only">Info</span>
              <div>
                <span class="font-medium">Failed!</span> ${response.message}
              </div>
            </div>
          `);
          $('#button_text_edit_sale').text('Save');
        },
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        }
      });
    });
  </script>
@endpush
