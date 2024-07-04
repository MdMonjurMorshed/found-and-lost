<?php

use App\Events\MessageSentEvent;
use App\Events\MessageNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/send-message', function (Request $request) {
    
    $message = App\Models\MessageSent::find($request->message_id);
    $data =['user_id' => $request->user_id, 'message' => $request->message ];
    $existing_data = json_decode($message->messages,true);
    if (!is_array($existing_data)){
        $existing_data = [];
    }
    $existing_data[]=$data;
    $message->messages = json_encode($existing_data);
    if($request->user_id==$message->sender_id){
        $message->read_status = json_encode([
           "user" => $message->receiver_id,
           "read" => false
        ]);
    }else{
        $message->read_status = json_encode([
            "user" => $message->sender_id,
            "read" => false
         ]);
    }

    $message->save();

    
   
    broadcast(new MessageSentEvent($request->user_id,$request->message,$request->message_id))->toOthers();
    if(Auth::user()->id == $message->sender_id ){
        broadcast(new MessageNotification($message->receiver_id,$message->sender_id,$request->message,$message->id))->toOthers();
    }else{
        broadcast(new MessageNotification($message->sender_id,$message->receiver_id,$request->message,$message->id))->toOthers();
    }
    
    
   
    return ['status' => 'Message Sent!','message_id'=>$request->message_id,'message'=>$request->message];
});





Route::get('/', function () {
    if (Auth::guard('admin')->check() ||Auth::guard('web')->check())
    {
        return view('welcome');
    }
    return redirect(route('user.login'));
})->name('mainpage');

// Route::post('/broadcasting/auth', function () {
//     return Auth::guard('web')->user();
//  });






// Broadcast::routes(['middleware' => ['auth.guard:web']]);

require __DIR__.'/admin-route.php';
require __DIR__.'/admin-view.php';
require __DIR__.'/user-auth.php';
require __DIR__.'/user-view.php';
