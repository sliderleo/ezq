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
    @foreach ($store as $item)
    <title>{{$item->name}}</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-content drawer-con">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp; {{$item->name}}</h1>    
            <div>
                <div class="card lg:card-side bordered">
                    <figure>
                      <img class="store-img" src="/image/store/{{$item->store_img}}"  alt="Image Here" style="height: 300px; width: 300px;">
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
                      <div class="card-actions">
                        <a  class="btn btn-error" href="{{url('admin/store-ban/'.$item->id)}}">Ban</a>
                      </div>
                    </div>
                  </div> 
            </div>

            <div class="spacer"><h1 class="font-medium text-xl banner-text">&nbsp;Store Items</h1></div>
            
            <div>
              @if ($items)
                <table class="table" id="table-to-refresh">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Item Image</th>
                          <th>Name</th>
                          <th>Desc</th>
                          <th>Category</th>
                          <th>Barcode</th>
                          <th>Price</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($items as $item)
                          <tr>
                              <td>{{$item->id}}</td>
                              <td>
                                  <img src="/image/pic_items/{{$item->item_img}}" width="170px" alt="Image Here"/>
                              </td>
                              <td>{{$item->name}}</td>
                              <td><p>{{$item->desc}}</p></td>
                              <td>{{$item->category}}</td>
                              <td>{{$item->barcode}}</td>
                              <td>{{$item->price}}</td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
              @endif
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

