<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('access', 'admin')->get();

        return view('dashboard.user.admin.index', compact('admins'));
    }

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

// ->addColumn('action', function ($row) {
//     $visionResult = auth()->user()->can('lihat hasil') ? 'd-block' : 'd-none';
//     $visionUser = auth()->user()->can('lihat peserta') ? 'd-block' : 'd-none';
//     $visionQuestion = auth()->user()->can('lihat soal') ? 'd-block' : 'd-none';
//     $visionEdit = auth()->user()->can('edit ujian') ? 'd-block' : 'd-none';
//     $visionDelete = auth()->user()->can('hapus ujian') ? 'd-block' : 'd-none';

//     $actionBtn = '
//         <div class="d-flex">
//             <a href="' . route('dashboard.exam.result', ['exam' => $row->id]) . '"
//                class="' . $visionResult . ' btn btn-inverse-success p-2 mr-1"
//                data-bs-tooltip="tooltip" 
//                data-bs-placement="top" 
//                data-bs-title="Lihat Hasil" 
//                data-bs-custom-class="tooltip-dark">
//                     <i class="ti-clipboard mx-1 my-2"></i>
//             </a>
//             <a href="' . route('dashboard.exam.user.add', ['exam' => $row->id]) . '"
//                class="' . $visionUser . ' btn btn-inverse-primary p-2 mr-1"
//                data-bs-tooltip="tooltip" 
//                data-bs-placement="top" 
//                data-bs-title="Tambah Peserta" 
//                data-bs-custom-class="tooltip-dark">
//                     <i class="ti-user mx-1 my-2"></i>
//             </a>
//             <a href="' . route('dashboard.exam.question', ['exam' => $row->id]) . '"
//                class="' . $visionQuestion . ' btn btn-inverse-info p-2 mr-1"
//                data-bs-tooltip="tooltip" 
//                data-bs-placement="top" 
//                data-bs-title="Tambah Soal" 
//                data-bs-custom-class="tooltip-dark">
//                     <i class="ti-agenda mx-1 my-2"></i>
//             </a>
//             <a href="' . route('dashboard.exam.edit', ['exam' => $row->id]) . '"
//                class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
//                data-bs-tooltip="tooltip" 
//                data-bs-placement="top" 
//                data-bs-title="Edit Ujian" 
//                data-bs-custom-class="tooltip-dark">
//                 <i class="ti-pencil mx-1 my-2"></i>
//             </a>
//             <button onclick="destroyExam(' . $row->id . ')"
//                 type="button" 
//                 class="' . $visionDelete . ' btn btn-inverse-danger p-2"
//                 data-bs-tooltip="tooltip" 
//                 data-bs-placement="top" 
//                 data-bs-title="Hapus Ujian" 
//                 data-bs-custom-class="tooltip-dark">
//                     <i class="ti-trash mx-1 my-2"></i>
//             </button>
//         </div>
//     ';
//     return $actionBtn;
// })