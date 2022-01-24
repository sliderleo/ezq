<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/addBanner.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Category</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp;Add Category</h1> 
           
            <div class="container mx-auto">
                <form method="post" action="/admin/addcategory" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                    <div class="grid grid-flow-row justify-items-center">
                        @foreach ($errors->all() as $err)
                            <li class="error-li">{{$err}}</li>
                        @endforeach
                    </div>
                    @endif
                    <div class="spacer"></div>

                    <div class="grid grid-flow-col grid-cols-2 gap-9 justify-items-center">
                        <input class="input input-bordered" type="text" name="name" id="name" placeholder="category" required/>
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
                    
                    
                </form>
            </div>
            
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        </div> 
        {{-- Drawer code --}}
        @component('layouts.navBar')
        @endcomponent
      </div>
      {!! Toastr::message() !!}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>