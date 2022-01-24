<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/addBanner.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Store Info</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200  drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp;Edit Store</h1> 
            <div class="container mx-auto">
                @foreach ($store as $item)
                <form method="post" action="/vendor/store-update/{{$item->id}}" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                    <div class="grid grid-flow-row justify-items-center">
                        @foreach ($errors->all() as $err)
                            <li class="error-li">{{$err}}</li>
                        @endforeach
                    </div>
                    @endif
                    <div class="grid grid-flow-col  gap-9 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Name</span>
                            </label> 
                            <input type="text" placeholder="Name" id="name" name="name" class="input" value="{{$item->name}}" minlength="5" maxlength="20" required>
                        </div>
                    </div>

                    <div class="grid grid-flow-col  gap-12 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Address</span>
                            </label> 
                            <textarea class="textarea h-24 textarea-bordered"  placeholder="Address" id="address" name="address"  minlength="15" maxlength="70" required>{{$item->address}}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-flow-col  gap-9 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Contact</span>
                            </label> 
                            <input type="text" placeholder="Contact" id="contact" name="contact" class="input"  minlength="10" maxlength="11" value="{{$item->contact}}">
                        </div>
                    </div>
                    <div class="spacer"></div>
                    <div class="grid grid-flow-col  justify-items-center">
                        <button class="btn btn-success" type="submit">UPDATE</button>
                    </div>

                </form>
                @endforeach
            </div>
            
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function (e) {
            $('#item_img').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => { 
                $('#preview-image-before-upload').attr('src', e.target.result); 
                }
            
                reader.readAsDataURL(this.files[0]); 
            });
            });
            </script>
        </div> 
        {{-- Drawer code --}}
        @component('layouts.navBarV')
        @endcomponent
      </div>
      {!! Toastr::message() !!}
      {{ \TawkTo::widgetCode() }}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>