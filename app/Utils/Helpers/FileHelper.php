<?php

namespace App\Utils\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileHelper
{
    public static function optimizeAndUploadPicture($image, $url, $quality = 80)
    {
        $newFileName = $image->hashName();

        $image = Image::make($image);

        $image->encode('webp', $quality);

        $newFileName = explode('.', $newFileName)[0] . ".webp";

        $outputPath = "$url/$newFileName";
        $isUploaded = Storage::disk('public')->put($outputPath, $image);

        if (!$isUploaded) {
            if (Storage::disk('public')->exists($outputPath)) {
                Storage::disk('public')->delete($outputPath);
            }

            return redirect()->back()->with([
                'message' => 'Something went wrong, please try again',
                'status' => 'danger',
            ]);
        }

        $image16x9 = Image::make($image)->fit(1280, 720);
        $image16x9->encode('webp', $quality);
        $outputPath16x9 = "$url/16x9/$newFileName";
        $isUploaded = Storage::disk('public')->put($outputPath16x9, $image16x9);

        if (!$isUploaded) {
            if (Storage::disk('public')->exists($outputPath)) {
                Storage::disk('public')->delete($outputPath);
            }
            return redirect()->back()->with([
                'message' => 'Something went wrong, please try again',
                'status' => 'danger',
            ]);
        }

        $image4x3 = Image::make($image)->fit(1280, 960);
        $image4x3->encode('webp', $quality);
        $outputPath4x3 = "$url/4x3/$newFileName";
        $isUploaded = Storage::disk('public')->put($outputPath4x3, $image4x3);

        if (!$isUploaded) {
            if (Storage::disk('public')->exists($outputPath)) {
                Storage::disk('public')->delete($outputPath);
            }
            if (Storage::disk('public')->exists($outputPath16x9)) {
                Storage::disk('public')->delete($outputPath16x9);
            }
            return redirect()->back()->with([
                'message' => 'Something went wrong, please try again',
                'status' => 'danger',
            ]);
        }

        return $newFileName;
    }

    public static function deleteImage($url, $fileName)
    {
        $path16x9 = "$url/16x9/$fileName";
        $path4x3 = "$url/4x3/$fileName";
        if (Storage::disk('public')->exists("$url/$fileName")) {
            Storage::disk('public')->delete("$url/$fileName");
        }
        if (Storage::disk('public')->exists($path16x9)) {
            Storage::disk('public')->delete($path16x9);
        }
        if (Storage::disk('public')->exists($path4x3)) {
            Storage::disk('public')->delete($path4x3);
        }
    }

    public static function getImage($filePath, $defaultImage = 'assets/media/svg/avatars/blank.svg')
    {
        $url = asset($defaultImage);
        if (!$filePath) {
            return $url;
        }
        if (file_exists(public_path($filePath))) {
            $url = asset($filePath);
        }
        if (Storage::disk('public')->exists($filePath)) {
            $url = Storage::disk('public')->url($filePath);
        }

        return $url;
    }

    public static function getFile($filePath)
    {

        $url = '';

        if (file_exists(public_path($filePath))) {
            $url = asset($filePath);
        }

        if (Storage::disk('public')->exists($filePath)) {
            $url = Storage::disk('public')->url($filePath);
        }

        return $url;
    }
}
