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
    <title>Add Item</title>
</head>
<body>
    <div class="rounded-lg shadow bg-base-200  drawer drawer-mobile">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle"> 
        <div class="flex flex-col drawer-con drawer-content">
            <label for="my-drawer-1" class="mb-4 lg:hidden menu-icon"><span class="material-icons">menu</span></label> 
            <h1 class="font-medium text-xl banner-text">&nbsp;Add Item</h1> 
            <div class="container mx-auto">
                <form method="post" action="/vendor/addItem" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-flow-col  gap-9 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Name</span>
                            </label> 
                            <input type="text" placeholder="Name" id="name" name="name" class="input" minlength="4" maxlength="30" required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Price</span>
                            </label> 
                            <input type="text" placeholder="Price" id="price" name="price" class="input" required>
                        </div>
                    </div>

                    <div class="grid grid-flow-col  gap-12 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Desc</span>
                            </label> 
                            <textarea class="textarea h-24 textarea-bordered"  placeholder="Desc goes here" id="desc" name="desc" minlength="1" maxlength="50" required></textarea>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Barcode</span>
                            </label> 
                            <input type="text" placeholder="Barcode" id="barcode" name="barcode" class="input" minlength="5" required>
                        </div>
                    </div>

                    <div class="grid grid-flow-col  gap-9 justify-items-center">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Store ID</span>
                            </label> 
                            <input type="text" placeholder="Store ID" id="store_id" name="store_id" class="input" value="{{$id}}" readonly>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Quantity</span>
                            </label> 
                            <input type="number" placeholder="Quantity" id="quantity" name="quantity" class="input" value="1" readonly>
                        </div>
                    </div>

                    <div class="grid grid-flow-col  grid-cols-2  gap-9  justify-items-center">
                        <div class="justify-self-center">
                            <img class="justify-items-center" id="preview-image-before-upload" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                            alt="preview image" style="max-height: 150px; max-width:200px;  display: block; margin: auto;">
                            <input type="file" name="item_img" id="item_img" required/>
                        </div>    

                        <div class="form-control ">
                            <label class="label">
                                <span class="label-text">Category</span> 
                            </label> 
                            <select name="c_id" id="_id" class="select select-bordered select-primary w-full max-w-xs">
                                @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option> 
                                @endforeach
                                
                            </select>
                        </div>  
                    </div>
                    
                    <div class="spacer"></div>
                    <div class="grid grid-flow-col  justify-items-center">
                        <button class="btn btn-success" type="submit">SUBMIT</button>
                    </div>

                </form>
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