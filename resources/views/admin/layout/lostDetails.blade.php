@extends('admin.layout.main')

@section('title','lost item details')

@section('content-main')

<div class="post-found-container">
    <div class="col-12">
        <h4 class="p-2" style="color: black;font-size:20px; display:flex;justify-content:center">Lost Item Details</h4>
        
            <div class="row ">
                    <div class="col-6  ">
                        <div class="user-photo">
                            <img style="width: 100%; height:100%;" src="{{asset($lostitem->image)}}" alt="">

                        </div>
                       
                        
                    </div>
                    <div class="col-6">
                        <div class="user-info mt-4">
                            
                            <div class="row user-input-info">
                                <input type="text" class="input-feild " name="title" id="name" value="{{$lostitem->title}}"  aria-describedby="textHelp">
                               
                            </div>
                            <div class="row user-input-info">
                                <input type="text" class="input-feild" name="date" id="name" value="{{$lostitem->found_date}}"  aria-describedby="textHelp">
                            </div>
                            <div class="row user-input-info">
                                <input type="text" class="input-feild" name="location" id="name" value="{{$lostitem->location}}"  aria-describedby="textHelp">
                            </div>
                            
                            <div class="row user-input-info">
                                <textarea  rows="6" name="description"  cols="20" class="user-about" >{{$lostitem->description}}</textarea>
                            </div>
                            
                            <div class=" category-holder ">
                                <label for="category" class="">category</label>
                                <div>
                                    <select name="category" id="category-select">
                                       <option value="{{$lostitem->category}}">{{$lostitem->category}}</option>
                                    </select>  
                                </div>
                                
                            </div>
                            
                            

                        </div>
                        

                        
                    </div>
            </div>
        
        
    </div>

</div>

@endsection