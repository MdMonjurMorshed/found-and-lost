@extends('user.layout.main')

@section('title','found item details')

@section('content-main')

<div class="post-found-container">
    <div class="col-12">
        <h4 class="p-2" style="color: black;font-size:20px; display:flex;justify-content:center">Found Item Details</h4>
        
            <div class="row ">
                    <div class="col-6  ">
                        <div class="user-photo">
                            <img style="width: 100%; height:100%;" src="{{asset($founditem->image)}}" alt="">

                        </div>
                       
                        
                    </div>
                    <div class="col-6">
                        <div class="user-info mt-4">
                            
                            <div class="row user-input-info">
                                <input type="text" class="input-feild " name="title" id="name" value="{{$founditem->title}}"  aria-describedby="textHelp">
                               
                            </div>
                            <div class="row user-input-info">
                                <input type="text" class="input-feild" name="date" id="name" value="{{$founditem->found_date}}"  aria-describedby="textHelp">
                            </div>
                            <div class="row user-input-info">
                                <input type="text" class="input-feild" name="location" id="name" value="{{$founditem->location}}"  aria-describedby="textHelp">
                            </div>
                            
                            <div class="row user-input-info">
                                <textarea  rows="6" name="description"  cols="20" class="user-about" >{{$founditem->description}}</textarea>
                            </div>
                            
                            <div class=" category-holder ">
                                <label for="category" class="">category</label>
                                <div>
                                    <select name="category" id="category-select">
                                       <option value="{{$founditem->category}}">{{$founditem->category}}</option>
                                    </select>  
                                </div>
                                
                            </div>
                            
                            

                        </div>
                        @if ($founditem->user_id != Auth::user()->id)
                        <form action="{{route('user.claimitem',['founditem'=>$founditem])}}" id="claim-form"  method="GET">
                                 @csrf
                                 
                                <button class="post-found-btn" type="submit" >Claim Item</button>

                           

                        

                        </form>
                        <!-- <a href="{{route('user.claimitem',['founditem'=>$founditem])}}">
                            <p class="post-found-btn"  >Claim Item</p>
                        </a> -->
                        @else
                        <form action="{{route('user.item.return',['founditem'=>$founditem])}}" id="return-claim-form"  method="GET">
                                
                                 
                                <button class="post-found-btn" type="submit" >Return This Item</button>

                        </form>

                        @endif


                        
                    </div>
            </div>
        
        
    </div>

</div>

<script>
    
</script>

@endsection