@extends('user.layout.main')
@section('title','user profile')

@section('content-main')

<div class="profile-container">
    <div class="col-12">
        <h4 class="p-2" style="color: black;font-size:20px; display:flex;justify-content:center">User Profile</h4>
        @if(Auth::check())
        <div class="row ">
                <div class="col-6  ">
                    <div class="user-photo">
                        <img style="width: 100%; height:100%;" src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('img/profile.png')}}" alt="">

                    </div>
                   
                </div>
                <div class="col-6">
                    <div class="user-info mt-4">
                        
                        <div class="row user-input-info">
                            <input type="text" class="input-feild" name="name" id="name" value="{{Auth::user()->name}}" aria-describedby="textHelp">
                        </div>
                        <div class="row user-input-info">
                            <input type="text" class="input-feild" name="name" id="name" value="{{Auth::user()->email}}" aria-describedby="textHelp">
                        </div>
                        <div class="row user-input-info">
                            <input type="text" class="input-feild" name="name" id="name" value="{{Auth::user()->phone_number}}" aria-describedby="textHelp">
                        </div>
                        
                        <div class="row user-input-info">
                            <textarea name="large_text" rows="6" cols="20" class="user-about" >{{Auth::user()->about}}</textarea>
                        </div>

                    </div>

                    
                </div>
                
        </div>
        @endif

        
        
    </div>

</div>


@endsection