<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Page</title>
</head>
<body>
    <h1>Upload Page</h1>
    <form method="post" action="/upd" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="name" placeholder="name here"/>
        <input type="text" name="vendor_id" id="vendor_id" placeholder="id here"/>
        <input type="text" name="contact" id="contact" placeholder="contact here"/>
        <input type="text" name="address" id="address" placeholder="address here"/>
        <input type="file" name="store_img" id="store_img" />
        {{-- <input type="file" name="store-img" id="store-img"/> --}}
        <button type="submit">Submit</button>
    </form>
    
</body>
</html>