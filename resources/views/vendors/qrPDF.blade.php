<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="/css/bannerView.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EzQ QR Code</title>
</head>

<body style="text-align: center; background-image: url(https://i.imgur.com/PXwx2o7.png); background-repeat:no-repeat; background-position: center center; background-size: auto;">
    <div style="opacity: 0.9; background-color: white;">    
    <h1 style="margin:40px; font-size: 50px;">Welcome to</h1>
        <h1 style="font-weight: bold; margin:50px; font-size: 60px;">{{$name}}</h1>
        <img src="data:image/png;base64, 
                                {!! base64_encode(QrCode::format('png')
                                ->merge('https://i.imgur.com/u8wuTdW.png', .4, true)
                                ->size(230)
                                ->eye('circle')
                                ->errorCorrection('H')
                                ->generate($id)) !!} ">
        <h2 style="margin:50px;">{{$address}}</h2>
    </div>
</body>

</html>