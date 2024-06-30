@extends('admin.layout.main')

@section('title','returned item details')

@section('content-main')
<div class="post-found-container">
    <div class="col-12">
        <h4 class="p-2" style="color: black;font-size:20px; display:flex;justify-content:center">Return Item Details</h4>
        
            <div class="row ">
                    <div class="col-6  ">
                        <div class="user-photo">
                            <img style="width: 100%; height:100%;" src="{{asset($returnitem->image)}}" alt="">

                        </div>
                        <div>
                            <label class="">Posted By</label>
                            <div class="chat-box-user">
                                <img class="topic-image" src="{{$return_by['user_photo']? asset($return_by['user_photo']) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'}}" height="50px" width="50px" alt="">
                                <span class="chat-user-name">{{$return_by['user_name']}}</span>

                            </div> 
                        </div>

                        <div>
                            <label class="">Return To</label>
                            <div class="chat-box-user">
                                <img class="topic-image" src="{{$return_to['user_photo']? asset($return_to['user_photo']) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'}}" height="50px" width="50px" alt="">
                                <span class="chat-user-name">{{$return_to['user_name']}}</span>

                            </div> 
                        </div>
                          

                        
                       
                        
                    </div>
                    <div class="col-6">
                        <div class="user-info mt-4">
                            
                            <div class="row user-input-info">
                                <input type="text" class="input-feild " name="title" id="name" value="{{$returnitem->title}}"  aria-describedby="textHelp">
                               
                            </div>
                            <div class="row user-input-info">
                                <input type="text" class="input-feild" name="date" id="name" value="{{$returnitem->date}}"  aria-describedby="textHelp">
                            </div>
                            <div class="row user-input-info">
                                <input type="text" class="input-feild" name="location" id="name" value="{{$returnitem->place}}"  aria-describedby="textHelp">
                            </div>
                            
                            <div class="row user-input-info">
                                <textarea  rows="6" name="description"  cols="20" class="user-about" >{{$returnitem->description}}</textarea>
                            </div>
                            
                            <div class=" category-holder ">
                                <label for="category" class="">category</label>
                                <div>
                                    <select name="category" id="category-select">
                                       <option value="{{$returnitem->category}}">{{$returnitem->category}}</option>
                                    </select>  
                                </div>
                                
                            </div>
                            
                            

                        </div>
                        
                        


                        
                    </div>
            </div>
        
        
    </div>

</div>

@endsection