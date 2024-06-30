<Html>
<li class="category-item list-item" id="category-item" onClick="selectItem(this)">
                        <span id="dynamicLink" >
                            Categories
</span>
                        <div id="subcategory-list" class="subcategory-list ms-4 hide">
                        @foreach($categories as $category)
                            <form id="subcat" action="" method="GET">
                                    

                                    <button class="logout-btn" id="cat-search" type="submit" >{{$category->name}} </button>
                                    @if(Auth::guard('admin')->check())
                                    
                                      
                                            <i class="fa fa-trash" type="button" id="category-{{$category->id}}" aria-hidden="true" style="color:red"></i>
                                       
                                    
                                    @endif
                                    
                            </form>
                            <script>
                                document.getElementById('category-{{$category->id}}').addEventListener('click',(e)=>{
                                    e.preventDefault();
                                        let id='category-{{$category->id}}'
                                        console.log(e.target.parentElement)
                                        
                                    axios.delete("{{route('admin.category.delete',['id'=>$category->id])}}").then(response =>{
                                        e.target.parentElement.remove()
                                    })
                                    
                                })

                                document.getElementById('dynamicLink').addEventListener('click',(e)=>{
                                    document.getElementById('subcategory-list').classListToggle('hide')
                                })
                            </script>
                            <script>
                                 document.getElementById('subcat').addEventListener('submit',(e)=>{
                                        e.preventDefault()
                                     var currentUrl = window.location.href;
                                     let category = document.getElementById('cat-search').textContent
                                     axios.get("{{route('user.get.catsearch',['cat_name'=>$category->name])}}").then(response=>{
                                         var founditems = response.data.founditems
                                         var lostitems = response.data.lostitems
                                         var returnitems = response.data.returnitems
                                         if (currentUrl.includes('/user/dashboard')) {
                                            console.log('in dashboaed')
                                           document.getElementById('found-grid').innerHTML=''
                                           document.getElementById('lost-grid').innerHTML=''

                                           founditems.forEach(found=>{
                                            href_url_found="{{route('user.found.details',':id')}}".replace(':id',found.id)
                                            img_found = "{{asset(':path')}}".replace(':path',found.image)

                                            document.getElementById('found-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_found}" alt="">
                                <h6>${found.title}</h6>
                                <div class="item-description">${found.description}</div>
                                <div class="text-end">
                                    <a href="${href_url_found}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`
                                           })

                            lostitems.forEach(lost=>{

                                href_url_lost="{{route('user.lost.details',':id')}}".replace(':id',lost.id)
                                img_lost = "{{asset(':path')}}".replace(':path',lost.image)

                                document.getElementById('lost-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_lost}" alt="">
                                <h6>${lost.title}</h6>
                                <div class="item-description">${lost.description}</div>
                                <div class="text-end">
                                    <a href="${href_url_lost}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`

                            })
                                           
                        }   
                        
                        
                        if (currentUrl.includes("/user/found-items")){
                            document.getElementById('found-grid').innerHTML=''
                            founditems.forEach(found=>{
                                href_url_found="{{route('user.found.details',':id')}}".replace(':id',found.id)
                                img_found = "{{asset(':path')}}".replace(':path',found.image)
                                document.getElementById('found-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_found}" alt="">
                                <h6>${found.title}</h6>
                                <div class="item-description">${found.description}</div>
                                <div class="text-end">
                                    <a href="${href_url_found}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`

                            })


                        }

                        if (currentUrl.includes("/user/lost-items")){
                            document.getElementById('lost-grid').innerHTML=''
                            lostitems.forEach(lost=>{
                                href_url_lost="{{route('user.lost.details',':id')}}".replace(':id',lost.id)
                                img_lost = "{{asset(':path')}}".replace(':path',lost.image)
                                document.getElementById('lost-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_lost}" alt="">
                                <h6>${lost.title}</h6>
                                <div class="item-description">${lost.description}</div>
                                <div class="text-end">
                                    <a href="${href_url_lost}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`

                            })


                        }

                        if(currentUrl.includes('/user/returned-items')){
                            document.getElementById('return-grid').innerHTML=''
                            returnitems.forEach(return_item=>{
                                href_url_return="{{route('user.return.details',':id')}}".replace(':id',return_item.id)
                                img_return = "{{asset(':path')}}".replace(':path',return_item.image)

                                document.getElementById('return-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_return}" alt="">
                                <h6>${return_item.title}</h6>
                                <div class="item-description">${return_item.description}</div>
                                <div class="text-end">
                                    <a href="${href_url_return}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`

                            })

                        }
                        
                        })
                                        

                                         })
                                    
                            </script>

                        @if(Auth::guard('admin')->check())

                        <script>
                                 document.getElementById('subcat').addEventListener('submit',(e)=>{
                                        e.preventDefault()
                                     var currentUrl = window.location.href;
                                     let category = document.getElementById('cat-search').textContent
                                     axios.get("{{route('admin.get.catsearch',['cat_name'=>$category->name])}}").then(response=>{
                                         var founditems = response.data.founditems
                                         var lostitems = response.data.lostitems
                                         var returnitems = response.data.returnitems
                                         if (currentUrl.includes('/admin/dashboard')) {
                                            console.log('in dashboaed')
                                           document.getElementById('found-grid').innerHTML=''
                                           document.getElementById('lost-grid').innerHTML=''

                                           founditems.forEach(found=>{
                                            href_url_found="{{route('admin.found.details',':id')}}".replace(':id',found.id)
                                            img_found = "{{asset(':path')}}".replace(':path',found.image)

                                            document.getElementById('found-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_found}" alt="">
                                <h6>${found.title}</h6>
                                <div class="item-description">${found.description}</div>
                                <div class="text-end">
                                    <a href="${href_url_found}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`
                                           })

                            lostitems.forEach(lost=>{

                                href_url_lost="{{route('admin.lost.details',':id')}}".replace(':id',lost.id)
                                img_lost = "{{asset(':path')}}".replace(':path',lost.image)

                                document.getElementById('lost-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_lost}" alt="">
                                <h6>${lost.title}</h6>
                                <div class="item-description">${lost.description}</div>
                                <div class="text-end">
                                    <a href="${href_url_lost}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`

                            })
                                           
                        }   
                        
                        
                        if (currentUrl.includes("/admin/found-items")){
                            document.getElementById('found-grid').innerHTML=''
                            founditems.forEach(found=>{
                                href_url_found="{{route('admin.found.details',':id')}}".replace(':id',found.id)
                                img_found = "{{asset(':path')}}".replace(':path',found.image)
                                document.getElementById('found-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_found}" alt="">
                                <h6>${found.title}</h6>
                                <div class="item-description">${found.description}</div>
                                <div class="text-end">
                                    <a href="${href_url_found}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`

                            })


                        }

                        if (currentUrl.includes("/admin/lost-items")){
                            document.getElementById('lost-grid').innerHTML=''
                            lostitems.forEach(lost=>{
                                href_url_lost="{{route('admin.lost.details',':id')}}".replace(':id',lost.id)
                                img_lost = "{{asset(':path')}}".replace(':path',lost.image)
                                document.getElementById('lost-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_lost}" alt="">
                                <h6>${lost.title}</h6>
                                <div class="item-description">${lost.description}</div>
                                <div class="text-end">
                                    <a href="${href_url_lost}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`

                            })


                        }

                        if(currentUrl.includes('/admin/returned-items')){
                            document.getElementById('return-grid').innerHTML=''
                            returnitems.forEach(return_item=>{
                                href_url_return="{{route('admin.get.returned.details',':id')}}".replace(':id',return_item.id)
                                img_return = "{{asset(':path')}}".replace(':path',return_item.image)

                                document.getElementById('return-grid').innerHTML+=`<div class="col-3 ">
                            <div class="bg-white p-1">
                                <img style="width: 100%; height: 150px;" src="${img_return}" alt="">
                                <h6>${return_item.title}</h6>
                                <div class="item-description">${return_item.description}</div>
                                <div class="text-end">
                                    <small class="card-delete" id="return-${return_item.id}"  type="button"><i class="fa fa-trash"></i></small>
                                    <a href="${href_url_return}"><small style="color: rgb(72, 72, 252)">See Details</small></a>
                                </div>
                            </div>
                        </div>`

                            })

                        }
                        
                        })
                                        

                                         })
                                    
                            </script>
                             
                        @endif    
                        @endforeach
                        </div>
</li>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            var currentUrl = window.location.href; // Get the current URL from the address bar
            var linkElement = document.getElementById('subcat'); // Get the <a> tag by its ID

            // Optionally, add query parameters if needed
            var queryParams = new URLSearchParams(window.location.search);
            queryParams.set('category', '');

            // Set the href attribute of the <a> tag
            linkElement.action = currentUrl.split('?')[0] + '?' + queryParams.toString();
        });
        
       

    </script>
@if(Auth::guard('admin')->check())
 
<li class="category-item list-item" id="category-item" onClick="selectItem(this)">

    <form action="{{route('admin.create.category')}}" method="POST">
        @csrf
        <div class="container">
            <div class="row d-flex justify-content-spacearound">
                <div class="col-sm-1 add-cat-but-holder">
                    <button class="add-cat-but" type="submit"  >add category</button>
                </div>
                <div class="col-sm-9 category-input-holder">
                    <input type="text" class="category-add" name="category" placeholder="add cat.." >
                </div>
            </div>
        </div>
        

    </form>
   
    


</li>

@endif

</Html>