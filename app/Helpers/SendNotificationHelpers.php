<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Notification;
use App\Mail\OrderMail;
use App\Notifications\OrderNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendNotificationHelpers
{
  public static function sendOrderNotification($order, $user, $sendNotification = 'user')
  {
    $orderIdFormat = strtoupper($order->midtrans_order_id);

    switch ($order->status) {
      case 'pending':
        if ($user->access == 'user') {
          $detailMail = [
            'message' => [
              'open_message' => 'Your order has been received, but we have not received payment yet. Please make a payment promptly to proceed with your order. Here are your order details:',
              'close_message' => 'Thank you for shopping at Shopbag. Make a payment soon so we can process your order. Click the link below to view your order details and make a payment.',
              'link' => config('app.url') . '/profile?p=waiting-for-payment',
            ],
            'subject' => 'Your Order is Awaiting Payment',
            'order' => $order,
            'user' => $user,
          ];

          $detailNotification = [
            'subject' => 'Your Order is Awaiting Payment',
            'message' => 'Your order (ID: ' . $orderIdFormat . ') is awaiting payment. Please make the payment soon so we can process your order. Click to view your order details.',
            'order_id' => $orderIdFormat,
            'link' => config('app.url') . '/profile?p=waiting-for-payment',
          ];
        }
        break;

      case 'paid':
        if ($user->access == 'user') {
          $pdf = Pdf::loadView('pdf.invoice', compact('order', 'user'));
          $pdfPath = 'invoices/order-' . $orderIdFormat . '.pdf';
          Storage::put('public/' . $pdfPath, $pdf->output());

          $detailMail = [
            'message' => [
              'open_message' => 'Your payment was successful and is awaiting further confirmation. Here are your order details:',
              'close_message' => 'Thank you for shopping at Shopbag. We will process your order shortly and notify you about its status.',
              'link' => config('app.url') . '/profile?p=transaction-list',
            ],
            'subject' => 'Your Payment Was Successful',
            'order' => $order,
            'user' => $user,
            'pdf' => storage_path('app/public/' . $pdfPath)
          ];

          $detailNotification = [
            'subject' => 'Your Payment Was Successful',
            'message' => 'We have successfully received your payment for order ID: ' . $orderIdFormat . '. We will process your order shortly. Click to view your order details.',
            'order_id' => $orderIdFormat,
            'link' => config('app.url') . '/profile?p=transaction-list',
          ];
        } else if ($user->access == 'admin') {
          $detailMail = [
            'message' => [
              'open_message' => 'A new order has just been received. Here are the details of the customer\'s order:',
              'close_message' => 'Please process the order promptly or contact the customer for further information.',
              'link' => config('app.url') . '/dashboard/sale',
            ],
            'subject' => 'A New Order Has Been Received',
            'order' => $order,
            'user' => $user,
          ];

          $detailNotification = [
            'subject' => 'A New Order Has Been Received',
            'message' => 'A new order (ID: ' . $orderIdFormat . ') has been received. Click to view the order details and start processing.',
            'order_id' => $orderIdFormat,
            'link' => config('app.url') . '/dashboard/sale',
          ];
        }

        Mail::to($user->email)->send(new OrderMail($detailMail));
        Notification::send($user, new OrderNotification($detailNotification));

        break;

      case 'processed':
        if ($user->access == 'user') {
          $detailMail = [
            'message' => [
              'open_message' => 'Your order is being processed by our team. Please wait for further confirmation regarding shipping. Here are your order details:',
              'close_message' => 'Thank you for shopping at Shopbag. We will notify you as soon as your order has been shipped. Click the link below to view your order status.',
              'link' => config('app.url') . '/profile?p=transaction-list',
            ],
            'subject' => 'Your Order is Being Processed',
            'order' => $order,
            'user' => $user,
          ];

          $detailNotification = [
            'subject' => 'Your Order is Being Processed',
            'message' => 'Your order (ID: ' . $orderIdFormat . ') is being processed by our team. We will notify you once the order has been shipped. Click to view your order details.',
            'order_id' => $orderIdFormat,
            'link' => config('app.url') . '/profile?p=transaction-list',
          ];
        }

        Mail::to($user->email)->send(new OrderMail($detailMail));
        Notification::send($user, new OrderNotification($detailNotification));

        break;

      case 'shipped':
        if ($user->access == 'user') {
          $detailMail = [
            'message' => [
              'open_message' => 'Your order has been shipped and is on its way to your address. Here are your order details:',
              'close_message' => 'Thank you for shopping at Shopbag. You can track the shipping status using the link below.',
              'link' => config('app.url') . '/profile?p=transaction-list',
            ],
            'subject' => 'Your Order Has Been Shipped',
            'order' => $order,
            'user' => $user,
          ];

          $detailNotification = [
            'subject' => 'Your Order Has Been Shipped',
            'message' => 'Your order (ID: ' . $orderIdFormat . ') has been shipped and is on its way to your address. Click to view your order details.',
            'order_id' => $orderIdFormat,
            'link' => config('app.url') . '/profile?p=transaction-list',
          ];
        }

        Mail::to($user->email)->send(new OrderMail($detailMail));
        Notification::send($user, new OrderNotification($detailNotification));

        break;

      case 'delivered':
        if ($user->access == 'user') {
          $detailMail = [
            'message' => [
              'open_message' => 'Your order has been delivered to your address. Please confirm receipt through the following link. Here are your order details:',
              'close_message' => 'Thank you for shopping at Shopbag. We hope you are satisfied with our service. Click the link below to confirm receipt of your order.',
              'link' => config('app.url') . '/profile?p=transaction-list',
            ],
            'subject' => 'Your Order Has Been Delivered',
            'order' => $order,
            'user' => $user,
          ];

          $detailNotification = [
            'subject' => 'Your Order Has Been Delivered',
            'message' => 'Your order (ID: ' . $orderIdFormat . ') has been delivered to your address. Please confirm receipt of your order. Click to view your order details.',
            'order_id' => $orderIdFormat,
            'link' => config('app.url') . '/profile?p=transaction-list',
          ];
        }

        $mailId = Mail::to($user->email)->send(new OrderMail($detailMail));
        Log::info('Queue Job ID for Mail:', ['job_id' => $mailId]);
        $notificationId = Notification::send($user, new OrderNotification($detailNotification));
        Log::info('Queue Job ID for Notification:', ['job_id' => $notificationId]);

        break;

      case 'canceled':
        if ($sendNotification == 'system') {
          $detailMail = [
            'message' => [
              'open_message' => 'Your order has been automatically canceled due to exceeding the payment limit. Below are your order details:',
              'close_message' => 'Thank you for shopping with us at Shopbag. If you have any further questions, please contact our customer service. Click the link below to view your order details.',
              'link' => config('app.url') . '/profile?p=transaction-list',
            ],
            'subject' => 'Your Order Has Been Canceled Due to Payment Time Limit',
            'order' => $order,
            'user' => $user,
          ];

          $detailNotification = [
            'subject' => 'Your Order Has Been Canceled Due to Payment Time Limit',
            'message' => 'Your order (ID: ' . $orderIdFormat . ') has been canceled due to exceeding the payment limit. Click to view your order details.',
            'order_id' => $orderIdFormat,
            'link' => config('app.url') . '/profile?p=transaction-list',
          ];
        } else {
          if ($user->access == 'user') {
            $detailMail = [
              'message' => [
                'open_message' => 'Your order has been successfully canceled. Here are your order details:',
                'close_message' => 'Thank you for shopping at Shopbag. If you have further questions, please contact our customer service. Click the link below to view your order details.',
                'link' => config('app.url') . '/profile?p=transaction-list',
              ],
              'subject' => 'Your Order Has Been Canceled',
              'order' => $order,
              'user' => $user,
            ];

            $detailNotification = [
              'subject' => 'Your Order Has Been Canceled',
              'message' => 'Your order (ID: ' . $orderIdFormat . ') has been successfully canceled. Click to view your order details.',
              'order_id' => $orderIdFormat,
              'link' => config('app.url') . '/profile?p=transaction-list',
            ];
          }
        }

        Mail::to($user->email)->send(new OrderMail($detailMail));
        Notification::send($user, new OrderNotification($detailNotification));

        break;

      default:
        break;
    }
  }
}
