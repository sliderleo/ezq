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
    <title>Analytics</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
          <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
          <h1 class="font-medium text-xl banner-text">&nbsp; Analytics</h1>
          <div class="container mx-auto">
            <div class="space-y-4">
              <div style="margin-bottom: 10px"></div>
              <div class="w shadow stats justify-item-center">
                <div class="stat">
                  <div class="stat-figure text-info">
                    <div class="avatar">
                      <div class="w-16 h-16 p-1 mask mask-squircle bg-base-100">
                        <img src="..\..\..\image\icon\sales.png" alt="Users Icon Image" class="mask mask-squircle">
                      </div>
                    </div>
                  </div> 
                </div>
  
                <div class="stat place-items-center place-content-center">
                  <div class="stat-title">Current Month's Sales</div> 
                  <div class="stat-value"></div> 
                  <div class="stat-actions">
                    <a class="btn btn-sm btn-success" href="{{ route('admin.monthlyS')}}">Check Now</a>
                  </div>
                </div>

                <div class="stat place-items-center place-content-center">
                  <div class="stat-title">Current Year's Sales</div> 
                  <div class="stat-value"></div> 
                  <div class="stat-actions">
                    <a class="btn btn-sm btn-success" href="{{ route('admin.yearlyS')}}">Check Now</a>
                  </div>
                </div>
              </div>

                <h1 class="font-medium text-l banner-text">&nbsp; Total User & Vendor</h1>
                <div>
                  <div class="p-6 m-20 bg-white rounded shadow">
                    {!! $pieChart->container() !!}
                  </div>
                </div>
            
                <h1 class="font-medium text-l banner-text">&nbsp; User & Vendor Join In This Year</h1>
                <div>
                  <div class="p-6 m-20 bg-white rounded shadow">
                    {!! $lineChart->container() !!}
                  </div>
                </div>

                <h1 class="font-medium text-l banner-text">&nbsp; Total Transaction Made In This Year</h1>
                <div>
                  <div class="p-6 m-20 bg-white rounded shadow">
                    {!! $monthlyBar->container() !!}
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

      <script src="{{ $lineChart->cdn() }}"></script>
      <script src="{{ $pieChart->cdn() }}"></script>
      <script src="{{ $monthlyBar->cdn() }}"></script>
      {{ $lineChart->script() }}
      {{ $pieChart->script() }}
      {{ $monthlyBar->script() }}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>