<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Session;
use Stripe;
    
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    public function viewPayment($price,$store,$user_id,$store_id){
        return view('stripe',compact('price','store','user_id','store_id'));
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    // public function stripePost(Request $request)
    // {
    //     Stripe\Stripe::setApiKey('sk_test_51KDP0qKX58JbDSOHu1i5zkW9kJPiKGT4gVJc9Nwucnvayfx1yePoBpyRI4jkOetuOhRM30xWbsrDX5Z4j6QblNmI00ygxg79JT');
    //     $paymentIntent  = \Stripe\PaymentIntent::create([
    //     'amount' => 1099,
    //     'currency' => 'usd',
    //     ]);
    //     $client_secret = $paymentIntent ->client_secret;
    //     return response()->json(['client_secret' => 'client_secret']);
    // }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey('sk_test_51KDP0qKX58JbDSOHu1i5zkW9kJPiKGT4gVJc9Nwucnvayfx1yePoBpyRI4jkOetuOhRM30xWbsrDX5Z4j6QblNmI00ygxg79JT');
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "MYR",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
    }
}