<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        // $admins = User::where('access', 'admin')->get();

        // return view('dashboard.user.admin.index', compact('admins'));
    }

    public function data()
    {
        // $admins = User::where('access', 'admin')->get();

        // return DataTables::of($admins)
        //     ->addIndexColumn()
        //     ->addColumn('name', function ($row) {
        //         $name = $row->name ? '<p class="capitalize">' . $row->name . '</p>' : '-';
        //         return $name;
        //     })
        //     ->addColumn('email', function ($row) {
        //         return $row->email;
        //     })
        //     ->addColumn('gender', function ($row) {
        //         $gender = $row->gender ? '<p class="capitalize">' . $row->gender . '</p>' : '-';
        //         return $gender;
        //     })
        //     ->addColumn('birthday', function ($row) {
        //         $birthday = $row->birthday ? Carbon::parse($row->birthday)->translatedFormat('d F Y') : '-';
        //         return $birthday;
        //     })
        //     ->addColumn('action', function ($row) {
        //         return '-';
        //     })
        //     ->rawColumns(['name', 'gender'])
        //     ->make(true);
    }
}
