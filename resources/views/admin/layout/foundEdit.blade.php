@extends('admin.layout.main')

@section('title','edit found item')

@section('content-main')

<div class="post-found-container">
    <div class="col-12">
        <h4 class="p-2" style="color: black;font-size:20px; display:flex;justify-content:center">Edit Found Item</h4>
        <form action="{{route('admin.put.found',['id'=>$founditem->id])}}" method="POST" enctype="multipart/form-data">
            
           @method('PUT')
           @csrf
            <div class="row ">
                    <div class="col-6  ">
                        <div class="user-photo">
                            <img style="width: 100%; height:100%;" src="{{asset($founditem->image)}}" alt="">

                        </div>
                        <div class="image-field">
                            <label class="required-field">image</label>
                            <div>
                                    <input type="file" id="input-field" class="input-field" name="image" >
                                    <input type="text" name="custom file" id="found-file-field" class="found-file-field" placeholder="choose file"  readonly>
                                    <ul id="file-list" class="file-list"></ul>
                            </div>

                        </div>
                        
                    </div>
                    <div class="col-6">
                        <div class="user-info mt-4">
                            
                            <div class="row user-input-info">
                                <input type="text" class="input-feild " name="title" id="name" value="{{$founditem->title}}" placeholder="enter title" aria-describedby="textHelp">
                               
                            </div>
                            <div class="row user-input-info">
                                <input type="text" class="input-feild" name="date" id="name" value="{{$founditem->found_date}}" placeholder="found date(yyyy-mm-dd)" aria-describedby="textHelp">
                            </div>
                            <div class="row user-input-info">
                                <input type="text" class="input-feild" name="location" id="name" value="{{$founditem->location}}" placeholder="location" aria-describedby="textHelp">
                            </div>
                            
                            <div class="row user-input-info">
                                <textarea  rows="6" name="description" placeholder="enter description" cols="20" class="user-about" >{{$founditem->description}}</textarea>
                            </div>
                            
                            <div class=" category-holder ">
                                <label for="category" class="required-field">category</label>
                                <div>
                                    <select name="category" id="category-select">
                                        <option value="{{$founditem->category}}">{{$founditem->category}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->name}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>  
                                </div>
                                
                            </div>
                            
                            

                        </div>
                        <div class="post-found-btn-holder">
                            <button class="post-found-btn" type="submit">Save</button>

                        </div>

                        
                    </div>
            </div>

        </form>
        
        
    </div>

</div>
<script>
        // Get the file input and text input elements
        const fileInput = document.getElementById('input-field');
        const textField = document.getElementById('found-file-field');
        const fileList = document.getElementById('file-list');

        // Add click event listener to the text field to trigger file input click
        textField.addEventListener('click', function() {
            fileInput.click();
        });

        // Update the text field when a file is chosen
        fileInput.addEventListener('change', function() {
            const files = fileInput.files;
            if (files.length > 0) {
                textField.value = files.length + " file(s) chosen";
                fileList.innerHTML = '';
                for (let i = 0; i < files.length; i++) {
                    const li = document.createElement('li');
                    li.textContent = files[i].name;
                    fileList.appendChild(li);
                }
            } else {
                textField.value = 'No files chosen';
                fileList.innerHTML = '';
            }
        });
    </script>

@endsection