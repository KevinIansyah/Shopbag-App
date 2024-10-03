<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FilepondController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $folder = uniqid('post', true);
            $image->storeAs('post/tmp-image-product/' . $folder, $file_name);
            TemporaryImage::create([
                'folder' => $folder,
                'file' => $file_name,
            ]);
            Session::push('image-product', $folder);
            return $folder;
        }
        return '';
    }

    public function cancelFile()
    {
        $folder = request()->getContent();
        $imageProduct = Session::get('image-product', []);

        $index = array_search($folder, $imageProduct);

        if ($index !== false) {
            unset($imageProduct[$index]);
            Session::put('image-product', $imageProduct);
        }

        $tmp_file = TemporaryImage::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('post/tmp-image-product/' . $tmp_file->folder);
            $tmp_file->delete();
            return response('');
        }
    }

    public function removeFile(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmp_file = ProductImage::where('image_url', 'like', '%' . $folder . '/%')->first();
        if ($tmp_file) {
            Storage::deleteDirectory('image-product/' . $folder);
            $tmp_file->image = null;
            $tmp_file->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function uploadFileMultiple(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $file_name = $image->getClientOriginalName();
            $folder = uniqid('post', true);
            $image->storeAs('post/tmp-image-product-multiple/' . $folder, $file_name);

            TemporaryImage::create([
                'folder' => $folder,
                'file' => $file_name,
            ]);

            Session::push('image-product-multiple', $folder);
            return $folder;
        }
        return '';
    }

    public function cancelFileMultiple()
    {
        $folder = request()->getContent();
        $imageProductDetail = Session::get('image-product-multiple', []);

        $index = array_search($folder, $imageProductDetail);

        if ($index !== false) {
            unset($imageProductDetail[$index]);
            Session::put('image-product-multiple', $imageProductDetail);
        }

        $tmp_file = TemporaryImage::where('folder', $folder)->first();
        if ($tmp_file) {
            Storage::deleteDirectory('post/tmp-image-product-multiple/' . $tmp_file->folder);
            $tmp_file->delete();
        }

        return response()->noContent();
    }

    public function removeFileMultiple(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmp_file = ProductImage::where('image_url', 'like', '%' . $folder . '/%')->first();
        if ($tmp_file) {
            Storage::deleteDirectory('image-product-multiple/' . $folder);
            $tmp_file->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }
}
