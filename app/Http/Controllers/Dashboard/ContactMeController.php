<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactMe;

use App\Mail\MyMail;
use App\Models\replyMsg;

use Illuminate\Support\Facades\Paginator;


class ContactMeController extends Controller
{
    public function index(Request $request)
    {
        // $products=product::paginate(5);
        $ContactMe=ContactMe::all();

        if($request->search and $request->field){

            $ContactMe=ContactMe::where( $request->field , 'like' ,"%". $request->search . "%" )->latest()->paginate(5);
            }
            else {
            $ContactMe=ContactMe::paginate(5);
                }

                $fields= \DB::getSchemaBuilder()->getColumnListing("contact_mes");
                if (in_array("updated_at", $fields)) {
                    unset($fields[6],$fields[0] );
                  };

        return view('dashboard.ContactMe.index',['ContactMe'=>$ContactMe, "fields"=> $fields]);
    }

    public function reply(ContactMe $Message)
    {
        // $testimonials=testimonials::all();
        return view("dashboard.ContactMe.reply",['message'=>$Message]);
    
    }

    public function sent(Request $request ,ContactMe $Message)
    {
        $rules=[
            "title" => "required|string|max:50",
            'Message' => 'required|max:500|min:10'
            ];
            
            $request_data=$request->all(); 
            $validated = $request->validate($rules);

            $request_data['contact_me_id'] = $Message->id;
            
            $details=[
                'Name' => $Message->Name, 
                "title" => $request->title,
                'Message' => $request->Message
            ];
            
            $raplyMsg = replyMsg::Create($request_data);
            
            // \Mail::to($Message->Email)->send(new MyMail($details) );
            

            $request->session()->flash('success', __('site.updated_successfully'));
            return redirect(route('dashboard.ContactMe.index'));
    }

    public function repliedMsg(Request $request ,ContactMe $Msgs )
    {
        
        // $ContactMe=ContactMe::all();
        $Msgs1=collect($Msgs->replyMsg->all());
        
        // if($request->search and $request->field){
           
        
        //     // $result =  $result->where( $request->field , 'like' ,"%". $request->search . "%" )->all();
        //     $result =  $result->where( $request->field , 'like' ,"new msg" )->get();
        // }
        $fields= \DB::getSchemaBuilder()->getColumnListing("reply_msg");
        if (in_array("updated_at", $fields)) {
            unset($fields[0],$fields[1],$fields[5] );
        };
        
        // return($result);
        return view('dashboard.ContactMe.repliedMsg',['Msgs'=>$Msgs1 ,'ContactMe'=> $Msgs , "fields"=> $fields]);
    }


    public function Mail(replyMsg $replyMsg){

        $details=[
            'Name' => $replyMsg->ContactMe->Name,
            "title" => $replyMsg->title,
            'Message' => $replyMsg->Message
        ];

        return view("dashboard.ContactMe.mail",['details'=>$details]);
    }

    public function destroyReplyMsg(Request $request, replyMsg $replyMsg )
    {

        $replyMsg->delete();
        $request->session()->flash('success', __('site.deleted_successfully'));
        //  dd($product);
        return redirect(route('dashboard.ContactMe.repliedMsg',$replyMsg->contact_me_id ));
    }

    public function destroy(Request $request, ContactMe $Message )
    {

        $Message->delete();
        $request->session()->flash('success', __('site.deleted_successfully'));
        //  dd($product);
        return redirect(route('dashboard.ContactMe.index'));
    }
}
