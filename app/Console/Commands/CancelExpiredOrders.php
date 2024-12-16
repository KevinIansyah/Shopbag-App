<?php

namespace App\Console\Commands;

use App\Helpers\SendNotificationHelpers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CancelExpiredOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel orders that have expired payment time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredOrders = Order::where('status', 'pending')
            ->where('expired_at', '<', now())
            ->get();

        foreach ($expiredOrders as $order) {
            $order->status = 'canceled';
            $order->save();

            $orderItems = OrderItem::where('order_id', $order->id)->get();

            foreach ($orderItems as $item) {
                $stock = Stock::find($item->stock_id);
                $stock->quantity += $item->quantity;
                $stock->save();
            }

            $order = Order::with(['orderItems.product', 'orderItems.stock.size', 'address'])->findOrFail($order->id);
            $user = User::where('id', $order->user_id)->first();
            $sendNotification = 'system';

            if ($user) {
                SendNotificationHelpers::sendOrderNotification($order, $user, $sendNotification);
            }
        }

        $this->info(count($expiredOrders) . ' expired orders were canceled.');
    }
}
