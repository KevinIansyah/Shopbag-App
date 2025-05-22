<?php

namespace App\Http\Controllers\Dashboard;

/**
 * Controller untuk mengelola data admin di dashboard
 * 
 * Controller ini menangani operasi terkait admin termasuk:
 * - Menampilkan daftar admin
 * - Menyediakan data admin untuk DataTables
 */

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman daftar admin
     *
     * Mengambil semua data user dengan akses 'admin' dan menampilkannya di view
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $admins = User::where('access', 'admin')->get();

        return view('dashboard.user.admin.index', compact('admins'));
    }

    /**
     * Menyediakan data admin untuk DataTables
     * 
     * Mengambil semua user dengan akses 'admin' dan
     * menyiapkan data untuk ditampilkan dalam tabel dengan
     * format yang sesuai (nama, email, gender, tanggal lahir)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        $admins = User::where('access', 'admin')->get();

        return DataTables::of($admins)
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
