<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ReceiptController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register',[AuthController::class,'register']);
Route::resource('noti',NotiController::class);
Route::resource('cart',CartController::class);
Route::resource('items',ItemController::class);
Route::post('/login',[AuthController::class,'login']);
Route::post('/upload',[StoreController::class,'store']);
Route::get('/banners',[BannerController::class,'apiIndex']);
Route::get('/vendors',[VendorController::class,'index']);

Route::get('/requests',[RequestController::class,'webIndex']);


Route::post('/registerV',[VendorController::class,'store']);
//Search API



//Token Api
// Route::post('/sanctum/token', function (Request $request) {
//     $request->validate([
//         'username' => 'required',
//         'password' => 'required',
//         'device_name' => 'required',
//     ]);

//     $user = User::where('username', $request->username)->first();

//     if (! $user || ! Hash::check($request->password, $user->password)) {
//         throw ValidationException::withMessages([
//             'username' => ['The provided credentials are incorrect.'],
//         ]);
//     }

//     $token=$user->createToken($request->username)->plainTextToken;
    
//     $response=[
//         'user'=> $user,
//         'token' => $token
//     ];

//     return response($response,201);
// });

//Protected Route need tokens
Route::get('receipt/',[ReceiptController::class,'getTodaySales']);
Route::get('receipt/get/{id}',[ReceiptController::class,'getReceipt']);
Route::get('ad/',[AdController::class,'getAd']);
Route::get('store/',[StoreController::class,'getStore']);
Route::post('store/search/',[StoreController::class,'superSearch']);
Route::post('/create-payment-intent', [StripeController::class, 'stripePost'])->name('stripe.post');
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::get('items/search/{store_id}/{barcode}',[ItemController::class,'search']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('store/search/{id}',[StoreController::class,'search']);
    Route::get('user/search/{id}',[UserController::class,'search']);
    Route::get('user/profile/{id}',[UserController::class,'profileAPI']);
});