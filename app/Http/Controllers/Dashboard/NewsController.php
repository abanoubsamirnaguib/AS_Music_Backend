<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\Models\News;
use  Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use DateTime;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // $products=product::paginate(5);
        $News=News::all();

        if ($request->search  or $request->category ){            
            $News=News::when($request->search , function($query) use ($request)  {           
                return   $query->where("title" , 'like' ,"%". $request->search . "%");
            })->When($request->category , function($query) use ($request)  {          
                    return   $query->where("category" , '=' , $request->category);
                    })   
                    ->latest()->paginate(5);
                }
            else {
            $News=News::paginate(5);
                }

          $enumoption = $this->getEnumValues( 'News', 'category' );
                // return (($categories));
        return view('dashboard.News.index',['News'=>$News ,'enumoption'=>$enumoption ]);
    }

    public function create()
    {
        // $News=News::all();
        $enumoption = $this->getEnumValues( 'News', 'category' );
        return view('dashboard.News.create',['enumoption'=>$enumoption]);
    }

    public function store(Request $request)
    {
        $rules=[
        'title'=>'required|string',
        'subTitle'=>'required|string',
        'description'=>'required|string',
        'likesNumber'=>'required|integer',
        'shareNumber'=>'required|integer',
        'shareLink'=>'required|string',
        'dateTime'=>'date',
        'image' => 'image'
        ];
        
        $request_data=$request->all(); 
        // dd($request_data);

        if( $request->file('image') ){

            $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // ->save(public_path('/uploads/News_images/'.$request->image->getClientOriginalName() ) );
            $request_data['image'] = $request->image->getClientOriginalName();
         
            $name =  $request->image->getClientOriginalName();
            $file =  $request->file('image');
            $this->putInDir($file);

        } else {
            $request_data['image'] =('default.png');
        }

        if($request->Date){
            $request_data['Date'] = date_format(new DateTime($request->Date) , "Y-m-d h:i:s");
        }else{
            $request_data['Date'] = date_format( new DateTime("now", new \DateTimeZone('Africa/Cairo') ) , "y-m-d h:i:s"   );
            // dd($request_data['Date']);
        }

        $validated = $request->validate($rules);

        $News = News::Create ($request_data);
            
        $request->session()->flash('success', __('site.added_successfully'));
        return redirect(route('dashboard.News.index'));
    }

    public function edit(News $New)
    {
        // $News=News::all();
        $enumoption = $this->getEnumValues( 'News', 'category' );
        return view("dashboard.News.edit",['New'=>$New , 'enumoption'=>$enumoption]);
    
    }

    public function update(Request $request, News $New)
    {
        $rules=[
            'title'=>'required|string',
            'subTitle'=>'required|string',
            'description'=>'required|string',
            'likesNumber'=>'required|integer',
            'shareNumber'=>'required|integer',
            'shareLink'=>'required|string',
            'image' => 'image'
            ];
            
            $request_data = $request->all(); 
    
                if( $request->file('image') && $request->image != "default.png" ){
                    
                    if($New->image != "default.png"){                        
                        // Storage::disk("public_uploads")->delete('/News_images/'.$New->image);  
                        $OldName =  $New->image;
                        $this->deleteFromDir($OldName);
                    }
    
                $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // ->save(public_path('/uploads/News_images/'.$request->image->getClientOriginalName() ) );
                $request_data['image'] = $request->image->getClientOriginalName();
                
                $NewName = $request->image->getClientOriginalName();
                $file =  $request->file('image');
                $this->putInDir($file);
            
            }
    
            if($request->Date){
                $request_data['Date'] = date_format(new DateTime($request->Date), "Y-m-d h:i:s" );
            }else{
                $request_data['Date'] = $New->Date;
            }

            $validated = $request->validate($rules);
            $New ->update($request_data);

            $request->session()->flash('success', __('site.updated_successfully'));
            return redirect(route('dashboard.News.index'));
    }

    public function destroy(Request $request, News $New)
    {
        if($New->image != 'default.png'){
            $name =  $New->image;
            $this->deleteFromDir($name);

            // Storage::disk("public_uploads")->delete('/News_images/'.$New->image);  
        }
        $request->session()->flash('success', __('site.deleted_successfully'));
        $New->delete();
        return redirect(route('dashboard.News.index'));
    }

    // help functions
    public static function getEnumValues($table, $column) {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = [];
        foreach( explode(',', $matches[1]) as $index=>$value )
        {
          $v = trim( $value, "'" );
          $enum[$index] =  $v;
        }
        return $enum;
    }


    public static function putInDir($file){

        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));
    
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', 'News_images')
            ->first(); // There could be duplicate directory names!

        $filename = $file->getClientOriginalName();
        // $filePath = public_path('/uploads/News_images/'.$filename);
        // $fileData = \File::get($filePath);

        if ( ! $dir) {
            return 'Directory does not exist!';
        }        
        Storage::disk('google')->putFileAs($dir['path'] , $file , $filename);
    }

    public static function deleteFromDir($name){

        $filename = $name;
        $dir = '/1F5fFFquyS9qn54TNNf5b-ebyxwdK8ohy';
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
