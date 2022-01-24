<html>
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
    <title>Help</title>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <div class="container mx-auto">
      <div class="grid grid-flow-col justify-items-center" style="padding-top: 20px">
        <img src="https://i.imgur.com/u8wuTdW.png" style="width: 200px; height:200px;"/>
      </div>
      <h1 class="font-medium text-xl banner-text" style="text-align: center;">Need Help?</h1>
      <div class="grid grid-flow-col justify-items-center">
        <h1 class="font-medium text-m banner-text">Contact with our admins by click the green button on the bottom right.<span class="red">Please state your username/email to the admin and your question clearly!</span></h1>
      </div>
    </div>
    {{ \TawkTo::widgetCode() }}
  </body>
</html>