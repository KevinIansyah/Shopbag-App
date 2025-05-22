@extends('dashboard.layouts.main')

@section('main')
  <main class="lg:ml-64 min-h-screen px-4 md:px-8 lg:px-10 pt-14 pb-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 py-10">
      <div>
        <h2 class="text-2xl font-bold mb-1 md:mb-0">Report Data</h2>
        <p class="text-sm font-normal">Manage your report data here!</p>
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
              <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Report</p>
            </div>
          </li>
        </ol>
      </nav>
    </div>

    {{-- <form method="GET" action="{{ route('dashboard.report.index') }}">
      <label for="year">Pilih Tahun:</label>
      <select name="year" id="year">
        @for ($i = now()->year; $i >= 2022; $i--)
          <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
      </select>
      <button type="submit">Filter</button>
    </form> --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
      <div class="border-2 rounded-lg p-4 h-auto border-blue-500 bg-blue-500/40">
        <p class="text-sm text-white">Today's Orders</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $todaysOrders }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-cyan-500 bg-cyan-500/40">
        <p class="text-sm text-white">Month's Orders</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $monthlyOrders }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-sky-500 bg-sky-500/40">
        <p class="text-sm text-white">{{ $year }}'s Orders</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $yearlyOrders }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-indigo-500 bg-indigo-500/40">
        <p class="text-sm text-white">All Orders</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $totalOrders }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-violet-500 bg-violet-500/40">
        <p class="text-sm text-white">Today's Cancelled Orders</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $todaysCancelled }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-purple-500 bg-purple-500/40">
        <p class="text-sm text-white">Month's Cancelled Orders</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $monthlyCancelled }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-pink-500 bg-pink-500/40">
        <p class="text-sm text-white">{{ $year }}'s Cancelled Orders</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $yearlyCancelled }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-rose-500 bg-rose-500/40">
        <p class="text-sm text-white">All Cancelled Orders</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $totalCancelled }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-green-500 bg-green-500/40">
        <p class="text-sm text-white">Number of Clients</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $clients }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-yellow-500 bg-yellow-500/40">
        <p class="text-sm text-white">Number of Products</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">{{ $products }}</h1>
      </div>
      <div class="border-2 rounded-lg p-4 h-auto border-orange-500 bg-orange-500/40">
        <p class="text-sm text-white">Ratings</p>
        <h1 class="text-5xl text-white text-center font-medium mt-2">5</h1>
      </div>
    </div>

    <div class="h-auto w-full mb-4 bg-white p-4 rounded">
      <canvas id="sales-chart"></canvas>
    </div>

    <div class="grid grid-cols-1 mb-4">
      <div class="bg-white relative sm:rounded-lg overflow-hidden p-4">
        <div class="overflow-x-auto">
          <table id="product-table" class="table-custom w-full text-sm text-left text-black">
            <thead class="text-sm text-white text-bold bg-red-500 rounded">
              <tr>
                <th dir="ltr" scope="col" class="px-2 py-2 text-white rounded-s-lg">No</th>
                <th scope="col" class="px-2 py-2 text-white">Name</th>
                <th scope="col" class="px-2 py-2 text-white">Sold</th>
                <th scope="col" class="px-2 py-2 text-white">Rating</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
      <div class="border-2 border-dashed border-gray-300 rounded-lg h-32 md:h-64"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-32 md:h-64"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-32 md:h-64"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-32 md:h-64"></div>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-48 md:h-72"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 h-48 md:h-72"></div>
    </div> --}}
  </main>
@endsection


@push('scripts')
  <script type="module">
    
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    let ordersData = @json($ordersData);

    let orderLabels = ordersData.map(function(item) {
      return item.label;
    });

    let activeOrderTotals = ordersData.map(function(item) {
      return item.active_total;
    });

    let cancelledOrderTotals = ordersData.map(function(item) {
      return item.cancelled_total;
    });

    if ($("#sales-chart").length) {
      let SalesChartCanvas = $("#sales-chart").get(0).getContext("2d");
      let SalesChart = new Chart(SalesChartCanvas, {
        type: 'bar',
        data: {
          labels: orderLabels,
          datasets: [{
              label: 'Active Orders',
              data: activeOrderTotals,
              backgroundColor: 'rgba(59, 130, 246, 0.4)',
              borderRadius: {
                topLeft: 5,
                topRight: 5,
              },
              borderColor: 'rgb(59, 130, 246)',
              borderWidth: 1,
            },
            {
              label: 'Cancelled Orders',
              data: cancelledOrderTotals,
              backgroundColor: 'rgba(239, 68, 68, 0.4)',
              borderRadius: {
                topLeft: 5,
                topRight: 5,
              },
              borderColor: 'rgb(239, 68, 68)',
              borderWidth: 1,
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 20,
              bottom: 0
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: {
                display: true,
                drawBorder: false,
                color: "#F2F2F2"
              },
              ticks: {
                callback: function(value) {
                  return value + ' items';
                },
                font: {
                  color: "#6C7383"
                },
                stepSize: 1
              }
            },
            x: {
              grid: {
                display: false
              },
              ticks: {
                font: {
                  color: "#6C7383"
                }
              }
            }
          },
          plugins: {
            legend: {
              display: true
            }
          },
          elements: {
            point: {
              radius: 0
            }
          }
        },
      });
    }

    $('#product-table').DataTable({
      fixedHeader: true,
      pageLength: 25,
      lengthChange: true,
      autoWidth: false,
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: {
        url: "/dashboard/report/data",
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
          data: 'sold',
          name: 'sold'
        },
        {
          data: 'rating',
          name: 'rating'
        },
      ]
    });
  </script>
@endpush
