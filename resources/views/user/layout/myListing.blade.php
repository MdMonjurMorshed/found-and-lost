@extends('user.layout.main')

@section('title','my listing')

@section('content-main')
<div class="found-container">
    <div class="row">
        
        <div class="col-9">
            <h4 style="color: black;font-size:20px;padding:5px 0px 20px 0px; display:flex;justify-content:center">Found Items </h4>
            <div class="row g-4">
            
        
            @if ($founditems->isNotEmpty())
              @foreach($founditems as $founditem)
                <div class="col-3 " id="founditem-{{$founditem->id}}">
                    <div class="bg-white p-1">
                        <img style="width: 100%; height: 150px;" src="{{asset($founditem->image)}}" alt="">
                        <h6>{{$founditem->title}}</h6>
                        <p>{{$founditem->description}}</p>
                        <div class="text-end">
                        <small class="card-delete" id="myfound-{{$founditem->id}}"  type="button"><i class="fa fa-trash"></i></small>
                           <a href="{{route('user.found.details',['id'=>$founditem->id])}}"><small style="color: rgb(72, 72, 252)">See Details</small></a> 
                        </div>
                    </div>
                </div>
               <script>
                    document.getElementById("myfound-{{$founditem->id}}").addEventListener('click',(e)=>{
                               let foundId = {{$founditem->id}}
                               axios.delete("{{route('user.delete.mylisting',['id'=>$founditem->id])}}").then(response=>{
                                document.getElementById(`founditem-${foundId}`).remove()
                               })
                            })

               </script>
              @endforeach
            @else
               <h5>No data found</h5>
            @endif   
        
</div>  
            
        </div>
    </div>
        

    

</div>


<!-- Lost container -->
<div class="found-container">
    <div class="row">
       
        <div class="col-9">
            <h4 style="color: black;font-size:20px;padding:5px 0px 20px 0px; display:flex;justify-content:center">Lost Items</h4>
            <div class="row g-4">
                @if ($lostitems->isNotEmpty())
                    @foreach($lostitems as $lostitem)
                        <div class="col-3 " id="lostitem-{{$lostitem->id}}">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="{{asset($lostitem->image)}}" alt="">
                                <h6>{{$lostitem->title}}</h6>
                                <p>{{$lostitem->description}}</p>
                                <div class="text-end">
                                <small class="card-delete" id="mylost-{{$lostitem->id}}"  type="button"><i class="fa fa-trash"></i></small>
                                    <a href="{{route('user.lost.details',['id'=>$lostitem->id])}}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>  
                            </div>
                        </div>
                        <script>
                            document.getElementById("mylost-{{$lostitem->id}}").addEventListener('click',(e)=>{
                               let lostId = {{$lostitem->id}}
                               axios.delete("{{route('user.delete.mylisting',['id'=>$lostitem->id])}}").then(response=>{
                                document.getElementById(`lostitem-${lostId}`).remove()
                               })
                            })
                        </script>
                    @endforeach
                    @else
                    <h5>No data found</h5>
                    @endif 
            </div>
        
        </div>
        

    </div>

</div>

@endsection