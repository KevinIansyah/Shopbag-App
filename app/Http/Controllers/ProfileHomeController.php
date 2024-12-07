<?php

namespace App\Http\Controllers;

use App\Helpers\FilepondHelpers;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileHomeController extends Controller
{
    public function index(Request $request)
    {
        FilepondHelpers::removeSessionMultiple();
        
        $section = $request->query('p', 'profile');

        switch ($section) {
            case 'shipping-address':
                $address = Address::where('user_id', Auth::id())->get();

                return view('profile.shipping-address', compact('address'));
                break;

            case 'set-password':
                return view('profile.set-password');
                break;

            case 'deactive-account':
                return view('profile.deactive-account');
                break;

            case 'waiting-for-payment':
                $orders = Order::with(['orderItems.product.images', 'orderItems.stock.size'])->where('user_id', Auth::id())->where('status', 'pending')->orderBy('created_at', 'desc')->get();

                return view('profile.waiting-for-payment', compact('orders'));
                break;

            case 'transaction-list':
                $orders = Order::with(['orderItems.product.images', 'orderItems.stock.size', 'address'])->where('user_id', Auth::id())->whereNotIn('status', ['pending', 'canceled'])->orderBy('created_at', 'desc')->get();

                return view('profile.transaction-list', compact('orders'));
                break;

            default:
                return view('profile.index', [
                    'user' => $request->user(),
                ]);
                break;
        }
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.index')->with('success', 'Profile successfully updated!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}


// Shipping address
// $response = Http::withHeaders([
//     'key' => '360a5f29619bc971359e639ddc86ae40' // API Key RajaOngkir
// ])->get('https://api.rajaongkir.com/starter/province');

// if ($response->successful()) {
//     $provinces = $response->json()['rajaongkir']['results'];
// } else {
//     $provinces = [];
// }
