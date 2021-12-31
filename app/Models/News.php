<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    public $guarded = [];
    

    public function getImagePathAttribute()
    {
        // return (asset('uploads/News_images/'. $this->image));

        $filename = $this->image;
        $dir = '/1F5fFFquyS9qn54TNNf5b-ebyxwdK8ohy';
        $recursive = false; // Get subdirectories also?
        $contents = collect(\Storage::disk("google")->listContents($dir, $recursive));
        $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!
    
        return $rawData = \Storage::disk("google")->url($file['path']);
    }
}
