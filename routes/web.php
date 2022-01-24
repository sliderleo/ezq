<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RequestController;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\StripeController;
use App\Models\Receipt;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Stripe



Route::get('/admin/login', function () {
    return view('admin/adminLogin');
})->name('adminLogin');

Route::get('/vendor/login', function () {
    return view('vendors/vendorLogin');
})->name('vendorLogin');

Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/vendor/register', function () {
    return view('/vendors/vendorRegister');
})->name('vendorRegister');
//pdf api
Route::get('vendor/generate-pdf/{id}', [PDFController::class, 'generatePDF']);

Route::get('/addbanner', function () {
    return view('addBanner');
});

Route::get('/payment/{price}/{store}/{user_id}/{store_id}',[StripeController::class,'viewPayment']);
Route::get('/success/{price}/{user_id}/{store_id}', [ReceiptController::class,'success']);
Route::get('/cancel', function () {
    return view('cancel');
});
Route::get('/message', function () {
    return view('message');
});


Route::post('/upd',[StoreController::class,'store']);

Route::post('/msg',[MessageController::class,'store']);

Route::post('admin/addbanner',[BannerController::class,'store']);
Route::post('admin/addAd',[AdController::class,'store']);
Route::post('admin/addcategory',[CategoryController::class,'store']);
Route::post('vendor/addItem',[ItemController::class,'store']);
Route::post('vendor/register',[VendorController::class,'store']);
Route::post('vendor/setupstore',[StoreController::class,'store']);

Route::get('admin/banner-edit/{id}',[BannerController::class,'edit']);
Route::put('admin/banner-update/{id}',[BannerController::class,'update']);
Route::get('admin/banner-delete/{id}',[BannerController::class,'destroy']);

Route::get('vendor/item-edit/{id}',[ItemController::class,'editPage']);
Route::post('vendor/item-i-update/{id}',[ItemController::class,'updateInfo']);
Route::get('vendor/item-image-edit/{id}',[ItemController::class,'editImgPage']);
Route::put('vendor/item-image-update/{id}',[ItemController::class,'udpateImg']);
Route::get('vendor/item-delete/{id}',[ItemController::class,'deleteItem']);

Route::get('vendor/store-image-edit/{id}',[StoreController::class,'editImage']);
Route::put('vendor/store-image-update/{id}',[StoreController::class,'updateImage']);
Route::get('vendor/store-edit/{id}',[StoreController::class,'editInfo']);
Route::post('vendor/store-update/{id}',[StoreController::class,'updateInfo']);

Route::get('admin/ad-edit/{id}',[AdController::class,'edit']);
Route::put('admin/ad-update/{id}',[AdController::class,'update']);
Route::get('admin/ad-delete/{id}',[AdController::class,'destroy']);

Route::get('ad-status', [AdController::class,'updateStatus']);
Route::get('category-status', [CategoryController::class,'updateStatus']);
Route::get('banner-status', [BannerController::class,'updateStatus']);
Route::get('store-status', [StoreController::class,'updateStatus']);
Route::get('item-status', [ItemController::class,'updateStatus']);

Route::get('admin/category-edit/{id}',[CategoryController::class,'edit']);
Route::put('admin/category-update/{id}',[CategoryController::class,'update']);
Route::get('admin/category-delete/{id}',[CategoryController::class,'destroy']);

Route::get('admin/store-ban/{id}', [StoreController::class,'banStore']);
Route::get('admin/store-unban/{id}', [StoreController::class,'unbanStore']);

Route::get('admin/user-ban/{id}', [UserController::class,'banUser']);
Route::get('admin/user-unban/{id}', [UserController::class,'unbanUser']);

Route::get('admin/vendor-ban/{id}', [VendorController::class,'banVendor']);
Route::get('admin/vendor-unban/{id}', [VendorController::class,'unbanVendor']);

Route::post('admin/store-search', [StoreController::class,'superSearch']);
Route::get('admin/store-page/{id}',[StoreController::class,'showStore']);

Route::get('vendor/store-page',[StoreController::class,'vendorStore'])->name('vendor.store');

Route::get('admin/pending-page/{id}',[RequestController::class,'showRequest']);
Route::get('admin/pending-approve/{id}',[RequestController::class,'approve']);
Route::get('admin/pending-reject/{id}',[RequestController::class,'reject']);

Route::post('admin/user-search', [UserController::class,'superSearch']);

Route::post('admin/vendor-search', [VendorController::class,'superSearch']);
Route::post('vendor/item-search', [ItemController::class,'superSearch']);

