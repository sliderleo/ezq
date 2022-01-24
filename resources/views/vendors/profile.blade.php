<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/bannerView.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @foreach ($vendor as $item)
    <title>Profile</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-content drawer-con">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">Profile</h1>    
            <div>
                <div class="card lg:card-side bordered">
                    <figure>
                        <div>
                            <img class="store-img" src="/image/icon/vendor.png"  alt="Image Here" 
                            style="height: 300px; 
                            width: 300px; 
                            position: relative;
                            display: inline-block;">
                          </div>
                    </figure> 
                    <div class="card-body">
                      <h2 class="card-title">{{$item->name}}</h2> 
                      <p>Username: &nbsp; {{$item->username}}</p>
                      <p>Email: &nbsp; {{$item->email}}</p> 
                      <p>Contact: &nbsp; {{$item->contact}}</p> 
                      @if ($item->status === 1)
                          <p>Status: &nbsp;<span class="active-text">Active</span></p>
                      @elseif($item->status === 0)
                          <p>Status: &nbsp;<span  class="inactive-text">Inactive</span></p>
                      @elseif($item->status === 2)
                          <p>Status: &nbsp;<span  class="inactive-text">Banned</span></p>
                      @endif
                    </div>
                </div> 
            </div>
        </div>

    @component('layouts.navBarV')
    @endcomponent
    </div>
    @endforeach
    <script></script>
    {!! Toastr::message() !!}
    {{ \TawkTo::widgetCode() }}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>

