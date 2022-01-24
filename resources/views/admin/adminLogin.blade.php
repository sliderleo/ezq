<!DOCTYPE html>
<html class="admin-login-body" lang="en" data-theme="light">
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
    <title>EZQ Login</title>
</head>
<body>
    <div class="admin-login-con grid grid-cols-1 gap-5">
      <div class="justify-items-center admin-login-text">
        <span class="app-name-text">Ez Queue</span>
      </div>
        <div class="admin-login-left-con container justify-self-auto">
            <h1 class="admin-login-h1">ADMIN LOGIN</h1>
            <form action="{{route('admin.validate')}}" class="admin-login-form" method="POST">
              @csrf
                <div class="space-y-4 justify-items-center">
                    <div class="flow-root">
                      <div class="my-4 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                              <span class="label-text">Username</span>
                            </label> 
                            <input type="text" placeholder="username" name="username" id="username" class="input input-bordered" required>
                          </div>
                      </div>
                    </div>
                    <div class="flow-root ...">
                      <div class="my-4 ...">
                        <div class="form-control">
                            <label class="label">
                              <span class="label-text">Password</span>
                            </label> 
                            <input type="password" placeholder="password" name="password" id="password" class="input input-bordered" required>
                          </div>
                      </div>
                    </div>

                    <div class="flow-root">
                        <div class="my-4 grid">
                            <button class="btn btn-primary">login</button> 
                        </div>
                      </div>
                  </div>
            </form>
        </div>
    </div>

    {!! Toastr::message() !!}
    <script src="{{asset('js/app.js')}}" defer></script>
</body>
</html>