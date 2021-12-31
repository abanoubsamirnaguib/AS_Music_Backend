<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\Models\comment;
use Illuminate\Support\Facades\DB;
use DateTime;


class CommentController extends Controller
{
    public function index(Request $request)
    {
        // $products=product::paginate(5);
        $comments=comment::all();

        if ($request->search  or $request->type ){            
            $comments=comment::when($request->search , function($query) use ($request)  {           
                return   $query->where("name" , 'like' ,"%". $request->search . "%")->orWhere("message" , 'like' ,"%". $request->search . "%");
            })->When($request->type , function($query) use ($request)  {          
                    return   $query->where("type" , '=' , $request->type);
                    })   
                    ->latest()->paginate(15);
                }
            else {
            $comments=comment::latest()->paginate(15);
                }

          $enumoption = $this->getEnumValues( 'comments', 'type' );
        //   dd($comments);
                // return (($categories));
        return view('dashboard.comments.index',['comments'=>$comments ,'enumoption'=>$enumoption ]);
    }

    public function create()
    {
        // $comment=comment::all();
        $enumoption = $this->getEnumValues( 'comments', 'type' );
        return view('dashboard.comments.create',['enumoption'=>$enumoption]);
    }

    public function store(Request $request)
    {
        $rules=[
        'name'=>'required|string',
        'message'=>'required|string',
        'Number'=>'required|integer',
        'color'=>'required|string',
        ];
        
        $request_data=$request->all(); 
        // dd($request_data);
        if($request->created_at){
            $request_data['created_at'] = date_format(new DateTime($request->created_at) , "Y-m-d h:i:s");
        }else{
            $request_data['created_at'] =  new DateTime("now", new \DateTimeZone('Africa/Cairo') );
            // dd($request_data['Date']);
        }
        $validated = $request->validate($rules);

        $comment = comment::Create ($request_data);
            
        $request->session()->flash('success', __('site.added_successfully'));
        return redirect(route('dashboard.comments.index'));
    }

    public function edit(comment $comment)
    {
        // $comment=comment::all();
        $enumoption = $this->getEnumValues( 'comments', 'type' );
        return view("dashboard.comments.edit",['comment'=>$comment , 'enumoption'=>$enumoption]);
    }

    public function update(Request $request, comment $comment)
    {
        $rules=[
            'name'=>'required|string',
            'message'=>'required|string',
            'Number'=>'required|integer',
            'color'=>'required|string',
            ];
            
            $request_data = $request->all(); 

            if($request->created_at){
                $request_data['created_at'] = date_format(new DateTime($request->created_at) , "Y-m-d h:i:s");
            }else{
                $request_data['created_at'] = date_format($comment->created_at, "Y-m-d h:i:s");
                // dd($request_data['Date']);
            }
            // dd($request_data);
            $validated = $request->validate($rules);
            $comment ->update($request_data);

            $request->session()->flash('success', __('site.updated_successfully'));
            return redirect(route('dashboard.comments.index'));
    }

    public function destroy(Request $request, comment $comment)
    {
        $request->session()->flash('success', __('site.deleted_successfully'));
        $comment->delete();
        return redirect(route('dashboard.comments.index'));
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
}
