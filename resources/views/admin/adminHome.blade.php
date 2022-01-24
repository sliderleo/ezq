<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/adminHome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
          <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
          <h1 class="font-medium text-xl banner-text">&nbsp;Admin Dashboard</h1>
          <div class="container mx-auto">
            <div class="space-y-4">
            {{-- User Stats --}}
            <div style="width: 10px"></div>
            <div class="w shadow stats">
              <div class="stat">
                <div class="stat-figure text-info">
                  <div class="avatar">
                    <div class="w-16 h-16 p-1 mask mask-squircle bg-base-100">
                      <img src="..\..\..\image\icon\admin.png" alt="Users Icon Image" class="mask mask-squircle">
                    </div>
                  </div>
                </div> 
                <div class="stat-value">Welcome</div> 
                <div class="stat-actions">
                  <div class="stat-title">Admin {{$admin[0]->name}}</div> 
                </div>
              </div>

              <div class="stat place-items-center place-content-center">
                <div class="stat-title">Total Sales Done</div> 
                <div class="stat-value">{{$salesCount}}</div> 
                <div class="stat-actions">
                  <a class="btn btn-sm btn-success" href="{{ route('admin.analytics')}}">To Analytics</a>
                </div>
              </div>
            </div>
          
            <div class="w-full shadow stats">
              <div class="stat">
                <div class="stat-figure text-info">
                  <div class="avatar">
                    <div class="w-16 h-16 p-1 mask mask-squircle bg-base-100">
                      <img src="..\..\..\image\icon\user.png" alt="Users Icon Image" class="mask mask-squircle">
                    </div>
                  </div>
                </div> 
                <div class="stat-title">EzQ User's Stats</div> 
                <div class="stat-actions">
                  <a class="btn btn-sm btn-success" href="{{ route('admin.users')}}">To User</a>
                </div>
              </div>

              <div class="stat place-items-center place-content-center">
                <div class="stat-title">Total User(s)</div> 
                <div class="stat-value">{{$userCount}}</div> 
                <div class="stat-desc">since the launch...</div>
              </div> 

              <div class="stat place-items-center place-content-center">
                <div class="stat-title">New User(s)</div> 
                <div class="stat-value text-success">{{$userNewCount}}</div>
                <div class="stat-desc">joined today!</div> 
              </div> 
            </div>

            <div class="w-full shadow stats">
              <div class="stat">
                <div class="stat-figure text-info">
                  <div class="avatar">
                    <div class="w-16 h-16 p-1 mask mask-squircle bg-base-100">
                      <img src="..\..\..\image\icon\vendor.png" alt="Vendor Icon Image" class="mask mask-squircle">
                    </div>
                  </div>
                </div> 
                <div class="stat-title">EzQ Vendor's Stats</div> 
                <div class="stat-actions">
                  <a class="btn btn-sm btn-success" href="{{ route('admin.vendors')}}">To Vendor</a>
                </div>
              </div>

              <div class="stat place-items-center place-content-center">
                <div class="stat-title">Total Vendor(s)</div> 
                <div class="stat-value">{{$vendorCount}}</div> 
                <div class="stat-desc">since the launch...</div>
              </div> 

              <div class="stat place-items-center place-content-center">
                <div class="stat-title">New Vendor(s)</div> 
                <div class="stat-value text-success">{{$vendorNewCount}}</div>
                <div class="stat-desc">joined today!</div> 
              </div> 
            </div>
          </div> 
          </div>
        </div>
         {{--End of container code  --}}
        {{-- Drawer code --}}
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
                url: '/store-status',
                data: {'status': status, 'id': user_id},
                success: function(data){
                  showToastr();
                }
            });
            window.location.reload();
        })
      })

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