@extends('user.layout.main')

@section('title','chat box user')

@section('content-main')

<div class="chatbox-user-container">
    
    @foreach($messages as $message)
    
    
        
    @foreach($users as $user)
        
           @if ($user->id==$message->sender_id && Auth::user()->id==$message->receiver_id)
           <div class="chat-box-user">
   

               <a href="{{route('user.chatbox',['message_id'=>$message->id])}}">
                  <img class="topic-image" src="{{$user->image? asset($user->image) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'}}" height="50px" width="50px" alt="">
                  <span class="chat-user-name">{{$user->name}}</span>
               </a>
           </div>




           @endif
           

           @if(Auth::user()->id==$message->sender_id && $user->id==$message->receiver_id )
           <div class="chat-box-user"> 
               <a href="{{route('user.chatbox',['message_id'=>$message->id])}}">
                  <img class="topic-image" src="{{$user->image? asset($user->image) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'}}" height="50px" width="50px" alt="">
                  <span class="chat-user-name">{{$user->name}}</span>
               </a>
            </div>
           @endif
           



           @endforeach
         
   

   

    @endforeach
    
    
    

</div>    

@endsection