<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/bs5-toast/dist/bs5-toast.js"></script>
</head>

<body>
<script>
        // Check for the error message in the session and show SweetAlert
        @if (session('error'))
            Swal.fire({
                text: '{{ session('error') }}',
            });
        @endif
    </script>

    <div class="admin-login-page">
        <div style="width: 400px; margin: auto; background-color: white; padding: 20px;">
            <div class="text-dark text-center">
                <img class="company-logo" src="{{asset('img/company-logo.png')}}" alt="">
            </div>
            <form action="{{route('admin.post.register')}}" class="text-dark" method="POST" >
                 @csrf 
                 
                <div class="mb-4">
                    <label for="name" class="ms-3">Name</label>
                    <input type="text" class="input-feild" name="name" id="name"
                        aria-describedby="textHelp">
                </div>

                <div class="mb-4">
                    <label for="email" class="ms-3">Email</label>
                    <input type="email" name="email" class="input-feild" id="email"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                    <label for="code" class="ms-3">Admin Code</label>
                    <input type="code" name="code" class="input-feild" id="code"
                        aria-describedby="textHelp">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="ms-3">Password</label>
                    <input type="password" name="password" class="input-feild" id="password"
                        aria-describedby="passswordHelp">
                </div>
                <div>
                    <label for="confirmed-password" class="ms-3">Confirmed Password</label>
                    <input type="password" name="confirm_password" class="input-feild" id="confirmed-password"
                        aria-describedby="passswordHelp">
                </div>
                <div>
                    <ul>
                        <li>Password should be at least 8 characters including 1 capital letter, 1 small letter, 1 number and 1 special character</li>
                    </ul>
                    
                </div>
                <div style="display: flex; justify-content: center; align-items: center; margin-top: 40px;">
                    
                    <button class="login-btn" type="submit">Register</button>
                </div>
                <div class="text-center mt-5">
                    <p style="color: rgb(72, 72, 252);">already have acoount? <a href="{{route('admin.login')}}">Log-In</a></p>
                    
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>