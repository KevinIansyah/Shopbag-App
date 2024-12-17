<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\SendNotificationHelpers;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    public function index()
    {
        return view('dashboard.sale.index');
    }

    public function data()
    {
        $orders = Order::with(['orderItems.product', 'orderItems.stock.size', 'user'])->orderBy('created_at', 'desc')->get();

        return DataTables::of($orders)
            ->addIndexColumn()
            ->addColumn('order_item', function ($row) {
                $orderItemsHtml = '<span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">' . $row->created_at . '</span>';
                $orderItemsHtml .= '<div class="flex flex-row flex-wrap gap-2 mt-2">';
                foreach ($row->orderItems as $orderItem) {
                    $orderItemsHtml .= '<span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">' . $orderItem->product->name . ' | Ukuran ' . $orderItem->stock->size->name . ' | ' . $orderItem->quantity . ' pcs</span>';
                }
                $orderItemsHtml .= '</div>';
                return $orderItemsHtml;
            })
            ->addColumn('price', function ($row) {
                return 'Rp ' . number_format($row->total_price, 0, ',', '.');
            })
            ->addColumn('weight', function ($row) {
                $totalWeight = $row->orderItems->sum(function ($item) {
                    return $item->quantity * $item->product->weight;
                });
                return $totalWeight . ' gr';
            })
            ->addColumn('quantity', function ($row) {
                return $row->orderItems->sum('quantity');
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'pending') {
                    $status = '<span class="bg-yellow-100 text-yellow-500 text-xs font-medium px-2.5 py-0.5 rounded capitalize">' . $row->status . '</span>';
                } elseif ($row->status == 'paid') {
                    $status = '<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded capitalize">' . $row->status . '</span>';
                } elseif ($row->status == 'processed') {
                    $status = '<span class="bg-orange-100 text-orange-500 text-xs font-medium px-2.5 py-0.5 rounded capitalize">' . $row->status . '</span>';
                } elseif ($row->status == 'shipped') {
                    $status = '<span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded capitalize">' . $row->status . '</span>';
                } elseif ($row->status == 'delivered') {
                    $status = '<span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded capitalize">' . $row->status . '</span>';
                } elseif ($row->status == 'completed') {
                    $status = '<span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded capitalize">' . $row->status . '</span>';
                } elseif ($row->status == 'canceled') {
                    $status = '<span class="bg-red-100 text-red-600 text-xs font-medium px-2.5 py-0.5 rounded capitalize">' . $row->status . '</span>';
                }

                return $status;
            })
            ->addColumn('user', function ($row) {
                return '<p class="capitalize">' . $row->user->name . '</p>';
            })
            ->addColumn('action', function ($row) {
                $action_button = '
                   <div class="flex gap-2">
                        <button type="button" onclick="updateSale(' . $row->id . ')" @click="open = true"
                            class="w-8 h-8 text-white bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                            <i class="fa-sharp fa-solid fa-pen"></i>
                        </button>
                    </div>
                ';

                return $action_button;
            })
            ->rawColumns(['order_item', 'price', 'quantity', 'status', 'user', 'action'])
            ->make(true);
    }

    public function show() {}

    public function edit($id)
    {
        try {
            $order = Order::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Order find successfully',
                'data' => $order,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'status' => 'required|string',
            ]);

            $orderItems = OrderItem::where('order_id', $id)->get();

            if ($validateData['status'] == 'canceled') {
                foreach ($orderItems as $item) {
                    $stock = Stock::find($item->stock_id);
                    $stock->quantity += $item->quantity;
                    $stock->save();
                }
            }

            $order = Order::findOrFail($id);
            $order->update($validateData);

            $order = Order::with(['orderItems.product', 'orderItems.stock.size', 'address'])->findOrFail($id);
            $user = User::where('id', $order->user_id)->first();

            if ($user) {
                SendNotificationHelpers::sendOrderNotification($order, $user);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'data' => $order
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
