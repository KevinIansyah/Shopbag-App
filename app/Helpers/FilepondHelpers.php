<?php

namespace App\Helpers;

use App\Models\TemporaryImage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class  FilepondHelpers
{
  public static function removeSessionSingle()
  {
    if (Session::has('image-filepond')) {
      $sessionImage = Session::get('image-filepond');
      $tmpFile = TemporaryImage::where('folder', $sessionImage)->first();
      if ($tmpFile && Storage::exists('post/tmp-image-filepond/' . $tmpFile->folder)) {
        Storage::deleteDirectory('post/tmp-image-filepond/' . $tmpFile->folder);
      }
      if ($tmpFile) {
        $tmpFile->delete();
      }
      Session::forget('image-filepond');
    }
  }

  public static function removeSessionMultiple()
  {
    if (Session::has('image-multiple-filepond')) {
      $sessionImageMultiple = Session::get('image-multiple-filepond');
      $tmpFileMultiples = TemporaryImage::whereIn('folder', $sessionImageMultiple)->get();
      foreach ($tmpFileMultiples as $tmpFileMultiple) {
        if (Storage::exists('post/tmp-image-filepond/' . $tmpFileMultiple->folder)) {
          Storage::deleteDirectory('post/tmp-image-filepond/' . $tmpFileMultiple->folder);
        }
        $tmpFileMultiple->delete();
      }
      Session::forget('image-multiple-filepond');
    }
  }
}
