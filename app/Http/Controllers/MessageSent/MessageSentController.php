<?php

namespace App\Http\Controllers\MessageSent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\MessageSent;
use App\Models\Claim;
use App\Models\Report;
use App\Models\Category;
use App\Models\User;



class MessageSentController extends Controller
{
  public function send_message(Message $message,User $user){

  }

  public function get_user_message($id){

      // $message = MessageSent::where('sender_id',$user_sender->id)->where('receiver_id',$user_receiver->id)->first();
      
      // dd($user_message);
      $message = MessageSent::find($id);
      $user_message = json_decode($message->messages,true);
      $user_receiver = User::find($message->receiver_id);
      $user_sender = User::find($message->sender_id);
      $topic = json_decode($message->topic,true);
      // dd($user_sender);
      $claim = Claim::find($message->claim_id);
      $report = Report::find($message->report_id);
      $categories = Category::all();
      // dd($message);
      return view('chatbox',['message'=>$message,'claim'=>$claim,'report'=>$report,'categories'=>$categories,'receiver'=>$user_receiver,'sender'=>$user_sender ,'messages'=>$user_message,'topic'=>$topic]);
    
  }

  public function chat_box_user(Request $request){
    // dd($request->user()->id);
    $sender = MessageSent::where('receiver_id',$request->user()->id)->pluck('sender_id')->toArray();
    // dd($sender);
    $receiver = MessageSent::where('sender_id',$request->user()->id )
                    ->pluck('receiver_id')
                    ->toArray();

    $all_ids = array_unique(array_merge($sender, $receiver));
    // dd($all_ids);                
    $messages = MessageSent::where('receiver_id',$request->user()->id)->orWhere('sender_id',$request->user()->id)->get();
    
    $users = User::whereIn('id',$all_ids)->get();
    $categories = Category::all();
    
    // dd($messages);
    return view('chatBoxUser',['messages'=>$messages,'users'=>$users,'categories'=>$categories  ]);
  }

  public function message_status(){
    $messages = MessageSent::where('sender_id',Auth::id())->orWhere('receiver_id',Auth::id())->get();
    $process_message = [];
    for($i=0;$i<count($messages);$i++){
      $message = $messages[$i];
      $read_status = json_decode($message->read_status,true);
      if ($read_status['user']==Auth::id() & !$read_status['read'] ){
          $process_message [] =[
            'message_id'=> $message->id,
            'user' => $read_status['user'] ,
            'status' => $read_status['read']

          ];
      }
    }

    return $process_message;
  }
}
