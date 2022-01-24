@include('sweetalert::alert')

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
    <title>Inactive Items</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-content drawer-con">
        <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
        <h1 class="font-medium text-xl banner-text">&nbsp;All Items</h1>  
      <table class="table" id="table-to-refresh">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Price (RM)</th>
                  <th>Barcode</th>
                  <th>View</th>
                  <th>Delete</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($items as $item)
                  <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->name}}</td>
                      <td>
                        <img class="item-img" src="/image/pic_items/{{$item->item_img}}" width="120px" height="120px" alt="Image Here"/>
                        </td>
                      <td>{{$item->c_name}}</td>
                      @if ($item->status === 1)
                          <td><span class="active-text">Active</span></td>
                      @elseif($item->status === 0)
                          <td><span class="inactive-text">Inactive</span></td>
                      @elseif($item->status === 2)
                          <td><span class="inactive-text">Banned</span></td>
                      @endif
                      <td>{{$item->price}}</td>
                      <td>{{$item->barcode}}</td>
                      <td><a  class="btn btn-primary" href="{{url('vendor/item-page/'.$item->id)}}">View</a></td>
                      <td><a  class="btn btn-error" href="{{url('vendor/item-page/'.$item->id)}}">Delete</a></td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      {{$items->links()}}
    </div>
    
    @component('layouts.navBarV')
    @endcomponent
    </div>
    <script>
    </script>
    {!! Toastr::message() !!}
    {{ \TawkTo::widgetCode() }}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>

