@extends('dashboard.layouts.main')

@section('main')
  <main class="lg:ml-64 min-h-screen px-4 md:px-8 lg:px-10 pt-14 pb-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 py-10">
      <div>
        <h2 class="text-2xl font-bold mb-1 md:mb-0">Admin Data</h2>
        <p class="text-sm font-normal">Manage your admin data here!</p>
      </div>
      <nav class="flex text-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-medium text-red-500 hover:text-red-600">
              <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                  d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
              </svg>
              Dashboard
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <i class="fa-sharp fa-solid fa-chevron-right text-xs text-gray-400"></i>
              <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Admin</p>
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
              <table id="admin-table" class="table-custom w-full text-sm text-left text-black">
                <thead class="text-sm text-white text-bold bg-red-500 rounded">
                  <tr>
                    <th dir="ltr" scope="col" class="px-4 py-3 text-white rounded-s-lg">No</th>
                    <th scope="col" class="px-4 py-3 text-white">Name</th>
                    <th scope="col" class="px-4 py-3 text-white">Email</th>
                    <th scope="col" class="px-4 py-3 text-white">Gender</th>
                    <th scope="col" class="px-4 py-3 text-white">Birthday</th>
                    <th dir="rtl" scope="col" class="px-4 py-3 text-white rounded-s-lg">Action</th>
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
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('#admin-table').DataTable({
        fixedHeader: true,
        pageLength: 25,
        lengthChange: true,
        autoWidth: false,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
          url: "/dashboard/user/admin/data",
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
            data: 'email',
            name: 'email'
          },
          {
            data: 'gender',
            name: 'gender'
          },
          {
            data: 'birthday',
            name: 'birthday'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          },
        ]
      });
    });
  </script>
@endpush