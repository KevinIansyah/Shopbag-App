<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\TemporaryImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FilepondController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $folder = uniqid('post', true);
            $image->storeAs('post/tmp-image-filepond/' . $folder, $fileName, 'public');
            TemporaryImage::create([
                'folder' => $folder,
                'file' => $fileName,
            ]);
            Session::push('image-filepond', $folder);
            return $folder;
        }
        return '';
    }

    public function cancelImage()
    {
        $folder = request()->getContent();
        $image = Session::get('image-filepond', []);

        $index = array_search($folder, $image);

        if ($index !== false) {
            unset($image[$index]);
            Session::put('image-filepond', $image);
        }

        $tmpFile = TemporaryImage::where('folder', request()->getContent())->first();
        if ($tmpFile) {
            Storage::disk('public')->deleteDirectory('post/tmp-image-filepond/' . $tmpFile->folder);
            $tmpFile->delete();
            return response('');
        }
    }

    public function removeImage(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = ProductImage::where('image_url', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::disk('public')->deleteDirectory('image-filepond/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeImageProfile(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = User::where('image', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::disk('public')->deleteDirectory('image-filepond/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function uploadImageMultiple(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $fileName = $image->getClientOriginalName();
            $folder = uniqid('post', true);
            $image->storeAs('post/tmp-image-filepond/' . $folder, $fileName, 'public');

            TemporaryImage::create([
                'folder' => $folder,
                'file' => $fileName,
            ]);

            Session::push('image-multiple-filepond', $folder);
            return $folder;
        }
        return '';
    }

    public function cancelImageMultiple()
    {
        $folder = request()->getContent();
        $imageDetail = Session::get('image-multiple-filepond', []);

        $index = array_search($folder, $imageDetail);

        if ($index !== false) {
            unset($imageDetail[$index]);
            Session::put('image-multiple-filepond', $imageDetail);
        }

        $tmpFile = TemporaryImage::where('folder', $folder)->first();
        if ($tmpFile) {
            Storage::disk('public')->deleteDirectory('post/tmp-image-filepond/' . $tmpFile->folder);
            $tmpFile->delete();
        }

        return response()->noContent();
    }

    public function removeImageMultiple(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = ProductImage::where('image_url', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::disk('public')->deleteDirectory('image-filepond/' . $folder);
            $tmpFile->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }
}
