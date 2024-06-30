<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Home')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <!-- <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    /> -->


</head>

<body>
<script>
        // Check for the error message in the session and show SweetAlert
        @if (session('error'))
            Swal.fire({
                text: '{{ session('error') }}',
            });
            
        @endif
       
    var elements = document.getElementsByClassName('swal2-confirm')
    Array.from(elements).forEach((element) => {
                element.addEventListener('click', (e) => {
                    window.location.reload()
                });
            });

    </script>
    <div class="">
        <div class="top-nav">
            <nav class="text-white top-navbar-menu">
            <a href="{{route('user.mainpage')}}"><img class="company-logo" src="{{asset('img/company-logo-navbar.png')}}" alt=""></a>

                <div class="relative ml-3"> 
                    <div>
                        <button
                                type="button"
                                class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                                id="profile-btn"
                                onclick="on_click()"
                                >
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img
                                    class="h-16 w-16 rounded-full"
                                    src= "{{Auth::user()->image ? asset(Auth::user()->image) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}" 
                                    alt="none"
                                />
                        </button>
                    </div>
                        

                    <div
                        id="profile-dropdown"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hide"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="user-menu-button"
                        tabindex="-1"
                    >
                        <a
                        href="{{route('user.mylisting')}}"
                        class="block px-4 py-2 text-sm text-gray-700"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-0"
                        >My Listing</a
                        >
                        <a
                        href="{{route('user.chatboxuser')}}"
                        class="block px-4 py-2 text-sm text-gray-700"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-1"
                        >Chat Box</a
                        >
                        @if (Auth::check())
                        <a
                        href="{{route('user.edit.form',['id'=>Auth::user()->id])}}"
                        class="block px-4 py-2 text-sm text-gray-700"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-2"
                        >Edit Profile</a
                        >          
                        @endif
                        
                    </div>
                </div>      


                  

                


            </nav>
        </div>
        <div id="viewport" class="home-page">


            <!-- Sidebar -->
            <div id="sidebar">

                <ul class="nav">
                    <li class="list-item {{ request()->routeIs('user.profile') ? 'selected' : ''}} " onClick="selectItem(this)">
                        <a href="{{route('user.profile')}}">
                            Profile
                        </a>
                    </li>
                    <li class="list-item {{request()->routeIs('user.found')? 'selected' : ''}}" onClick="selectItem(this)">
                        <a href="{{route('user.found')}}">
                            Found Items
                        </a>
                    </li>
                    <li class="list-item {{request()->routeIs('user.lost')? 'selected' : ''}}" onClick="selectItem(this)">
                        <a href="{{route('user.lost')}}">
                            Lost Items
                        </a>
                    </li>
                    <li class="list-item {{request()->routeIs('user.returned')? 'selected':''}}" onClick="selectItem(this)">
                        <a href="{{route('user.returned')}}">
                            Returned Items
                        </a>
                    </li>
                    @include('category')
                    <li>

                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST">
                            @csrf
                             <button class="logout-btn" type="submit" onclick="logout()">logout</button>

                        </form>
                    </li>
                </ul>
            </div>

            <!-- main content  -->
            <!-- Dashboard -->
            @yield('content-main')
            <div id="shortcuts" style="display: none;">
                <h2>This is shortcuts</h2>
            </div>


            

        </div>
    </div>




   
        <script>
            document.getElementById('category-item').addEventListener('click', () => {
                let subCategory = document.getElementById('subcategory-list');
                if (subCategory.style.display === 'block') {
                    subCategory.style.display = 'none';
                } else {
                    subCategory.style.display = 'block';
                }
            });

            function selectItem(element){
                console.log('clicked')
            const item = document.querySelectorAll('.list-item');

                item.forEach(item=>{
                    item.classList.remove('selected');
                });
                element.classList.add('selected');
            }

            function logout(){
                window.location.reload();
            }

            function on_click(){
              document.getElementById('profile-dropdown').classList.toggle('hide')
            }

        </script>

        <script>
      
            document.getElementById('serch-item').addEventListener('keyup',(e)=>{
                var currentUrl = window.location.href;
                var input_value = document.getElementById('serch-item').value
                var url = "{{route('user.get.search')}}?search=" + input_value
                axios.get(url).then(response=>{
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
        

        
</body>

</html>
