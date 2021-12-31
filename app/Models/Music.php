<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $table = 'Music';

    public function getImagePathAttribute()
    {
        // return (asset('uploads/Music_images/'. $this->image));

        $filename = $this->image;
        $dir = '/1vHZv_7W0Js9RVmUSXkF69sYZSfMffP3y';
        $recursive = false; // Get subdirectories also?
        $contents = collect(\Storage::disk("google")->listContents($dir, $recursive));
        $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!
    
        return $rawData = \Storage::disk("google")->url($file['path']);
    }

    public function getTrackPathAttribute()
    {
        // return (asset('uploads/Music_Tracks/'. $this->image));

        $filename = $this->track;
        $dir = '/1R-PdZQb5XIeycPWgntlfqxLWQl3Z8_da';
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
