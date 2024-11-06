@extends('dashboard.layouts.main')

@section('main')
  <main class="lg:ml-64 min-h-screen px-4 md:px-8 lg:px-10 pt-14 pb-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 py-10">
      <div>
        <h2 class="text-2xl font-bold mb-1 md:mb-0">Template Table</h2>
        <p class="text-sm font-normal">Manage your template table here!</p>
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
              <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Template Table</p>
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
              <a href="#"
                class="flex items-center justify-center text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 transition-all duration-200">
                <i class="fa-regular fa-plus text-xs mr-2"></i>
                Add
              </a>
            </div>
            <div class="overflow-x-auto">
              <table id="product_table" class="table-custom w-full text-sm text-left text-black">
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
                  <tr>
                    <td>1</td>
                    <td class="capitalize">
                      {{ $item->name }}</td>
                    <td>{{ 'Rp ' . number_format(100000, 0, ',', '.') }}</td>
                    <td>
                      <div class="flex flex-row flex-wrap gap-2">
                        <span
                          class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Man</span>
                      </div>
                    </td>
                    <td>
                      <div class="flex flex-row flex-wrap gap-2">
                        <span
                          class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">L:
                          10</span>
                      </div>
                    </td>
                    <td>100 Gram</td>
                    <td>
                      <div class="flex gap-2">
                        <button type="button"
                          class="w-8 h-8 text-white bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                          <i class="fa-sharp fa-solid fa-pen"></i>
                        </button>
                        <button type="button"
                          class="w-8 h-8 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                          <i class="fa-sharp fa-solid fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
@endsection
