@include('sweetalert::alert')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Banner List</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-content drawer-con">
        <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
        <h1 class="font-medium text-xl banner-text">&nbsp;All Banners</h1> 
        @if(isset($banner)) 
        <table class="table" id="table-to-refresh">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Banner Image</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>Edit</th>
                  <th>Delete</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($banner as $item)
                  <tr>
                      <td>{{$item->id}}</td>
                      <td>
                          <img src="/image/banner/{{$item->banner_img}}" width="170px" alt="Image Here"/>
                      </td>
                      
                      @if ($item->status === 1)
                          <td><span class="active-text">Active</span></td>
                          <td><input type="checkbox" data-id="{{$item->id}}" class="toggle toggle-primary" {{ $item->status ? 'checked' : '' }}></td>
                      @else
                          <td><span class="inactive-text">Inactive</span></td>
                          <td><input type="checkbox" data-id="{{$item->id}}" class="toggle toggle-primary" {{ $item->status ? 'checked' : '' }} ></td>
                      @endif
                      
                      <td><a  class="btn btn-info" href="{{url('admin/banner-edit/'.$item->id)}}">Edit</a></td>
                      <td><a  class="btn btn-error" href="{{url('admin/banner-delete/'.$item->id)}}">Delete</a></td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      {{$banner->links()}}
      @endif
    </div>
    @component('layouts.navBar')
    @endcomponent
  </div>
    <script>
      $(function() {
        $('.toggle-primary').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/banner-status',
                data: {'status': status, 'id': user_id},
                success: function(data){
                  showToastr();
                }
            });
            window.location.reload();
        })
      })

      function saveVoucher() {
        Swal.fire({
        icon: "success",
        text: "Status Updated!",
        timer: 3000,
        confirmButtonText: "OK!", 
      }, function(){
       
      });
      setTimeout(function() {
        window.location.reload();
      }, 2000);
    }

    function showToastr(){
      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr["success"]("-")
    }
    </script>
    {!! Toastr::message() !!}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
      
</html>

