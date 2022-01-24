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
   
    <title>Your Store</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-content drawer-con">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label>
            @if($store!=null)
                @foreach ($store as $item) 
                <h1 class="font-medium text-xl banner-text">{{$item->name}}</h1>    
                <div>
                    <div class="card lg:card-side bordered">
                        <figure>
                            <div>
                                <img class="store-img" src="/image/store/{{$item->store_img}}"  alt="Image Here" 
                                style="height: 300px; 
                                width: 300px; 
                                position: relative;
                                display: inline-block;">
                                <a class="btn glass"  href="{{url('vendor/store-image-edit/'.$item->id)}}" style="position: absolute; z-index:5; left:0;">Edit</a>
                            </div>
                        </figure> 
                        <div class="card-body">
                        <h2 class="card-title">{{$item->name}}</h2> 
                        <p>Owner: &nbsp; {{$item->vendor_name}}</p>
                        <p>Address: &nbsp; {{$item->address}}</p> 
                        <p>Contact: &nbsp; {{$item->contact}}</p> 
                        @if ($item->status === 1)
                            <p>Status: &nbsp;<span class="active-text">Active</span></p>
                        @elseif($item->status === 0)
                            <p>Status: &nbsp;<span  class="inactive-text">Inactive</span></p>
                        @elseif($item->status === 2)
                            <p>Status: &nbsp;<span  class="inactive-text">Banned</span></p>
                        @endif
                        <input type="checkbox" data-id="{{$item->id}}" class="toggle toggle-primary" {{ $item->status ? 'checked' : '' }}>
                        <div class="card-actions">
                            <a  class="btn btn-primary" href="{{url('vendor/store-edit/'.$item->id)}}">Edit Info</a>
                        </div>
                        </div>
                    </div> 
                    
                    <div class="container mx-auto">
                        <h1 class="font-medium text-xl banner-text">Store QR Code</h1>
                        <div class="w-full shadow stats">
                            <div class="stat">
                                <div class="stat-title">Description</div> 
                                <div class="stat-desc">
                                    <p>This is your store QR code.</p>
                                    <p>Please display this at the entrance of the store/shop.</p>
                                    <p>Customer are require to scan the QR code to check in.</p>
                                </div>
                            </div>

                            <div class="stat place-items-center place-content-center">
                                <img src="data:image/png;base64, 
                                {!! base64_encode(QrCode::format('png')
                                ->merge('https://i.imgur.com/u8wuTdW.png', .4, true)
                                ->size(230)
                                ->eye('circle')
                                ->errorCorrection('H')
                                ->generate($id) )!!}">
                            </div> 
            
                            <div class="stat place-items-center place-content-center">
                                <a class="btn btn-sm btn-success" href="{{url('vendor/generate-pdf/'.$item->id)}}">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif 
            
            
            @if($store==null)
            <h1 class="font-medium text-xl banner-text">Seems like you haven't setup your store.....</h1>
            <div class="container mx-auto">
                <div class="w shadow stats">
                    <div class="stat">
                      <div class="stat-figure text-info">
                        <div class="avatar">
                          <div class="w-16 h-16 p-1 mask mask-squircle bg-base-100">
                            <img src="..\..\..\image\icon\store.png" alt="Users Icon Image" class="mask mask-squircle">
                          </div>
                        </div>
                      </div> 
                      <div class="stat-title">Click here to setup !! &nbsp;&nbsp;&nbsp;</div> 
                      <div class="stat-actions">
                        <a class="btn btn-sm btn-success" href="{{ route('vendor.setupStore')}}">Setup</a>
                      </div>
                    </div>
                  </div>
            </div>    
            @endif
        </div>

    @component('layouts.navBarV')
    @endcomponent
    </div>
    
    <script></script>
    {{ \TawkTo::widgetCode() }}
    {!! Toastr::message() !!}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>

