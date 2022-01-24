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
    <title>All Store</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-content drawer-con">
        <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
        <h1 class="font-medium text-xl banner-text">&nbsp;All Store</h1>    
        @if(isset($store))
        <table class="table" id="table-to-refresh">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Store Image</th>
                  <th>Store Name</th>
                  <th>Vendor Name</th>
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
                      <td><a href="{{url('admin/store-page/'.$item->id)}}">{{$item->name}}</a></td>
                      <td>{{$item->vendor_name}}</td>
                      <td><p class="address-text">{{$item->address}}</p></td>
                      <td>{{$item->contact}}</td>
                      @if ($item->status === 1)
                          <td><span class="active-text">Active</span></td>
                      @elseif($item->status === 0)
                          <td><span class="inactive-text">Inactive</span></td>
                      @elseif($item->status === 2)
                          <td><span class="inactive-text">Banned</span></td>
                      @endif
                      <td><a  class="btn btn-error" href="{{url('admin/store-ban/'.$item->id)}}">Ban</a></td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      {{$store->links()}}
      @endif
    </div>
    
    @component('layouts.navBar')
    @endcomponent
    </div>
      <template id="my-template">
        <swal-title>
          Status Updated!
        </swal-title>
        <swal-icon type="success" color="green"></swal-icon>
        <swal-button type="confirm">
          OK
        </swal-button>
        <swal-param name="allowEscapeKey" value="false" />
        <swal-param
          name="customClass"
          value='{ "popup": "my-popup" }' />
      </template>
    <script>
      
     
    </script>
    {!! Toastr::message() !!}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>

