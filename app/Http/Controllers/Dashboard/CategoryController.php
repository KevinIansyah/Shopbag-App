<?php

namespace App\Http\Controllers\Dashboard;

/**
 * Controller untuk mengelola kategori produk di dashboard
 * 
 * Controller ini menangani semua operasi CRUD terkait kategori termasuk:
 * - Menampilkan daftar kategori
 * - Membuat kategori baru
 * - Mengedit kategori yang sudah ada
 * - Menghapus kategori
 * - Menyediakan data kategori untuk DataTables
 */

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Menampilkan halaman daftar kategori
     *
     * Mengambil semua data kategori dan menampilkannya di view
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.product.category.index', compact('categories'));
    }

    /**
     * Menyediakan data kategori untuk DataTables
     * 
     * Mengambil semua kategori diurutkan berdasarkan ID secara descending
     * dan menyiapkan data untuk ditampilkan dalam tabel
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        $categories = Category::orderBy('id', 'DESC')->get();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                $name = $row->name ? '<p class="capitalize">' . $row->name . '</p>' : '-';
                return $name;
            })
            ->addColumn('action', function ($row) {
                $action_button = '
                    <div class="flex gap-2">
                        <button type="button" onclick="updateCategory(' . $row->id . ')" @click="open = true"
                            class="w-8 h-8 text-white bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                            <i class="fa-sharp fa-solid fa-pen"></i>
                        </button>
                        <button type="button" onclick="destroyCategory(' . $row->id . ')"
                            class="w-8 h-8 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                            <i class="fa-sharp fa-solid fa-trash"></i>
                        </button>
                    </div>
                ';

                return $action_button;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

    /**
     * Menampilkan detail kategori (tidak diimplementasikan)
     */
    public function show() {}

    /**
     * Menampilkan form untuk membuat kategori baru (tidak diimplementasikan)
     */
    public function create() {}

    /**
     * Menyimpan kategori baru ke database
     *
     * Memvalidasi input yang diterima dan membuat kategori baru
     * 
     * @param Request $request Request yang berisi data kategori
     * @return \Illuminate\Http\JsonResponse Response berisi status dan data kategori
     */
    public function store(Request $request)
    {
        try {
            $validate_data = $request->validate([
                'name' => 'required|string',
            ]);

            $category = Category::create($validate_data);

            return response()->json([
                'success' => true,
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengambil data kategori untuk diedit
     *
     * Mencari kategori berdasarkan ID dan mengembalikan data dalam format JSON
     * 
     * @param int $id ID kategori yang akan diedit
     * @return \Illuminate\Http\JsonResponse Response berisi status dan data kategori
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Category find successfully',
                'data' => $category,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memperbarui data kategori yang sudah ada
     *
     * Memvalidasi input yang diterima dan memperbarui kategori yang ada
     * 
     * @param Request $request Request yang berisi data kategori yang diperbarui
     * @param int $id ID kategori yang akan diperbarui
     * @return \Illuminate\Http\JsonResponse Response berisi status dan data kategori yang diperbarui
     */
    public function update(Request $request, $id)
    {
        try {
            $validate_data = $request->validate([
                'name' => 'required|string',
            ]);

            $category = Category::findOrFail($id);

            $category->update($validate_data);

            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'data' => $category
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus kategori dari database
     *
     * Mencari kategori berdasarkan ID dan menghapusnya
     * 
     * @param int $id ID kategori yang akan dihapus
     * @return \Illuminate\Http\JsonResponse Response berisi status operasi penghapusan
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
