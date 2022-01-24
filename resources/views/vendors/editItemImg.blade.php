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
    <title>Edit Image</title>
</head>
<body>
    @foreach ($items as $item)
    <div class="rounded-lg shadow bg-base-200  drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp;Edit Image for {{$item->name}}</h1> 
            <div class="container mx-auto">
                <form method="post" action="{{url('vendor/item-image-update/'.$item->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-flow-col justify-items-center">
                        <div>
                            <h1 class="font-medium ">Previous Image: </h1>
                            <img src="/image/pic_items/{{$item->item_img}}"
                        alt="preview image" style="max-height: 150px; max-width:150px;">
                        </div>
                        <div>
                            <h1 class="font-medium ">Updated Image: </h1>
                            <img id="preview-image-before-upload" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                        alt="preview image" style="max-height: 150px; max-width:150px;">
                        </div>
                    </div>

                    <div class="spacer"></div>

                    <div class="grid grid-flow-col grid-cols-2 gap-9 justify-items-center">
                        <input type="file" name="item_img" id="item_img"  required/>
                        <button class="btn btn-primary" type="submit">Update</button>
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