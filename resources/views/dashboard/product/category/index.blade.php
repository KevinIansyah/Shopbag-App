@extends('dashboard.layouts.main')

@section('main')
  <main class="lg:ml-64 min-h-screen px-4 md:px-8 lg:px-10 pt-14 pb-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 py-10">
      <div>
        <h2 class="text-2xl font-bold mb-1 md:mb-0">Category Data</h2>
        <p class="text-sm font-normal">Manage your category data here!</p>
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
          <li class="inline-flex items-center">
            <p class="text-sm text-gray-400">/</p>
            <a href="{{ route('dashboard.product.index') }}"
              class="ms-1 inline-flex items-center text-sm font-medium text-red-500 hover:text-red-600 md:ms-2">
              Product
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <p class="text-sm text-gray-400">/</p>
              <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Category</p>
            </div>
          </li>
        </ol>
      </nav>
    </div>

    <div class="rounded-lg mb-4">
      <section class="bg-gray-50">
        <div class="">
          <div class="bg-white relative sm:rounded-lg overflow-hidden p-4">
            <div
              class="mb-4 w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
              <button id="addCategoryModalButton" data-modal-target="addCategoryModal"
                data-modal-toggle="addCategoryModal" type="button"
                class="flex items-center justify-center text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 transition-all duration-200">
                <i class="fa-regular fa-plus text-xs mr-2"></i>
                Add Category
              </button>
            </div>
            <div class="overflow-x-auto">
              <table id="category-table" class="table-custom w-full text-sm text-left text-black">
                <thead class="text-sm text-white text-bold bg-red-500 rounded">
                  <tr>
                    <th dir="ltr" scope="col" class="px-4 py-3 text-white rounded-s-lg">No</th>
                    <th scope="col" class="px-4 py-3 text-white">Name</th>
                    <th dir="rtl" scope="col" class="px-4 py-3 text-white rounded-s-lg">Action</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- @foreach ($categories as $index => $item)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td class="capitalize">{{ $item->name }}</td>
                      <td>
                        <div class="flex gap-2">
                          <button type="button" onclick="updateCategory({{ $item->id }})" @click="open = true"
                            class="w-8 h-8 text-white bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                            <i class="fa-sharp fa-solid fa-pen"></i>
                          </button>
                          <button type="button" onclick="destroyCategory({{ $item->id }})"
                            class="w-8 h-8 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                            <i class="fa-sharp fa-solid fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach --}}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- Add modal -->
  <div id="addCategoryModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-lg md:h-auto">
      <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
        <div id="messages_add" class="relative"></div>
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
          <h3 class="text-lg font-semibold text-gray-900">
            Add category
          </h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ml-auto w-8 h-8 inline-flex items-center justify-center"
            data-modal-toggle="addCategoryModal">
            <i class="fa-regular fa-xmark text-base"></i>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form id="add_category_form" method="POST" action="{{ route('dashboard.product.category.store') }}">
          <div class="grid gap-4 mb-4">
            <div>
              <label for="name_add" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
              <input type="text" name="name" id="name_add"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5"
                placeholder="Type category name" required="">
            </div>
          </div>
          <button type="submit"
            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200">
            <span id="button_text_add_category">Save</span>
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit modal -->
  <div id="edit_category_modal" tabindex="-1" x-cloak x-show="open"
    class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div @click="open = false" class="fixed inset-0 bg-black bg-opacity-50"></div>
    <div class="relative p-4 w-full max-w-lg md:h-auto">
      <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
        <div id="messages_edit" class="relative"></div>
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
          <h3 class="text-lg font-semibold text-gray-900">
            Edit category
          </h3>
          <button type="button" @click="open = false"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ml-auto w-8 h-8 inline-flex items-center justify-center"
            data-modal-toggle="addCategoryModal">
            <i class="fa-regular fa-xmark text-base"></i>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form id="edit_category_form" method="POST" action="">
          @csrf
          @method('PUT')
          <div class="grid gap-4 mb-4">
            <div>
              <label for="name_edit" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
              <input type="text" name="name" id="name_edit"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5"
                placeholder="Type category name" required="">
            </div>
          </div>
          <button type="submit"
            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-200">
            <span id="button_text_edit_category">Save</span>
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#category-table').DataTable({
      fixedHeader: true,
      pageLength: 25,
      lengthChange: true,
      autoWidth: false,
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: {
        url: "/dashboard/product/category/data",
        type: 'GET',
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    $('#add_category_form').on('submit', function(event) {
      event.preventDefault();

      let form = $(this);
      let formData = form.serialize();
      $('#button_text_add_category').text('Loading...');

      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        success: function(response) {
          $('#messages_add').html(`
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
          $('#button_text_add_category').text('Save');
          $('#add_category_form')[0].reset();
          $('#category-table').DataTable().ajax.reload();
        },
        error: function(response) {
          $('#messages_add').html(`
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
          $('#button_text_add_category').text('Save');
        },
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        }
      });
    });

    function destroyCategory(id) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/dashboard/product/category/" + id,
            type: 'DELETE',
            data: {
              _token: CSRF_TOKEN
            },
            success: function(response) {
              if (response.success) {
                Swal.fire({
                  title: 'Berhasil!',
                  text: response.message,
                  icon: 'success',
                  timer: 3000,
                  timerProgressBar: true,
                }).then((result) => {
                  if (result.isConfirmed) {
                    $('#category-table').DataTable().ajax.reload();
                  }
                });
              } else {
                Swal.fire({
                  title: 'Gagal!',
                  text: response.message,
                  icon: 'error',
                  timer: 3000,
                  timerProgressBar: true,
                });
              }
            },
            error: function(response) {
              Swal.fire({
                title: 'Gagal!',
                text: response.error,
                icon: 'error',
                timer: 3000,
                timerProgressBar: true,
              });
            }
          });
        }
      });
    }

    function updateCategory(id) {
      $.ajax({
        url: "/dashboard/product/category/" + id + "/edit",
        type: 'GET',
        success: function(response) {
          if (response.success) {
            $('#edit_category_modal form').attr('action', "/dashboard/product/category/" + id);
            $('#name_edit').val(response.data.name);
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

    $('#edit_category_form').on('submit', function(event) {
      event.preventDefault();

      let form = $(this);
      let formData = form.serialize();
      $('#button_text_edit_category').text('Loading...');

      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        success: function(response) {
          $('#name_edit').val(response.data.name);
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
          $('#button_text_edit_category').text('Save');
          $('#category-table').DataTable().ajax.reload();
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
          $('#button_text_edit_category').text('Save');
        },
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        }
      });
    });
  </script>
@endpush
