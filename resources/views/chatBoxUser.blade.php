@extends('user.layout.main')

@section('title','chat box user')

@section('content-main')

<div class="chatbox-user-container">
    
    @foreach($messages as $message)
    
    @php
    $data = json_decode($message->topic,true)
    @endphp

        
    @foreach($users as $user)
        
           @if ($user->id==$message->sender_id && Auth::user()->id==$message->receiver_id)
           <div class="chat-box-user" id="chat-user-{{$message->id}}">
   

               <a href="{{route('user.chatbox',['message_id'=>$message->id])}}">
                  <img class="topic-image" src="{{$user->image? asset($user->image) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'}}" height="50px" width="50px" alt="">
                  <img class="topic-image" src="{{asset($data['image'])}}" alt="none">
                  <span class="chat-user-name">{{$user->name}}</span>
                  <div class=" red-dot-chat-box hide " id="red-dot-{{$message->id}}"></div>
               </a>
           </div>




           @endif
           

           @if(Auth::user()->id==$message->sender_id && $user->id==$message->receiver_id )
           <div class="chat-box-user" id="chat-user-{{$message->id}}" > 
               <a href="{{route('user.chatbox',['message_id'=>$message->id])}}">
                  <img class="topic-image" src="{{$user->image? asset($user->image) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'}}" height="50px" width="50px" alt="">
                  <img class="topic-image" src="{{asset($data['image'])}}" alt="none">
                  <span class="chat-user-name">{{$user->name}}</span>
                  <div class=" red-dot-chat-box hide  " id="red-dot-{{$message->id}}"></div>
               </a>
            </div>
           @endif
           

          <script>
            document.getElementById("chat-user-{{$message->id}}").addEventListener('click',(e)=>{
                axios.put("{{route('user.put.readstatus',['message_id'=>$message->id])}}").then(response=>{
                    
                })
            })
          </script>

           @endforeach
         
   

   

    @endforeach
    
    
    

</div>    

@endsection