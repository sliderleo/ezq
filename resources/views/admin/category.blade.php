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
    <title>Category</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp;Category</h1> 
            <div class="container mx-auto">
                <div class="grid grid-flow-col grid-cols-2 gap-9 justify-items-center">
                    <a href="{{ route('admin.categoryV')}}">
                        <div class="card shadow-lg bg-base-100 hover:bg-base-300">
                            <div class="card-body ">
                                <img class="card-img " src="..\..\..\image\icon\categories.png"/>
                                <h2 class="card-title">All Categories</h2> 
                            </div>
                        </div> 
                    </a>
                    <a href="{{ route('admin.categoryA')}}">
                        <div class="card shadow-lg bg-base-100 hover:bg-base-300 justify-self-center">
                            <div class="card-body">
                                <img class="card-img" src="..\..\..\image\icon\categories.png"/>
                                <h2 class="card-title">Add Category</h2> 
                            </div>
                        </div> 
                    </a>
                </div>
            </div>
            
        </div> 
        {{-- Drawer code --}}
        @component('layouts.navBar')
        @endcomponent
      </div>
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>