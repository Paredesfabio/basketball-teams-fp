<?php


namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait FileSaveTrait
{
    private function saveImage($destination, $attribute): string
    {
        if (!File::isDirectory(base_path().'/public/uploads/'.$destination)){
            File::makeDirectory(base_path().'/public/uploads/'.$destination, 0777, true, true);
        }
        $fileName = time().'-'. Str::random(10) . '.' . $attribute->extension();
        $destinationPath = 'uploads/'. $destination .'/';
        $returnPath = $destinationPath . $fileName;
        $attribute->move($destinationPath, $fileName );
        return $returnPath;
    }

    private function deleteFile($path)
    {
        if ($path == null || $path == '') {
            return null;
        }
        File::delete($path);
    }

}
