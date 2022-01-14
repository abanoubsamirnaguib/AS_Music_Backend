<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\Models\Music;
use  Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;

class MusicController extends Controller
{
    public function index(Request $request)
    {
        // $products=product::paginate(5);
        $Music=Music::all();

        if ($request->search  and $request->field ){            
            $Music=Music::when($request->search , function($query) use ($request)  {           
                return   $query->where($request->field , 'like' ,"%". $request->search . "%");
            // })->When($request->category , function($query) use ($request)  {          
            //         return   $query->where("category" , '=' , $request->category);
                    })   
                    ->latest()->paginate(5);
                }
            else {
            $Music = Music::paginate(5);
                }                
                $fields= DB::getSchemaBuilder()->getColumnListing("Music");
                // dd($fields);
                $fields = [$fields[1],$fields[2],$fields[3],$fields[7]];
                  
        return view('dashboard.Music.index',['Music'=>$Music ,'fields'=>$fields ]);
    }

    public function create()
    {
        // $Music=Music::all();
        return view('dashboard.Music.create');
    }

    public function store(Request $request)
    {
        $rules=[
        'Title'=>'required|string',
        'Artist'=>'required|string',
        'Label'=>'required|string',
        'description'=>'required|string',
        'likesNumber'=>'required|integer',
        'shareNumber'=>'required|integer',
        'shareLink'=>'required|string',
        'image' => 'image',
        // 'track' => 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav'
    ];
        
        $request_data=$request->all(); 
        // dd($request_data);

        if( $request->file('image') ){

            $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // ->save(public_path('/uploads/Music_images/'.$request->image->getClientOriginalName() ) );
            $request_data['image'] = $request->image->getClientOriginalName();
         
            $name =  $request->image->getClientOriginalName();
            $file =  $request->file('image');
            $folderName = 'Music_images';
            $this->putInDir($file , $folderName);

        } else {
            $request_data['image'] =('default.png');
        }

        if($request->Date){
            $request_data['Released'] = date_format(new DateTime($request->Released) , "Y-m-d h:i:s");
        }else{
            $request_data['Released'] = date_format( new DateTime("now", new DateTimeZone('Africa/Cairo') ) , "y-m-d h:i:s"   );
            // dd($request_data['Date']);
        }
        
        if( $request->file('track') && $request->track != "demo 6.mp3" ){

                // dd($request->track);
        $file = $request->file('track');
        $filename = $file->getClientOriginalName();
        // $file->move(public_path('/uploads/Music_Tracks/' ), $filename);             
      
        $request_data['track'] = $request->track->getClientOriginalName();
        $folderName = 'Music_Tracks';
        $this->putInDir($file ,$folderName );  
    }

        $validated = $request->validate($rules);

        $Music = Music::Create ($request_data);
            
        $request->session()->flash('success', __('site.added_successfully'));
        return redirect(route('dashboard.Music.index'));
    }

    public function edit(Music $track)
    {
        // $Music=Music::all();
        return view("dashboard.Music.edit",['track'=>$track ]);
    
    }

    public function update(Request $request, Music $track)
    {
        $rules=[
            'Title'=>'required|string',
            'Artist'=>'required|string',
            'Label'=>'required|string',
            'description'=>'required|string',
            'likesNumber'=>'required|integer',
            'shareNumber'=>'required|integer',
            'shareLink'=>'required|string',
            'image' => 'image',
            // 'track' => 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav'
            ];
            
            $validated = $request->validate($rules);
            $request_data = $request->all(); 

            if($request->Date){
                $request_data['Released'] = date_format(new DateTime($request->Date), "Y-m-d h:i:s" );
            }else{
                $request_data['Released'] = $track->Released;
            }
    
                if( $request->file('image') && $request->image != "default.png"  ){
                    
                    if($track->image != "default.png"){                        
                        // Storage::disk("public_uploads")->delete('/Music_images/'.$track->image);  
                        $OldName =  $track->image;
                        $folder = '1vHZv_7W0Js9RVmUSXkF69sYZSfMffP3y';
                        $this->deleteFromDir($OldName, $folder);
                    }
    
                $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // ->save(public_path('/uploads/Music_images/'.$request->image->getClientOriginalName() ) );
                $request_data['image'] = $request->image->getClientOriginalName();
                
                $NewFile = $request->file('image');
                $folderName = 'Music_images';
                $this->putInDir($NewFile , $folderName); 
            }

            if( $request->file('track') && $request->track != "demo 6.mp3" ){
                
                if($track->track != "demo 6.mp3"){                        
                    // Storage::disk("public_uploads")->delete('/Music_Tracks/'.$track->track);  
                    $OldName =  $track->track;
                    $folder='1R-PdZQb5XIeycPWgntlfqxLWQl3Z8_da';
                    $this->deleteFromDir($OldName,  $folder);
                }

                        // dd($request->track);
                // $filePath = public_path('/uploads/Music_Tracks/'.$request->track->getClientOriginalName());
                // $fileData = \File::get($filePath);
                // $file = $request->track;

                $file = $request->file('track');
                // $filename = $file->getClientOriginalName();
                // $file->move(public_path('/uploads/Music_Tracks/' ), $filename);                          
                $request_data['track'] = $request->track->getClientOriginalName();
                
                $folderName = 'Music_Tracks';
                $this->putInDir($file ,$folderName );
            }
            
            $track ->update($request_data);
            $request->session()->flash('success', __('site.updated_successfully'));
            return redirect(route('dashboard.Music.index'));
    }

    public function destroy(Request $request, Music $track)
    {
        if($track->image != 'default.png'){
            $name =  $track->image;
            $folderName='1vHZv_7W0Js9RVmUSXkF69sYZSfMffP3y';
            $this->deleteFromDir($name,$folderName);

            // Storage::disk("public_uploads")->delete('/Music_images/'.$track->image);  
        }
        if($track->track != 'demo 6.mp3'){
            $name =  $track->track;
            $folderName='1R-PdZQb5XIeycPWgntlfqxLWQl3Z8_da';
            $this->deleteFromDir($name,$folderName);

            // Storage::disk("public_uploads")->delete('/Music_Tracks/'.$track->track);  
        }
        $track->delete();
        $request->session()->flash('success', __('site.deleted_successfully'));
        return redirect(route('dashboard.Music.index'));
    }

    // help functions

    public static function putInDir($file ,$folderName ){

        $dir = '/1uHcJB5eYRc8Y-mTRSsExe74fXYYQ_Zbx';
        $folder =$folderName; 
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));
    
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folderName)
            ->first(); // There could be duplicate directory names!

        $filename = $file->getClientOriginalName();
        // $filePath = public_path('/uploads/'.$folderName.'/'.$filename);
        // $filePath = $name;
        // $fileData = \File::get($filePath);

        if ( ! $dir['path']) {
            return 'Directory does not exist!';
        }        
        dd([$dir['path'],$file , $filename ] );
        // Storage::disk('google')->put($dir['path']. '/' .$filename , $fileData);
        // dd($name);
        Storage::disk('google')->putFileAs($dir['path'] , $file , $filename);
    }

    public static function deleteFromDir($name, $folder){

        $filename = $name;
        $dir = $folder;
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));
        $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!
        // dd($filename);
        
        if ( ! $file['path']) {
            dd ('File does not exist!');
        }        
        Storage::disk('google')->delete($file['path'] );
    }
}
