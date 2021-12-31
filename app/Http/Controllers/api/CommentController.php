<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\comment;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{
    public function Photos()
    {
        $comment =comment::where("type" , "like" , "%Photo%")->get();
        return CommentResource::collection($comment);
    }
    public function Videos()
    {
        $comment =comment::where("type" , "like" , "%Video%")->get();
        return CommentResource::collection($comment);
    }
    public function Music()
    {
        $comment =comment::where("type" , "like" , "%Music%")->get();
        return CommentResource::collection($comment);
    }
    public function News()
    {
        $comment =comment::where("type" , "like" , "%News%")->get();
        return CommentResource::collection($comment);
    }
//photo
    public function addPhotoComment(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name" => "required|string|max:25",
            "message" => "required|string|max:250",
            'Number' => 'required|Integer',
            'color' => 'required|string|max:25',
        ]);
        $request_data = $request->all();
        $request_data['type']= 'Photo';
        $comment = comment::Create($request_data);

        if($validator->fails()){
            return ( response()->json(['error'=> $validator->errors()]) );
        }
        return response()->json(['Success'=>'Your comment added' , 'data'=> $comment]);
    }

    public function editPhotoComment(comment $comment, Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name" => "required|string|max:25",
            "message" => "required|string|max:250",
        ]);
        $request_data = $request->all();
        $comment->update($request_data);

        if($validator->fails()){
            return ( response()->json(['error'=> $validator->errors()]) );
        }
        return response()->json(['Success'=>'Your comment edited','data'=> $comment]);
    }
    public function deletePhotoComment(comment $comment)
    {
        $comment->delete();
        return response()->json(['Success'=>'Your comment deleted', ]);
    }
//video
    public function addVideoComment(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name" => "required|string|max:25",
            "message" => "required|string|max:250",
            'Number' => 'required|Integer',
            'color' => 'required|string|max:25',
        ]);
        $request_data = $request->all();
        $request_data['type']= 'Video';
        $comment = comment::Create($request_data);

        if($validator->fails()){
            return ( response()->json(['error'=> $validator->errors()]) );
        }
        return response()->json(['Success'=>'Your comment added','data'=> $comment]);
    }

    public function editVideoComment(comment $comment, Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name" => "required|string|max:25",
            "message" => "required|string|max:250",
        ]);
        $request_data = $request->all();
        $comment->update($request_data);

        if($validator->fails()){
            return ( response()->json(['error'=> $validator->errors()]) );
        }
        return response()->json(['Success'=>'Your comment edited','data'=> $comment ]);
    }
    public function deleteVideoComment(comment $comment)
    {
        $comment->delete();
        return response()->json(['Success'=>'Your comment deleted']);
    }
//Music
    public function addMusicComment(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name" => "required|string|max:25",
            "message" => "required|string|max:250",
            'Number' => 'required|Integer',
            'color' => 'required|string|max:25',
        ]);
        $request_data = $request->all();
        $request_data['type']= 'Music';
        $comment = comment::Create($request_data);

        if($validator->fails()){
            return ( response()->json(['error'=> $validator->errors()]) );
        }
        return response()->json(['Success'=>'Your comment added','data'=> $comment]);
    }

    public function editMusicComment(comment $comment, Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name" => "required|string|max:25",
            "message" => "required|string|max:250",
        ]);
        $request_data = $request->all();
        $comment->update($request_data);

        if($validator->fails()){
            return ( response()->json(['error'=> $validator->errors()]) );
        }
        return response()->json(['Success'=>'Your comment edited','data'=> $comment]);
    }
    public function deleteMusicComment(comment $comment)
    {
        $comment->delete();
        return response()->json(['Success'=>'Your comment deleted']);
    }
//News
    public function addNewsComment(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name" => "required|string|max:25",
            "message" => "required|string|max:250",
            'Number' => 'required|Integer',
            'color' => 'required|string|max:25',
        ]);
        $request_data = $request->all();
        $request_data['type']= 'News';
        $comment = comment::Create($request_data);

        if($validator->fails()){
            return ( response()->json(['error'=> $validator->errors()]) );
        }
        return response()->json(['Success'=>'Your comment added','data'=> $comment]);
    }

    public function editNewsComment(comment $comment, Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name" => "required|string|max:25",
            "message" => "required|string|max:250",
        ]);
        $request_data = $request->all();
        $comment->update($request_data);

        if($validator->fails()){
            return ( response()->json(['error'=> $validator->errors()]) );
        }
        return response()->json(['Success'=>'Your comment edited','data'=> $comment]);
    }
    public function deleteNewsComment(comment $comment)
    {
        $comment->delete();
        return response()->json(['Success'=>'Your comment deleted']);
    }
    // fake photos
    public function photoApi()
    {
        return response()->file(public_path('dashboard_files/MOCK_DATA.json'));
    }


}
