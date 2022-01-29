<?php


use App\Http\Controllers\API\Backend\Company\CompanyController;
use App\Http\Controllers\API\Backend\Stall\StallLayoutController;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['namespace' => 'API\Backend\Auth', 'middleware' => 'api'], function(){
    Route::post('/signin', 'AuthController@signIn');
    Route::post('/register', 'AuthController@register');
    Route::post('/signout', 'AuthController@signOut');
});


Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::group(['namespace'  => 'API\Backend'], function(){
        Route::get( 'get_stall_layout_images/{id}', [StallLayoutController::class, 'get_stall_layout_images']);
        Route::get( 'get_stall_layout_image/{id}', [StallLayoutController::class, 'get_stall_layout_image']);
        Route::post( 'get_stall_layout_images/', [StallLayoutController::class, 'get_stall_layout_images_store']);
        Route::get( 'get_company_details/{id}', [CompanyController::class, 'get_company_details']);
        Route::apiResources([
            'user'              => 'Auth\UserController',
            'role'              => 'Auth\RoleController',
            'company'           => 'Company\CompanyController',
            'company-user'      => 'Company\CompanyUserController',
            'event-category'    => 'EventCategory\EventCategoryController',
            'product-category'  => 'Category\ProductCategoryController',
            'event-subcategory' => 'EventCategory\EventSubCategoryController',
            'stall-layout'      => 'Stall\StallLayoutController',
            'stall'             => 'Stall\StallController',
            'blog'             => 'Blog\BlogController',
            'product'          => 'Product\ProductController',


            'event-sub-category'         => 'EventSubCategory\EventSubCategoryController',
            'order'                      => 'Order\OrderController',
            'order-detail'               => 'Order\OrderDetailsController',
            'product-attribute'          => 'Product\ProductAttributeController',
            'product-image'              => 'Product\ProductImageController',
            'product-visitor'            => 'Product\ProductVisitorController',
            'product-subCategory'        => 'ProductCategory\ProductSubCategoryController',
            'stall-visitor'              => 'Stall\StallVisitorController',
            'stall-ads'                  => 'Stall\StallAdsController',
            'vendor-site-visitor'        => 'VendorSiteVisitor\VendorSiteVisitorController',
            'visitor-point'              => 'Visitor\VisitorPointController',
            'visitor-point-distribution' => 'Visitor\VisitorPointDistributionController',
            'webinar'                    => 'Webinar\WebinarController',
            'webinar-user'               => 'Webinar\WebinarUserController',
            'ads'                        => 'Ads\AdsController',


        ]);

        Route::get('get-sub-category', 'ProductCategory\ProductSubCategoryController@getSubCategory');

    });

    Route::group(['namespace'  => 'API\Frontend'], function(){

        Route::get('get_cart_items', 'Cart\CartController@get_cart_items');
        Route::get('get-order-number', 'Order\OrderController@get_order_number');

        Route::apiResources([
            'stall-page' => 'Stall\StallController',
            'products' => 'Product\ProductController',
            'firebase' => 'Firebase\FirebaseController',
            'blog-page' => 'Blog\BlogController',
            'cart'              => 'Cart\CartController',
            'shipping-address'  => 'ShippingAddress\ShippingAddressController',
            'order'             => 'Order\OrderController',
            'user'              => 'User\UserController',
            'invoice'           => 'Invoice\InvoiceController',


        ]);

        Route::get('single-blog', 'Blog\BlogController@singleBlog');


Route::group(['namespace' => 'API\Company', 'middlware' => 'auth:sanctum'], function(){

});

        Route::group(['namespace' => 'Firebase'], function(){

            Route::post('/make-call', 'FirebaseController@makeCall');
            Route::post('/receive-call', 'FirebaseController@receiveCall');
            Route::post('/join-call', 'FirebaseController@joinCall');
            Route::post('/cancel-incoming-call', 'FirebaseController@cancelIncomingCall');
            Route::post('/cancel-outgoing-call', 'FirebaseController@cancelOutgoingCall');

        });


    Route::apiResources([
        'stall-page' => 'Stall\StallController',
        'products' => 'Product\ProductController',
        'firebase' => 'Firebase\FirebaseController',
        'blog-page' => 'Blog\BlogController',
        'cart'              => 'Cart\CartController',
        'shipping-address'  => 'ShippingAddress\ShippingAddressController',
        'order'             => 'Order\OrderController',

    ]);
    Route::get('single-blog', 'Blog\BlogController@singleBlog');

        Route::group(['namespace' => 'Chat'], function(){

            Route::post('/send-message', 'ChatController@sendMessage');
            Route::post('/receive-message', 'ChatController@receiveMessage');
            Route::post('/edit-message', 'ChatController@EditMessage');
            Route::post('/delete-message', 'ChatController@deleteMessage');

        });


    });

});


Route::group(['namespace' => 'API\Frontend', 'middleware' => 'api'], function(){
    Route::apiResources([
        // 'ads' => 'Stall\StallAdsController',
        // 'cart'                       => 'Cart\CartController',
    ]);
});




Route::group(['namespace'  => 'API\Frontend\Auth'], function(){

    Route::post('client-signin', 'AuthController@signIn');
    Route::post('signup', 'AuthController@signUp');
    Route::post('otp-verify', 'AuthController@otpVerify');
    Route::post('resent-otp', 'AuthController@resentOtp');



});

Route::group(['namespace'  => 'API\Frontend\General', 'middleware' =>'api'], function(){

    Route::get('frontend-event-category', 'GeneralController@eventCategory');
    Route::get('frontend-event-sub-category-wise-stall', 'GeneralController@eventSubCategory');
    Route::get('frontend-event-sub-category', 'GeneralController@subCategory');
    Route::get('frontend-stall-details', 'GeneralController@getStall');
    Route::get('lobby-ads', 'GeneralController@getLobbyAds');
    Route::get('exhibition-ads', 'GeneralController@getExhibitionAds');
    Route::get('showads-stall', 'GeneralController@showAdsstall');
    Route::get('search-stalls', 'GeneralController@searchStalls');

});

Route::group(['namespace' => 'API\Company\Auth'], function(){

    Route::post('company-signin', 'AuthController@signIn');
    Route::post('company-signout', 'AuthController@signOut');

});

