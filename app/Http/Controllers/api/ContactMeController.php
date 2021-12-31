<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContactMe;

class ContactMeController extends Controller
{
    public function SentMessage(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "Name" => "required|string|max:25",
            "phoneNumber" => "required|numeric|digits_between:9,20",
            'email' => 'max:50|email:rfc,dns',
            'Message' => 'required|max:500|min:10',
        ]);
        $request_data = $request->all();
        $ContactMe = ContactMe::Create($request_data);


        if($validator->fails()){
            return ( response()->json(['error'=> $validator->errors()]) );
        }

        return response()->json(['Sucsess'=>'Thanks For Your Message , I will Contact You Soon']);
    }
}
