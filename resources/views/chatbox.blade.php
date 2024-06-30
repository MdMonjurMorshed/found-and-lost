@extends('user.layout.main')

@section('title','message')

@section('content-main')

<div class="chatbox-container" id="chatbox" >
    <div class="chat-box-header">
       
        <div class="receiver-info">
          @if (Auth::user()->id == $receiver->id )
          <div class="user-prof-photo">

          <img class="profile-image" src="{{$sender->image ? asset($sender->image) : asset('img/profile.png') }}" height="20px" width="auto" alt="">
          </div>
          <div class="user-name">
            {{$sender->name}}
          </div>
          @else
          <div class="user-prof-photo">

            <img class="profile-image" src="{{$receiver->image ? asset($receiver->image) : asset('img/profile.png') }}" height="20px" width="auto" alt="">
          </div>
          <div class="user-name">
               {{$receiver->name}}
          </div>
          @endif
          
        </div>
        <div class="verify-btn-container">
          @csrf
               <!-- for claim -->
                 @if ($claim)
                  @if($claim->user_id !== Auth::user()->id)
                  <button onclick="button_click()"
                  class="verify-btn">verify claimer</button>

                  <ul class=" verify-menu hide" id="verify-option" aria-labelledby="dropdownMenuButton1">
                    <li><a href="{{route('user.claim.update',['claim_id'=>$claim->id])}}"><span class="dropdown-item" id="verify-claim" >Yes</span></a></li>
                    <li><span class="dropdown-item" id="no" >No</span></li>
                   
                  </ul>
                  @endif
                 @endif

                 <!-- for report -->
                 @if ($report)
                  @if($report->user_id !== Auth::user()->id)
                  <button onclick="button_click()"
                  class="verify-btn">verify reporter</button>

                  <ul class=" verify-menu hide" id="verify-option" aria-labelledby="dropdownMenuButton1">
                    <li><a href="{{route('user.reporter.verify',['report_id'=>$report->id])}}"><span class="dropdown-item" id="verify-report" >Yes</span></a></li>
                    <li><span class="dropdown-item" id="no" >No</span></li>
                   
                  </ul>
                  @endif
                 @endif
                 
                
                
            

        </div>
        
       
      

    </div>


    <div class="message-topic">
      <img class="topic-image" src="{{asset($topic['image'])}}" height="50px" width="50px" alt="">
      <h4 class="d-flex justify-content-center" style="display:flex;justify-content:center;align-items:center ;padding-left:10px">{{$topic['title']}}</h4>

    </div>

    <div class="db-message" id="message-box">
    @if ($messages)
    @foreach($messages as $user_message)
        @if($user_message['user_id'] == Auth::user()->id)
        <div class="outgoing-chats">
                            
                            <div class="outgoing-msg">
                                <div class="outgoing-chats-msg">
                                    <p >{{ $user_message['message'] }}</p>
                                    
                                </div>
                            </div>
                        </div>


        @else
        <div class="received-chats">
                           
                            <div class="received-msg">
                                <div class="received-msg-inbox">
                                    <p>{{ $user_message['message'] }}</p>
                                </div>
                            </div>
                        </div>


        @endif
    @endforeach
    @endif
    
      
    </div>


  </div>
  <form class="chat-form" action="" id="message-form">
    <!-- <input class="text-box" id="submited-message" type="text">
    <button class="send-btn">send</button> -->
      <div class="input-group mb-3">
        <input type="text" id="message" class=" text-box" placeholder="Write your message here" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="send-btn" id="message-button"  type="submit">send</button>
        </div>
      </div>
  </form>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>    
<script>
 function button_click(){
  document.getElementById('verify-option').classList.toggle('hide')
 }
 
</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatBox = document.getElementById('chatbox');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message');

            // Function to scroll to the bottom
            function scrollToBottom() {
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            // Scroll to the bottom initially
            scrollToBottom();

            // Handle form submission
            messageForm.addEventListener('submit', function(event) {
                event.preventDefault();

                // Get the message input value
                const messageText = messageInput.value.trim();
                if (messageText === '') return;

                // Create the new message element
                const newMessage = document.createElement('div');
                newMessage.classList.add('outgoing-chats');
               
                newMessage.innerHTML = `
                    <div class="outgoing-msg">
                        <div class="outgoing-chats-msg">
                            <p class="multi-msg">${messageText}</p>
                        </div>
                    </div>
                `;
                console.log(newMessage)
                // Append the new message to the chat box
                document.getElementById('message-box').appendChild(newMessage);
                
                const message = document.getElementById('message').value;
                // console.log({{$message->id}})
                axios.post('/send-message', {
                    user_id: {{Auth::guard('web')->user()->id}},
                    message: message,
                    message_id: {{$message->id}}
                    
                }).then(response => {
                    console.log(response.data);
                    
                });
                // Clear the input field
                messageInput.value = '';

                // Scroll to the bottom
                scrollToBottom();
            });
        });
    </script>
<script>
  
            Pusher.logToConsole = true;

            const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                wsHost: window.location.hostname,
                wsPort: 6001,
                wssPort: 6001,
                forceTLS: false,
                enabledTransports: ['ws', 'wss']
            });

            const echo = new Echo({
                broadcaster: 'pusher',
                key: '{{ env('PUSHER_APP_KEY') }}',
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                wsHost: window.location.hostname,
                wsPort: 6001,
                wssPort: 6001,
                forceTLS: false,
                disableStats: true,
                enabledTransports: ['ws', 'wss']
            });
            console.log('this is echo',echo)
            echo.private('chat.{{$message->id}}')
            .listen('MessageSentEvent', function(e){
              const chatBox = document.getElementById('chatbox');
              function scrollToBottom() {
                chatBox.scrollTop = chatBox.scrollHeight;
               }
               scrollToBottom();
              const newMessage = document.createElement('div');
                newMessage.classList.add('received-chats');
               
                newMessage.innerHTML = `
                    <div class="received-msg">
                        <div class="received-msg-inbox">
                            <p >${e.message}</p>
                        </div>
                    </div>
                `;

                document.getElementById('message-box').appendChild(newMessage);
                // console.log('message getting')
                // console.log(e.message)
                // // console.log(e.)
                // const messageElement = document.createElement('li');
                // messageElement.textContent = `${e.user.name}: ${e.message.message}`;
                // document.getElementById('messages').appendChild(messageElement);


                scrollToBottom();
            });

            
        </script>

        <!-- update claim and report status -->
        <script>
      
          


          document.getElementById('no').addEventListener('click',()=>{
            button_click()
          })
        </script>



            
          
          



@endsection