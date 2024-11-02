<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        // Redirect ke halaman pilih akun Google
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // Mendapatkan data pengguna dari Google
        $googleUser = Socialite::driver('google')->user();

        // Cari pengguna berdasarkan google_id atau email
        $user = User::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        if ($user) {
            // Jika pengguna sudah ada, update data Google
            $user->update([
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'image' => $googleUser->avatar,
            ]);
        } else {
            // Buat pengguna baru jika belum ada
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'access' => 'user',
                'image' => $googleUser->avatar,
                'password' => Hash::make(Str::random(16))
            ]);
        }

        // Login pengguna
        Auth::login($user);

        // Redirect ke halaman utama
        return redirect('/');
    }
}
