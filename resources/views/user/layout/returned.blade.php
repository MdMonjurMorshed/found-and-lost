@extends('user.layout.main')

@section('title','returned itmes')

@section('content-main')

<div class="search-container">
    <div class="search-bar">
      <input class="search-box" id="serch-item" type="search">
      <i class="fa fa-search"></i>
    </div>
 
</div>

<div class="found-container">
    <div class="row d-flex justify-content-center">
   
        <div class="col-9">
        <h4 class="" style=" padding:0px 0px 10px 0px;color: black;font-size:20px; display:flex;justify-content:center">Returned {{$item_count}} {{$item_count > 1? 'items' : 'item'}} to the rightful owner</h4>
        <div class="row g-4" id="return-grid">

            @foreach($return_items as $return_item)

            <div class="col-3 ">
                <div class="bg-white p-1">
                    <img style="width: 100%; height: 150px;" src="{{asset($return_item->image)}}" alt="">
                    <h6>{{$return_item->title}}</h6>
                    <div class="item-description">{{$return_item->description}}</div>
                    <div class="text-end">
                       <a href="{{route('user.return.details',['id'=>$return_item->id])}}"><small style="color: rgb(72, 72, 252)">See Details</small></a> 
                    </div>
                </div>
            </div>
            @endforeach
            
            
            
        </div>
    </div>
        

    </div>

</div>

@endsection