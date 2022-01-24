<!DOCTYPE html>
<html class="vendor-login-body" lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>EZQ Register</title>
</head>
<body>
    <div class="admin-login-con grid grid-cols-1 gap-5">
        <div class="justify-items-center admin-login-text">
          <span class="app-name-text">Ez Queue</span>
        </div>
    <div class="container mx-auto vendor-register-con shadow bg-base-100">
        <form class="regsiter-form"  action="/vendor/register" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="vendor-register-h1">Join Us Now!</h1>
            @if ($errors->any())
            <div class="grid grid-flow-row justify-items-center">
                @foreach ($errors->all() as $err)
                    <li class="error-li">{{$err}}</li>
                @endforeach
            </div>
            @endif
            
            <div class="grid grid-flow-col gap-9 justify-items-center">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label> 
                    <input type="text" placeholder="Username" id="username" name="username" class="input input-bordered" minlength="4" maxlength="20" required>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label> 
                    <input type="text" placeholder="Name" id="name" name="name" class="input input-bordered"  minlength="4" maxlength="30" required>
                </div>
            </div>

            <div class="grid grid-flow-col gap-9 justify-items-center">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label> 
                    <input type="password" placeholder="Password" id="password" name="password" class="input input-bordered"  minlength="8" maxlength="50" required>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Confirm Password</span>
                    </label> 
                    <input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" class="input input-bordered"  minlength="8" maxlength="50"  required>
                </div>
            </div>

            <div class="grid grid-flow-col gap-9 justify-items-center">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label> 
                    <input type="email" placeholder="Email" id="email" name="email" class="input input-bordered" required>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">NRIC</span>
                    </label> 
                    <input type="text" placeholder="NRIC" id="nric" name="nric" class="input input-bordered"  minlength="12" maxlength="12"  required>
                </div>
            </div>

            <div class="grid grid-flow-col gap-9 justify-items-center">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Contact</span>
                    </label> 
                    <input type="text" placeholder="Your Contact" id="contact" name="contact" class="input input-bordered" minlength="10" maxlength="11" required>
                </div>
            </div>
            <div class="spacer"></div>
            <div class="grid grid-flow-col  justify-items-center">
                <button class="btn btn-success" type="submit">Register</button>
            </div>
        </form>
    </div>
    </div>
    {!! Toastr::message() !!}
    <script src="{{asset('js/app.js')}}" defer></script>
</body>
</html>