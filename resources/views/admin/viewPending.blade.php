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
    @foreach ($pending as $item)
    <title>Pending Request</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-300 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-content drawer-con">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp; Pending Request from {{$item->vendor_name}} for {{$item->store_name}}</h1>    

            <div class="container mx-auto">
                <form method="post" action="/admin/addbanner" enctype="multipart/form-data">
                    <div class="grid grid-flow-col grid-cols-3 gap-9 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                            <span class="label-text">Store Name</span>
                            </label> 
                            <input type="text" placeholder="username" disabled="disabled" class="input input-bordered" value="{{$item->store_name}}">
                        </div>

                        <div class="form-control">
                            <label class="label">
                            <span class="label-text">Vendor Name</span>
                            </label> 
                            <input type="text" placeholder="username" disabled="disabled" class="input input-bordered" value="{{$item->vendor_name}}">
                        </div>

                        <div class="form-control">
                            <label class="label">
                            <span class="label-text ">Status</span>
                            </label> 
                            @if ($item->status === 0)
                                <input type="text" placeholder="username" disabled="disabled" class="input input-bordered" value="Pending">
                            @elseif ($item->status === 2)
                                <input type="text" placeholder="username" disabled="disabled" class="input input-bordered" value="Rejected">
                            @else 
                                <input type="text" placeholder="username" disabled="disabled" class="input input-bordered" value="Approved">
                            @endif
                            
                        </div>
                    </div>

                    <div class="grid grid-flow-col">
                       &nbsp;
                    </div>

                    <div class="grid grid-flow-col grid-cols-2 gap-9 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                              <span class="label-text">Desc</span>
                            </label> 
                            <textarea class="textarea h-24 textarea-bordered" placeholder="Disabled" disabled="disabled" >{{$item->desc}}</textarea>
                        </div>
                          

                        <div class="form-control">
                            <label class="label">
                              <span class="label-text">Address</span>
                            </label> 
                            <textarea class="textarea h-24 textarea-bordered" placeholder="Disabled" disabled="disabled" >{{$item->address}}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-flow-col">
                        &nbsp;
                    </div>
 
                     <div class="grid grid-flow-col grid-cols-2 gap-9 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                            <span class="label-text ">Contact</span>
                            </label> 
                            <input type="text" placeholder="username" disabled="disabled" class="input input-bordered" value="{{$item->contact}}">
                        </div>
                           
 
                        <div class="form-control">
                            <label class="label">
                            <span class="label-text ">Email</span>
                            </label> 
                            <input type="text" placeholder="username" disabled="disabled" class="input input-bordered" value="{{$item->email}}">
                        </div>
                    </div>

                    <div class="grid grid-flow-col">
                        &nbsp;
                    </div>

                    <div class="grid grid-flow-col justify-items-center">
                        <a  href="{{url('admin/pending-approve/'.$item->id)}}" class="btn btn-success">APPROVE</a> 
                        <a href="{{url('admin/pending-reject/'.$item->id)}}" class="btn btn-error">REJECT</a> 
                    </div>
                </form>
            </div>
        </div>

    @component('layouts.navBar')
    @endcomponent
    </div>
    @endforeach
    <script></script>
    {!! Toastr::message() !!}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>

