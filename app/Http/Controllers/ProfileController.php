<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request)
    {
        $section = $request->query('p', 'profile');

        switch ($section) {
            case 'shipping-address':
                $response = Http::withHeaders([
                    'key' => '360a5f29619bc971359e639ddc86ae40' // API Key RajaOngkir
                ])->get('https://api.rajaongkir.com/starter/province');

                if ($response->successful()) {
                    $provinces = $response->json()['rajaongkir']['results'];
                } else {
                    $provinces = [];
                }
                return dd($response->json());
                return view('profile.shipping-address', compact('provinces'));
                break;

            case 'set-password':
                return view('profile.set-password');
                break;

            case 'deactive-account':
                return view('profile.deactive-account');
                break;

            case 'waiting-for-payment':
                return view('profile.waiting-for-payment');
                break;

            case 'transaction-list':
                return view('profile.transaction-list');
                break;

            default:
                return view('profile.index', [
                    'user' => $request->user(),
                ]);
                break;
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.profile')->with('success', 'Profile successfully updated!');
    }

    /**
     * Delete the user's account.
     */
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
