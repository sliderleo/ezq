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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
          <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
          <h1 class="font-medium text-xl banner-text">&nbsp;Analytics</h1>
          <div class="container mx-auto">
            <div class="spacer"></div>

            @if (!$store->isEmpty())
              <div class="w-full shadow stats">
                <div class="stat">
                  <div class="stat-figure text-info">
                    <div class="avatar">
                      <div class="w-16 h-16 p-1 mask mask-squircle bg-base-100">
                        <img src="..\..\..\image\icon\sales.png" alt="Users Icon Image" class="mask mask-squircle">
                      </div>
                    </div>
                  </div> 
                  <div class="stat-value">Sales</div>
                  <div class="stat-desc"><p>Remember to generate your sales report </p><p>by the end of every month!</p></div> 
                </div>

                <div class="stat place-items-center place-content-center">
                  <div class="stat place-items-center place-content-center">
                    <div class="stat-title">New sale(s)</div> 
                    <div class="stat-value text-success">{{$receiptCount}}</div> 
                    <div class="stat-desc">made today!!</div>
                    <div class="stat-actions">
                        <a  href="{{ route('vendor.todayS')}}" class="btn btn-sm btn-success">CHECK NOW</a>
                      </div>
                  </div>
                </div>

                <div class="stat place-items-center place-content-center">
                  <div class="stat place-items-center place-content-center">
                    <div class="stat-title">Sale(s)</div> 
                    <div class="stat-value text-success">{{$receiptMCount}}</div> 
                    <div class="stat-desc">made this month!!</div>
                    <div class="stat-actions">
                        <a href="{{ route('vendor.monthlyS')}}" class="btn btn-sm btn-success">CHECK NOW</a>
                      </div>
                  </div>
                </div>
              </div>
              <div class="spacer"></div>
              <h1 class="font-medium text-l banner-text">&nbsp; Sales by Month for This Year</h1>
                <div>
                  <div class="p-6 m-20 bg-white rounded shadow">
                    {!! $chart->container() !!}
                  </div>
                </div>
             @endif
            
            @if($store->isEmpty())
              <div class="w shadow stats">
                <div class="stat">
                  <div class="stat-figure text-info">
                    <div class="avatar">
                      <div class="w-16 h-16 p-1 mask mask-squircle bg-base-100">
                        <img src="..\..\..\image\icon\store.png" alt="Users Icon Image" class="mask mask-squircle">
                      </div>
                    </div>
                  </div> 
                  <div class="stat-title">Setup Your Store Now.... &nbsp;&nbsp;&nbsp;</div> 
                  <div class="stat-actions">
                    <a class="btn btn-sm btn-success" href="{{ route('vendor.setupStore')}}">Setup</a>
                  </div>
                </div>
              </div>
            @endif
            
          </div>
        </div>
         {{--End of container code  --}}
        {{-- Drawer code --}}
        @component('layouts.navBarV')
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
       <script src="{{ $chart->cdn() }}"></script>
       {{ $chart->script() }}
      {!! Toastr::message() !!}
      {{ \TawkTo::widgetCode() }}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>