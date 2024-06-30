@extends('admin.layout.main')

@section('title','found items manage')

@section('content-main')
<div class="found-manage-container">
     @foreach($founditems as $founditem)
        <div class="manage-item-container" id="found-{{$founditem->id}}">
            <div class="manage-info">
                <img class="topic-image" src="{{asset($founditem->image)}}" height="80px" width="100px" alt="">
                <div class="manage-title" >
                    {{$founditem->title}}
                </div>

            </div>
            <div class="manage-action">
                <a href="{{route('admin.found.edit',['id'=>$founditem->id])}}">
                    <div class="manage-edit">
                        <i class="fa fa-pencil"></i>
                    </div>
                </a>
                
                <div class="manage-delete" id="delete-found-{{$founditem->id}}">
                    <i class="fa fa-trash"></i>
                </div>
            </div>
            
        </div>
        <script>
            
            
            document.getElementById("delete-found-{{$founditem->id}}").addEventListener('click',(e)=>{
                let foundId = {{$founditem->id}}
                axios.delete("{{route('admin.delete.found',['id'=>$founditem->id])}}").then(response=>{
                    document.getElementById(`found-${foundId}`).remove()
                })
            })
        </script>
     @endforeach
</div> 
@endsection