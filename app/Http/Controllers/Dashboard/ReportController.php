<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        // Buat collection untuk bulan dari Januari sampai Desember di tahun tersebut
        $months = collect();

        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::create($year, $i, 1);
            $months->push([
                'year' => $date->year,
                'month' => $date->month,
                'label' => $date->format('M Y'), // Format singkatan bulan dan tahun
                'active_total' => 0,
                'cancelled_total' => 0,
            ]);
        }

        // Query untuk pesanan aktif
        $activeOrdersData = DB::table('orders')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as active_total')
            )
            ->where('status', '!=', 'canceled')
            ->whereYear('created_at', $year) // Filter berdasarkan tahun
            ->groupBy('year', 'month')
            ->orderBy('month', 'asc')
            ->get();

        // Query untuk pesanan yang dibatalkan
        $cancelledOrdersData = DB::table('orders')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as cancelled_total')
            )
            ->where('status', 'canceled')
            ->whereYear('created_at', $year) // Filter berdasarkan tahun
            ->groupBy('year', 'month')
            ->orderBy('month', 'asc')
            ->get();

        // Gabungkan hasil query dengan data bulan
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

        // Data pesanan
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

        // Data pesanan dibatalkan
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

        // Data tambahan
        $clients = DB::table('users')->where('access', 'user')->count(); // Ganti `clients` dengan nama tabel yang sesuai
        $products = DB::table('products')->count(); // Ganti `products` dengan nama tabel yang sesuai

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
}
