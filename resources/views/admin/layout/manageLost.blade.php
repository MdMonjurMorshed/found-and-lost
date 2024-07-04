@extends('admin.layout.main')

@section('title','lost items manage')

@section('content-main')
<div class="lost-manage-container">
     @foreach($lostitems as $lostitem)
        <div class="manage-item-container" id="lost-{{$lostitem->id}}">
            <div class="manage-info">
                <img class="topic-image" src="{{asset($lostitem->image)}}"  alt="">
                <div class="manage-title" >
                    {{$lostitem->title}}
                </div>

            </div>
            <div class="manage-action">
                <a href="{{route('admin.lost.edit',['id'=>$lostitem->id])}}">
                    <div class="manage-edit">
                        <i class="fa fa-pencil"></i>
                    </div>
                </a>
                
                <div class="manage-delete" id="delete-lost-{{$lostitem->id}}">
                    <i class="fa fa-trash"></i>
                </div>
            </div>
            
        </div>
        <script>
            
            
            document.getElementById("delete-lost-{{$lostitem->id}}").addEventListener('click',(e)=>{
                let lostId = {{$lostitem->id}}
              
                axios.delete("{{route('admin.delete.lostitem',['id'=>$lostitem->id])}}").then(response=>{
                    document.getElementById(`lost-${lostId}`).remove()
                })
            })
        </script>
     @endforeach
</div> 
@endsection