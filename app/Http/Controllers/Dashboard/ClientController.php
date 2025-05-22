<?php

namespace App\Http\Controllers\Dashboard;

/**
 * Controller untuk mengelola data klien (user) di dashboard
 * 
 * Controller ini menangani operasi terkait klien termasuk:
 * - Menampilkan daftar klien
 * - Menyediakan data klien untuk DataTables
 */

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    /**
     * Menampilkan halaman daftar klien
     *
     * Mengambil semua data user dengan akses 'user' dan menampilkannya di view
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $clients = User::where('access', 'user')->get();

        return view('dashboard.user.client.index', compact('clients'));
    }

    /**
     * Menyediakan data klien untuk DataTables
     * 
     * Mengambil semua user dengan akses 'user' dan
     * menyiapkan data untuk ditampilkan dalam tabel dengan
     * format yang sesuai (nama, email, gender, tanggal lahir)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        $clients = User::where('access', 'user')->get();

        return DataTables::of($clients)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                $name = $row->name ? '<p class="capitalize">' . $row->name . '</p>' : '-';
                return $name;
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('gender', function ($row) {
                $gender = $row->gender ? '<p class="capitalize">' . $row->gender . '</p>' : '-';
                return $gender;
            })
            ->addColumn('birthday', function ($row) {
                $birthday = $row->birthday ? Carbon::parse($row->birthday)->translatedFormat('d F Y') : '-';
                return $birthday;
            })
            ->addColumn('action', function ($row) {
                return '-';
            })
            ->rawColumns(['name', 'gender'])
            ->make(true);
    }
}
