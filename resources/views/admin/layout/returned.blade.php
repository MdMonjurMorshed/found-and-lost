@extends('admin.layout.main')

@section('title','returned itmes')

@section('content-main')

<div class="search-container">
    <div class="search-bar">
      <input class="search-box" id="search-item" type="search">
      <i class="fa fa-search"></i>
    </div>
 
</div>

<div class="found-container">
    <div class="row d-flex justify-content-center">
   
        <div class="col-9">
        <h1 class="p-2" style="color: black;font-size:20px; display:flex;justify-content:center">Returned {{$item_count}} {{$item_count > 1? 'items' : 'item'}} to the rightfull owner</h1>
        <div class="row g-4" id="return-grid">
        @foreach($returneditems as $returneditem)

        <div class="col-3 " id="returnitem-{{$returneditem->id}}">
            <div class="bg-white p-1">
                <img style="width: 100%; height: 150px;" src="{{asset($returneditem->image)}}" alt="">
                <h6>{{$returneditem->title}}</h6>
                <div class="item-description">{{$returneditem->description}}</div>
                
                    
                <div class="text-end">
                <small class="card-delete" id="return-{{$returneditem->id}}"  type="button"><i class="fa fa-trash"></i></small>
                <a href="{{route('admin.get.returned.details',['id'=>$returneditem->id])}}"><small style="color: rgb(72, 72, 252)">See Details</small></a> 
                </div>
            </div>
        </div>
        <script>
             document.getElementById('return-{{$returneditem->id}}').addEventListener('click',(e)=>{
                let returnId = {{$returneditem->id}}
                axios.delete("{{route('admin.delete.returnitem',['id'=>$returneditem->id])}}").then(resposne=>{
                    document.getElementById(`returnitem-${returnId}`).remove()
                    window.location.reload()
                })
             })
        </script>
        @endforeach
            
        </div>
    </div>
        

    </div>

</div>

@endsection