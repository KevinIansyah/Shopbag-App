<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Stock;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('dashboard.product.index');
    }

    public function data()
    {
        $products = Product::with(['images', 'categories'])->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                $name = $row->name ? '<p class="capitalize">' . $row->name . '</p>' : '-';
                return $name;
            })
            ->addColumn('price', function ($row) {
                return 'Rp ' . number_format($row->price, 0, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $action_button = '
                    <div class="flex gap-2">
                        <a  href="' . route('dashboard.product.edit', ['product' => $row->id]) . '"
                            class="w-10 h-10 text-white bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-200 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                            <i class="fa-sharp fa-regular fa-pen-to-square"></i>
                        </a>
                        <button type="button" onclick="destroyProduct(' . $row->id . ')"
                            class="w-10 h-10 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center transition-all duration-200 flex items-center justify-center">
                            <i class="fa-sharp fa-regular fa-trash"></i>
                        </button>
                    </div>
                ';

                return $action_button;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

    public function show() {}

    public function create()
    {
        if (Session::has('image-product-multiple')) {
            $session_image_product_multiple = Session::get('image-product-multiple');
            $tmp_file_multiples = TemporaryImage::whereIn('folder', $session_image_product_multiple)->get();
            foreach ($tmp_file_multiples as $tmp_file_multiple) {
                if (Storage::exists('post/tmp-image-product-multiple/' . $tmp_file_multiple->folder)) {
                    Storage::deleteDirectory('post/tmp-image-product-multiple/' . $tmp_file_multiple->folder);
                }
                $tmp_file_multiple->delete();
            }
            Session::forget('image-product-multiple');
        }

        if (Session::has('image-product')) {
            $session_image_product = Session::get('image-product');
            $tmp_file = TemporaryImage::where('folder', $session_image_product)->first();
            if ($tmp_file && Storage::exists('post/tmp-image-product/' . $tmp_file->folder)) {
                Storage::deleteDirectory('post/tmp-image-product/' . $tmp_file->folder);
            }
            if ($tmp_file) {
                $tmp_file->delete();
            }
            Session::forget('image-product');
        }

        $sizes = Size::select('type', DB::raw('GROUP_CONCAT(id) as size_ids'), DB::raw('GROUP_CONCAT(name) as size_names'))
            ->groupBy('type')
            ->get()
            ->map(function ($item) {
                return [
                    'type' => $item->type,
                    'size_names' => explode(',', $item->size_names),
                    'size_ids' => explode(',', $item->size_ids),
                ];
            });
        $categories = Category::all();

        return view('dashboard.product.add', compact('categories', 'sizes'));
    }

    public function store(Request $request)
    {
        // return dd($request);
        try {
            $session_image_product_multiple = Session::get('image-product-multiple');

            if (!empty($session_image_product_multiple)) {
                $tmp_file_multiples = TemporaryImage::whereIn('folder', $session_image_product_multiple)->get();
            } else {
                throw new \Exception('Temporary files not found.');
            }

            $validate_data = $request->validate([
                'name' => 'required|string',
                'price' => 'required|integer',
                'description' => 'required|string',
            ]);

            $slug = Str::slug($validate_data['name']);
            $originalSlug = $slug;
            $counter = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $validate_data['slug'] = $slug;

            $product = Product::create($validate_data);

            $categories = $request->category;
            foreach ($categories as $category) {
                ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $category
                ]);
            }

            if ($tmp_file_multiples->isNotEmpty()) {
                foreach ($tmp_file_multiples as $tmp_file_multiple) {
                    Storage::move('post/tmp-image-product-multiple/' . $tmp_file_multiple->folder . '/' . $tmp_file_multiple->file, 'image-product-multiple/' . $tmp_file_multiple->folder . '/' . $tmp_file_multiple->file);
                }

                foreach ($tmp_file_multiples as $tmp_file_multiple) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $tmp_file_multiple->folder . '/' . $tmp_file_multiple->file,
                    ]);
                }

                foreach ($tmp_file_multiples as $tmp_file_multiple) {
                    Storage::deleteDirectory('post/tmp-image-product-multiple/' . $tmp_file_multiple->folder);
                    $tmp_file_multiple->delete();
                }

                Session::forget('image-product-multiple');
            }

            $stocks = $request->stock;

            foreach ($stocks as $size_id => $stock) {
                Stock::create([
                    'product_id' => $product->id,
                    'size_id' => $size_id,
                    'quantity' => $stock,
                ]);
            }

            return redirect()->back()->with('success_sweet', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_sweet', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);

            return view('dashboard.product.edit', compact('product'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Product not found or an error occurred.');
        }
    }

    public function update($id) {}

    public function destroy($id) {}

    public function uploadImage() {}
}