Route::post('/admin/val',[AdminController::class,'check'])->name('admin.validate');
Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin.logout');

Route::post('/vendor/val',[VendorController::class,'check'])->name('vendor.validate');
Route::get('vendor/item-page/{id}',[ItemController::class,'showItem']);

Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/admin/home',[UserController::class, 'homeWeb'])->name('admin.home');
    Route::get('/vendor/home',[VendorController::class, 'index'])->name('vendor.home');
    Route::get('vendor/profile',[VendorController::class, 'showVendor'])->name('vendor.profile');
    Route::get('admin/viewbanner',[BannerController::class,'index'])->name('admin.bannerV');
    Route::get('admin/viewad',[AdController::class,'index'])->name('admin.adV');
    Route::get('admin/viewstore',[StoreController::class,'index'])->name('admin.storeV');
    Route::get('admin/viewuser',[UserController::class,'webIndex'])->name('admin.userV');
    Route::get('admin/viewvendor',[VendorController::class,'webIndex'])->name('admin.vendorV');
    Route::get('admin/viewcategory',[CategoryController::class,'webIndex'])->name('admin.categoryV');
    Route::get('admin/bannedStore',[StoreController::class,'bannedIndex'])->name('admin.storeB');
    Route::get('admin/bannedUser',[UserController::class,'bannedIndex'])->name('admin.userB');
    Route::get('admin/bannedvendor',[VendorController::class,'bannedIndex'])->name('admin.vendorB');
    Route::get('/admin/analytics',[UserController::class, 'analyticsWeb'])->name('admin.analytics');
    Route::get('/admin/pendings',[RequestController::class, 'webIndex'])->name('admin.pendings');
    Route::get('admin/monthly-sales',[ReceiptController::class,'monthlySalesA'])->name('admin.monthlyS');
    Route::get('admin/yearly-sales',[ReceiptController::class,'yearSalesA'])->name('admin.yearlyS');

    Route::get('admin/monthly-export/',[ReceiptController::class,'exportMonthlyA'])->name('admin.exportMonth');
    Route::get('admin/yearly-export/',[ReceiptController::class,'exportYearlyA'])->name('admin.exportYear');

    Route::get('vendor/analytics',[ReceiptController::class,'analyticsPage'])->name('vendor.analytics');
    Route::get('vendor/today-sales',[ReceiptController::class,'todaySales'])->name('vendor.todayS');
    Route::get('vendor/monthly-sales',[ReceiptController::class,'monthlySales'])->name('vendor.monthlyS');
    Route::get('vendor/viewitems',[ItemController::class,'webIndex'])->name('vendor.itemsV');
    Route::get('vendor/additems',[ItemController::class,'addItemPage'])->name('vendor.addItem');
    Route::get('vendor/viewitems-inactive',[ItemController::class,'inactiveWebIndex'])->name('vendor.itemsX');
    Route::get('vendor/setupstore',[StoreController::class,'showSetupPage'])->name('vendor.setupStore');
    Route::get('/vendor/items',[ItemController::class,'mainItemPage'])->name('vendor.items');
   
    Route::get('vendor/daily-export/',[ReceiptController::class,'exportDaily'])->name('vendor.getDaily');
    Route::get('vendor/monthly-export/',[ReceiptController::class,'exportMonthly'])->name('vendor.getMonthly');

    Route::get('/admin/banner', function () {
        return view('/admin/banner');
    })->name('admin.banner');
    Route::get('/admin/addbanner', function () {
        return view('/admin/addBanner');
    })->name('admin.bannerA');
    Route::get('/admin/ad', function () {
        return view('/admin/ad');
    })->name('admin.ad');
    Route::get('/admin/addad', function () {
        return view('/admin/addAd');
    })->name('admin.adsA');
    Route::get('/admin/store', function () {
        return view('/admin/store');
    })->name('admin.store');
    Route::get('/admin/store-search', function () {
        return view('/admin/searchStore');
    })->name('admin.searchStore');
    Route::get('/admin/user-search', function () {
        return view('/admin/searchUser');
    })->name('admin.searchUser');
    Route::get('/admin/vendor-search', function () {
        return view('/admin/searchVendor');
    })->name('admin.searchVendor');
    Route::get('/admin/users', function () {
        return view('/admin/user');
    })->name('admin.users');
    Route::get('/admin/vendors', function () {
        return view('/admin/vendor');
    })->name('admin.vendors');
    Route::get('/admin/category', function () {
        return view('/admin/category');
    })->name('admin.categories');
    Route::get('/admin/addcategory', function () {
        return view('/admin/addCategory');
    })->name('admin.categoryA');
    
});
