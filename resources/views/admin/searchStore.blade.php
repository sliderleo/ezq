<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/addBanner.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Store</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200  drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp;Search Store</h1> 
            <div class="container">
                <form method="post" action="{{url('/admin/store-search')}}" enctype="multipart/form-data" role="search">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Search by name or ID</span>
                        </label> 
                        <div class="relative">
                            <input type="text" placeholder="Search" class="w-full pr-16 input input-primary input-bordered" name="search" id="search" required> 
                            <button class="absolute top-0 right-0 rounded-l-none btn btn-primary" type="submit">Search</button>
                        </div>
                    </div> 
                    <div class="grid grid-flow-col justify-items-center">
                        @if(isset($message))
                                <span>{{$message}}</span>
                        @endif
                        @if(isset($store)) 
                        <table class="table" id="table-to-refresh">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Store Image</th>
                                    <th>Store Name</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($store as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>
                                            <img src="/image/store/{{$item->store_img}}" width="170px" alt="Image Here"/>
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td><p class="address-text">{{$item->address}}</p></td>
                                        <td>{{$item->contact}}</td>
                                        @if ($item->status === 1)
                                            <td><span class="active-text">Active</span></td>
                                        @elseif($item->status === 0)
                                            <td><span class="inactive-text">Inactive</span></td>
                                        @elseif($item->status === 2)
                                            <td><span class="inactive-text">Banned</span></td>
                                        @endif
                                        <td><a  class="btn btn-primary" href="{{url('admin/store-page/'.$item->id)}}">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </form>
            </div>
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