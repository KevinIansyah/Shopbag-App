@extends('dashboard.layouts.main')

@section('main')
  <main class="lg:ml-64 min-h-screen px-4 md:px-8 lg:px-10 pt-14 pb-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 py-10">
      <div>
        <h2 class="text-2xl font-bold mb-1 md:mb-0">Product Data</h2>
        <p class="text-sm font-normal">Manage your product data here!</p>
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
              <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Product</p>
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
              <a href="{{ route('dashboard.product.create') }}"
                class="flex items-center justify-center text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 transition-all duration-200">
                <i class="fa-regular fa-plus text-xs mr-2"></i>
                Add Product
              </a>
            </div>
            <div class="overflow-x-auto">
              <table id="product-table" class="table-custom w-full text-sm text-left text-black">
                <thead class="text-sm text-white text-bold bg-red-500 rounded">
                  <tr>
                    <th dir="ltr" scope="col" class="px-2 py-2 text-white rounded-s-lg">No</th>
                    <th scope="col" class="px-2 py-2 text-white">Name</th>
                    <th scope="col" class="px-2 py-2 text-white">Price</th>
                    <th scope="col" class="px-2 py-2 text-white">Category</th>
                    <th scope="col" class="px-2 py-2 text-white">Stock</th>
                    <th scope="col" class="px-2 py-2 text-white">Weight</th>
                    <th dir="rtl" scope="col" class="px-2 py-2 text-white rounded-s-lg">Action</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- @foreach ($products as $index => $item)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td class="capitalize">
                        {{ $item->name }}</td>
                      <td>{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                      <td>
                        <div class="flex flex-row flex-wrap gap-2">
                          @foreach ($item->categories as $category)
                            <span
                              class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                          @endforeach
                        </div>
                      </td>
                      <td>
                        <div class="flex flex-row flex-wrap gap-2">
                          @foreach ($item->stocks as $stock)
                            <span
                              class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $stock->size->name }}
                              : {{ $stock->quantity }}</span>
                          @endforeach
                        </div>
                      </td>
                      <td>{{ $item->weight }} Gram</td>
                      <td>
                        <div class="flex gap-2">
                          <a href="{{ route('dashboard.product.edit', ['product' => $item->id]) }}"
                            class="w-8 h-8 text-white bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                            <i class="fa-sharp fa-solid fa-pen"></i>
                          </a>
                          <button type="button" onclick="destroyProduct({{ $item->id }})"
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
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#product-table').DataTable({
      fixedHeader: true,
      pageLength: 25,
      lengthChange: true,
      autoWidth: false,
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: {
        url: "/dashboard/product/data",
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
          data: 'price',
          name: 'price'
        },
        {
          data: 'category',
          name: 'category'
        },
        {
          data: 'stock',
          name: 'stock'
        },
        {
          data: 'weight',
          name: 'weight'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    function destroyProduct(id) {
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
                    $('#product-table').DataTable().ajax.reload();
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
  </script>
@endpush
