<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimonials extends Model
{
    use HasFactory;

    public $guarded = [];
    

    public function getImagePathAttribute()
    {
        // return (asset('uploads/testimonials_images/'. $this->image));
        
        // if(asset('uploads/testimonials_images/'. $this->image))
        // {return (asset('uploads/testimonials_images/'. $this->image));}  
                
        $filename = $this->image;
        $dir = '/1Umjh6NEblkvfOV2vd-G87SqF7ycI5FaO';
        $recursive = false; // Get subdirectories also?
        $contents = collect(\Storage::disk("google")->listContents($dir, $recursive));
        $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!
        
        // dd($file['path']);
        //return $file; // array with file info
    
        //   $rawData = \Storage::disk("google")->get($file['path']);
        return $rawData = \Storage::disk("google")->url($file['path']);

        //  return response($rawData, 200)
        //  ->header('ContentType', $file['mimetype'])
        //  ->header('Content-Disposition', "attachment; filename='$filename'");
     

        
        
       

     
    }

}

