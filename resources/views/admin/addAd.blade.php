<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/addBanner.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Ads</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200  drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp;Add Ads</h1> 
            <div class="container mx-auto">
                <form method="post" action="/admin/addAd" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-flow-col justify-items-center">
                        <div>
                            <h1 class="font-medium ">Image Preview: </h1>
                            <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                        alt="preview image" style="max-height: 150px; max-width:150px;">
                        </div>
                    </div>

                    <div class="spacer"></div>

                    <div class="grid grid-flow-col grid-cols-2 gap-9 justify-items-center">
                        <input type="file" name="ads_img" id="ads_img"  required/>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function (e) {
            $('#ads_img').change(function(){
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
        @component('layouts.navBar')
        @endcomponent
      </div>
      
      {!! Toastr::message() !!}
</body>
{{-- Footer --}}
@component('layouts.footer')
@endcomponent
</html>