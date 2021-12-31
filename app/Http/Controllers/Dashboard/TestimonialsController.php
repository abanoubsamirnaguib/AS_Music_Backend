<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\testimonials;
use  Intervention\Image\ImageManagerStatic as Image;

class TestimonialsController extends Controller
{

    public function index(Request $request)
    {
        // $products=product::paginate(5);
        $testimonials=testimonials::all();

        if($request->search){

            $testimonials=testimonials::where("name" , 'like' ,"%". $request->search . "%" )->latest()->paginate(5);
            }
            else {
            $testimonials=testimonials::paginate(5);
                }
                // return (($categories));
        return view('dashboard.testimonials.index',['testimonials'=>$testimonials]);
    }


    public function create()
    {
        // $testimonials=testimonials::all();
        return view('dashboard.testimonials.create');
    }


    public function store(Request $request)
    {
        $rules=[
        'name'=>'required|string',
        'job'=>'required|string',
        'description'=>'required|string',
        'likes'=>'required|integer',
        'image' => 'image'
        ];
        
        $request_data=$request->all(); 
                // dd($request_data);

        if( $request->file('image') ){

            $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // ->save(public_path('uploads/testimonials_images/'.$request->image->getClientOriginalName() ) );
            $request_data['image'] = $request->image->getClientOriginalName();

            // $name =  $request->image->getClientOriginalName();
            $file =  $request->file('image');
            $this->putInDir($file);

        } else {

            $request_data['image'] =('default.png');
        }

        $validated = $request->validate($rules);

        $testimonials = testimonials::Create ($request_data);
            
        $request->session()->flash('success', __('site.added_successfully'));
        return redirect(route('dashboard.testimonials.index'));
    }



    public function edit(testimonials $testimonial)
    {
        // $testimonials=testimonials::all();
        return view("dashboard.testimonials.edit",['testimonial'=>$testimonial]);
    
    }


    public function update(Request $request, testimonials $testimonial)
    {
        $rules=[
            'name'=>'required|string',
            'job'=>'required|string',
            'description'=>'required|string',
            'likes'=>'required|integer',
            'image' => 'image'
            ];
            
            $request_data=$request->all(); 
    
                if( $request->file('image') && $testimonial->image != "default.png"){

                    if($testimonial->image != "default.png"){ 
                    // Storage::disk("public_uploads")->delete('/testimonials_images/'.$testimonial->image);  
                    $OldName =  $testimonial->image;
                    $this->deleteFromDir($OldName);
                    }
                    
                $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // ->save(public_path('/uploads/testimonials_images/'.$request->image->getClientOriginalName() ) );
                $request_data['image'] = $request->image->getClientOriginalName();

                // $NewName = $request->image->getClientOriginalName();
                $file = $request->file('image');
                $this->putInDir($file);
            
            }
    
            $validated = $request->validate($rules);
            $testimonial ->update($request_data);

            $request->session()->flash('success', __('site.updated_successfully'));
            return redirect(route('dashboard.testimonials.index'));
    }


    public function destroy(Request $request, testimonials $testimonial)
    {
        if($testimonial->image != 'default.png'){
            $name =  $testimonial->image;
            $this->deleteFromDir($name);
            Storage::disk("public_uploads")->delete('/testimonials_images/'.$testimonial->image);        
        }
        $testimonial->delete();
        $request->session()->flash('success', __('site.deleted_successfully'));
        //  dd($product);
        return redirect(route('dashboard.testimonials.index'));
    }

    // help functions
    public static function putInDir($file){

        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));
    
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', 'testimonials_images')
            ->first(); // There could be duplicate directory names!

        $filename = $file->getClientOriginalName();
        // $filePath = public_path('/uploads/testimonials_images/'.$filename);
        // $fileData = \File::get($filePath);

        if ( ! $dir) {
            return 'Directory does not exist!';
        }        
        Storage::disk('google')->putFileAs($dir['path'] , $file , $filename);
    }

    public static function deleteFromDir($name){

        $filename = $name;
        $dir = '/1Umjh6NEblkvfOV2vd-G87SqF7ycI5FaO';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));
        $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!
        // dd($filename);
        
        if (! $file['path']) {
            dd ('File does not exist!');
        }        
        Storage::disk('google')->delete($file['path'] );
    }
}

