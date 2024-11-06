<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressHomeController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'recipient_name' => 'required|string',
                'recipient_contact' => 'required|string',
                'province' => 'required|string',
                'city' => 'required|string',
                'address' => 'required|string',
                'notes' => 'nullable|string',
                'is_primary' => 'nullable',
            ]);

            $validateData['user_id'] = Auth::id();

            if ($request->filled('is_primary')) {
                $validateData['is_primary'] = true;

                Address::where('user_id', Auth::id())
                    ->where('is_primary', true)
                    ->update(['is_primary' => false]);
            } else {
                $validateData['is_primary'] = false;
            }

            $address = Address::create($validateData);

            return redirect()->back()->with('success', 'Shipping address added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the shipping address');
        }
    }
}
