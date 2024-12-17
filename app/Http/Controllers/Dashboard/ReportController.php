<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $months = collect();

        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::create($year, $i, 1);
            $months->push([
                'year' => $date->year,
                'month' => $date->month,
                'label' => $date->format('M Y'),
                'active_total' => 0,
                'cancelled_total' => 0,
            ]);
        }

        $activeOrdersData = DB::table('orders')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as active_total')
            )
            ->where('status', '!=', 'canceled')
            ->whereYear('created_at', $year)
            ->groupBy('year', 'month')
            ->orderBy('month', 'asc')
            ->get();

        $cancelledOrdersData = DB::table('orders')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as cancelled_total')
            )
            ->where('status', 'canceled')
            ->whereYear('created_at', $year)
            ->groupBy('year', 'month')
            ->orderBy('month', 'asc')
            ->get();

        $ordersData = $months->map(function ($month) use ($activeOrdersData, $cancelledOrdersData) {
            $foundActive = $activeOrdersData->first(function ($item) use ($month) {
                return $item->year == $month['year'] && $item->month == $month['month'];
            });

            $foundCancelled = $cancelledOrdersData->first(function ($item) use ($month) {
                return $item->year == $month['year'] && $item->month == $month['month'];
            });

            return [
                'year' => $month['year'],
                'month' => $month['month'],
                'label' => $month['label'],
                'active_total' => $foundActive ? $foundActive->active_total : 0,
                'cancelled_total' => $foundCancelled ? $foundCancelled->cancelled_total : 0,
            ];
        });

        $todaysOrders = DB::table('orders')
            ->where('status', '!=', 'canceled')
            ->whereDate('created_at', Carbon::today())
            ->count();

        $monthlyOrders = DB::table('orders')
            ->where('status', '!=', 'canceled')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $yearlyOrders = DB::table('orders')
            ->where('status', '!=', 'canceled')
            ->whereYear('created_at', $year)
            ->count();

        $totalOrders = DB::table('orders')->where('status', '!=', 'canceled')->count();

        $todaysCancelled = DB::table('orders')
            ->where('status', 'canceled')
            ->whereDate('created_at', Carbon::today())
            ->count();

        $monthlyCancelled = DB::table('orders')
            ->where('status', 'canceled')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $yearlyCancelled = DB::table('orders')
            ->where('status', 'canceled')
            ->whereYear('created_at', $year)
            ->count();

        $totalCancelled = DB::table('orders')
            ->where('status', 'canceled')
            ->count();

        $clients = DB::table('users')->where('access', 'user')->count();
        $products = DB::table('products')->count();

        return view('dashboard.report.index', compact(
            'ordersData',
            'year',
            'todaysOrders',
            'monthlyOrders',
            'yearlyOrders',
            'totalOrders',
            'todaysCancelled',
            'monthlyCancelled',
            'yearlyCancelled',
            'totalCancelled',
            'clients',
            'products'
        ));
    }

    public function data()
    {
        $products = Product::orderBy('sold', 'desc')->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                $name = $row->name ? '<p class="capitalize">' . $row->name . '</p>' : '-';
                return $name;
            })
            ->addColumn('sold', function ($row) {
                return $row->sold;
            })
            ->addColumn('rating', function ($row) {
                return $row->avg_rating;
            })
            ->rawColumns(['name'])
            ->make(true);
    }
}
