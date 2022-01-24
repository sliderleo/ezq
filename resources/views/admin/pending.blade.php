<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/addBanner.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pending Request</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
          <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
          <h1 class="font-medium text-xl banner-text">&nbsp; Pending Requests</h1>
            <table class="table" id="table-to-refresh">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Store Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pending as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->store_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->contact}}</td>
                            <td><span class="inactive-text">Pending</span></td>
                            <td><a  class="btn btn-primary" href="{{url('admin/pending-page/'.$item->id)}}">VIEW</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
        </div>
         {{--End of container code  --}}
        {{-- Drawer code --}}
        @component('layouts.navBar')
        @endcomponent
    </div>
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>