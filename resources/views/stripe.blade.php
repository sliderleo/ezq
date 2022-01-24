<?php
require_once(__DIR__.'/../../../vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51KDP0qKX58JbDSOHu1i5zkW9kJPiKGT4gVJc9Nwucnvayfx1yePoBpyRI4jkOetuOhRM30xWbsrDX5Z4j6QblNmI00ygxg79JT');
$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'MYR',
        'product_data' => [
          'name' => $store,
        ],
        'unit_amount' => $price*100,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://192.168.1.105:8000/success/'.$price.'/'.$user_id.'/'.$store_id,
    'cancel_url' => 'http://192.168.1.105:8000/cancel',
  ]);
?>
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
    <title>Pay Now</title>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <div class="container mx-auto">
      <div class="grid grid-flow-col justify-items-center" style="padding-top: 20px">
        <img src="https://i.imgur.com/u8wuTdW.png" style="width: 200px; height:200px;"/>
      </div>
      <div class="grid grid-flow-col justify-items-center">
        <h1 class="font-medium text-m banner-text"><span class="red">Please do not leave this page or return to the previous page!</span> You will be redirect to the payment gateway after clicking checkout!</h1>
      </div>
      <form class="grid grid-flow-col justify-items-center" action="/create-checkout-session" method="POST">
        <button class="btn btn-primary" id="checkout-button" type="submit">Checkout Now</button>
        <script>
            var stripe = Stripe("pk_test_51KDP0qKX58JbDSOHlIHm5P0NlDidvv0h7ANDq4JpaBPaD8JeCzldaWjdGkrnUlhauRP0E2AqMKW5vPaKpbjxFsg400AWpxlz5d");
        const btn = document.getElementById("checkout-button")
        btn.addEventListener('click',function(e) {
            e.preventDefault();
        stripe.redirectToCheckout({
                sessionId: "<?php echo $session->id; ?>"
              });
            });
            </script>
      </form>
    </div>
  </body>
</html>