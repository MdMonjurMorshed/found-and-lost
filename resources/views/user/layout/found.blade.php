@extends('user.layout.main')

@section('title','found items')

@section('content-main')
<div class="search-container">
    <div class="search-bar">
      <input class="search-box" id="serch-item" type="search">
      <i class="fa fa-search"></i>
    </div>
 
</div>

<div class="found-container">
    <div class="row">
        <div class="col-3 ">
            <div class="post-found">
                <a href="{{route('user.post.found')}}">Post a Found Item</a>
            </div>

        
        </div>
        <div class="col-9">
            <h4 class="p-2" style="color: black;font-size:20px; display:flex;justify-content:center">Found Items on Campus</h4>
        <div class="row g-4 " id="found-grid">
            @if ($founditems->isNotEmpty())
               @foreach($founditems as $founditem)
                    <div class="col-3 ">
                        <div class="bg-white p-1">
                            <img style="width: 100%; height: 150px;" src="{{asset($founditem->image)}}" alt="">
                            <h6>{{$founditem->title}}</h6>
                            <div class="item-description">{{$founditem->description}}</div>
                            
                            <div class="text-end">
                               <a href="{{route('user.found.details',['id'=>$founditem->id])}}"><small style="color: rgb(72, 72, 252)">See Details</small></a> 
                            </div>
                        </div>
                    </div>
                   
               @endforeach
            @else
            <h4>No found items</h4>
            @endif
            
        </div>
    </div>
        

</div>



@endsection