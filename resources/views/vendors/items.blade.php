<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/banner.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Store Items</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp;Items</h1> 
            <div class="container mx-auto">
                @if($store!=null)
                    <div class="grid grid-flow-col grid-cols-3 gap-9 justify-items-center">
                        <a href="{{ route('vendor.itemsV')}}">
                            <div class="card shadow-lg bg-base-100 hover:bg-base-300">
                                <div class="card-body ">
                                    <img class="card-img " src="..\..\..\image\icon\items.png"/>
                                    <h2 class="card-title">All Items</h2> 
                                </div>
                            </div> 
                        </a>
                        <a href="{{ route('vendor.addItem')}}">
                            <div class="card shadow-lg bg-base-100 hover:bg-base-300 justify-self-center">
                                <div class="card-body">
                                    <img class="card-img" src="..\..\..\image\icon\plus.png"/>
                                    <h2 class="card-title">Add Items</h2> 
                                </div>
                            </div> 
                        </a>
                        <a href="{{route('vendor.itemsX')}}">
                            <div class="card shadow-lg bg-base-100 hover:bg-base-300 justify-self-center">
                                <div class="card-body">
                                    <img class="card-img" src="..\..\..\image\icon\items-bnw.png"/>
                                    <h2 class="card-title">Inactive Items</h2> 
                                </div>
                            </div> 
                        </a>
                    </div>
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
            
        </div> 
        {{-- Drawer code --}}
        @component('layouts.navBarV')
        @endcomponent
      </div>
      {{ \TawkTo::widgetCode() }}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>