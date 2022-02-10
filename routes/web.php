<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Frontend\AllUserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CartPageController;
use App\Http\Controllers\Frontend\CashController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => (new Mcamara\LaravelLocalization\LaravelLocalization)->setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
    /*Route::get('/', function () {
        return view('front.index');
    })->name('home');*/
    Route::get('/', [IndexController::class, 'index'])->name('home');

    /*----- admin -----*/
    Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'verified', 'UserRole']], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

        /*----- Admin Category all Routes -----*/
        Route::prefix('category')->group(function () {
            Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
            Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
            Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
            Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

            /*----- Admin Sub Category All Routes -----*/
            Route::prefix('sub')->group(function () {
                Route::get('/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
                Route::get('/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');
                Route::post('/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
                Route::get('/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
                Route::post('/update/{id}', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
                Route::get('/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');
            });

        });

        /*----- Admin Products All Routes -----*/

        Route::prefix('product')->group(function () {
            Route::get('/ajax/{category_id}/{subcategory_id}', [ProductController::class, 'GetAllProducts']);
            Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
            Route::post('/duplicate', [ProductController::class, 'DuplicateProduct'])->name('duplicate.product');
            Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
            Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
            Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
            Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');
            Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
            Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');
            Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
            Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
            Route::get('/down/{id}', [ProductController::class, 'deactivate'])->name('product.down');
            Route::get('/up/{id}', [ProductController::class, 'activate'])->name('product.up');
            Route::get('/in-notification', [ProductController::class, 'ProductNotification'])->name('in.notification');
            Route::post('/free-shipping', [ProductController::class, 'ProductFreeShipping'])->name('product.free.shipping');
            Route::get('/colors-qty/{id}', [ProductController::class, 'ProductColorEdit'])->name('product.color.edit');
            Route::post('/colors-qty-update/{id}', [ProductController::class, 'ProductColorUpdate'])->name('product.color.update');
            Route::post('/colors-add', [ProductController::class, 'ProductColorAdd'])->name('add.product.color');
        });
        Route::get('/free-shipping', [AdminController::class, 'FreeShipping'])->name('free.shipping');
        Route::post('/set-free-shipping', [AdminController::class, 'SetFreeShipping'])->name('set.free.shipping');

        /*----- Admin Slider All Routes -----*/
        Route::prefix('slider')->group(function () {
            Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
            Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
            Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
            Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
            Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
            Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
            Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
        });

        /*----- Admin coupon -----*/
        Route::prefix('coupons')->group(function () {
            Route::get('percentage/view', [CouponController::class, 'CouponView'])->name('manage-coupon');
            Route::post('percentage/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
            Route::get('percentage/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
            Route::post('percentage/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
            Route::get('percentage/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
            /*--- price coupon ---*/
            Route::get('/price/view', [CouponController::class, 'PriceCouponView'])->name('price.manage-coupon');
            Route::post('/price/store', [CouponController::class, 'PriceCouponStore'])->name('price.coupon.store');
            Route::get('/price/edit/{id}', [CouponController::class, 'PriceCouponEdit'])->name('price.coupon.edit');
            Route::post('/price/update/{id}', [CouponController::class, 'PriceCouponUpdate'])->name('price.coupon.update');
            Route::get('/price/delete/{id}', [CouponController::class, 'PriceCouponDelete'])->name('price.coupon.delete');
            /*--- user coupon ---*/
            Route::get('/user/view', [CouponController::class, 'UserCouponView'])->name('user.manage-coupon');
            Route::post('/user/store', [CouponController::class, 'UserCouponStore'])->name('user.coupon.store');
            Route::get('/user/edit/{id}', [CouponController::class, 'UserCouponEdit'])->name('user.coupon.edit');
            Route::post('/user/update/{id}', [CouponController::class, 'UserCouponUpdate'])->name('user.coupon.update');
            Route::get('/user/delete/{id}', [CouponController::class, 'UserCouponDelete'])->name('user.coupon.delete');
            /*--- product coupon ---*/
            Route::get('/product/view', [CouponController::class, 'ProductCouponView'])->name('product.manage-coupon');
            Route::post('/product/store', [CouponController::class, 'ProductCouponStore'])->name('product.coupon.store');
            Route::get('/product/edit/{id}', [CouponController::class, 'ProductCouponEdit'])->name('product.coupon.edit');
            Route::post('/product/update/{id}', [CouponController::class, 'ProductCouponUpdate'])->name('product.coupon.update');
            Route::get('/product/delete/{id}', [CouponController::class, 'ProductCouponDelete'])->name('product.coupon.delete');
        });

        /*----- Admin shipping -----*/
        Route::prefix('shipping')->group(function () {
            // Ship Division
            Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');
            Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
            Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');
            Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
            Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');


            // Ship District
            Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');
            Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
            Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
            Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
            Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');
        });

        /*----- Admin orders -----*/
        Route::prefix('orders')->group(function () {
            Route::get('/pending/orders', [OrderController::class, 'PendingOrders'])->name('pending-orders');
            Route::get('/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');
            Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');
            Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');
            Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');
            Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');
            Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');
            Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');

            // Update Status
            Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');
            Route::get('/pending/cancel-by-admin/{order_id}', [OrderController::class, 'PendingToCancelByAdmin'])->name('cancel-by-admin');
            Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');
            Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');
            Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');
            Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');
            Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');
            Route::get('/invoice/shipping/download/{order_id}', [OrderController::class, 'AdminShippingDownload'])->name('shipping.invoice.download');
        });
        Route::get('/order-return/returned', [OrderController::class, 'ReturnedOrder'])->name('returned-orders');
        Route::get('/order-return/request', [OrderController::class, 'ReturnRequest'])->name('return-request-orders');
        Route::get('/order-return/status/{order_id}', [OrderController::class, 'ReturnStatus'])->name('return.done');


        /*----- Admin Reports Routes -----*/
        Route::prefix('reports')->group(function () {
            Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');
            Route::get('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');
            Route::get('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');
            Route::get('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');
        });

        /*----- Admin Get All User Routes -----*/
        Route::prefix('alluser')->group(function () {
            Route::get('/view', [AdminController::class, 'AllUsers'])->name('all-users');
            Route::get('/set-admin/{id}', [AdminController::class, 'SetAdmin'])->name('SetAdmin');
            Route::get('/set-normal/{id}', [AdminController::class, 'SetNormal'])->name('SetNormal');
            Route::get('/report', [AdminController::class, 'Report'])->name('alluser.report');
        });

        /*----- Admin Seo -----*/
        Route::prefix('site-settings')->group(function () {
            Route::get('/seo/', [AdminController::class, 'SeoSetting'])->name('seo.setting');
            Route::post('/seo/update', [AdminController::class, 'SeoSettingUpdate'])->name('update.seosetting');
            Route::get('/social-media/', [AdminController::class, 'SocialSetting'])->name('social.setting');
            Route::post('/social-media/update', [AdminController::class, 'SocialSettingUpdate'])->name('update.socialsetting');
        });

        /*----- Admin about us -----*/
        Route::prefix('about-us')->group(function () {
            Route::get('/edit', [AdminController::class, 'AboutEdit'])->name('about.setting');
            Route::post('/update', [AdminController::class, 'AboutUpdate'])->name('update.about_us');
        });
    });
    Route::get('/shipping/district/ajax/{id}', [ShippingAreaController::class, 'DistrictAjax']);
    Route::post('/change-logo', [AdminController::class, 'UpdateLogo'])->name('change.logo');
    /*----------------------------------------------------------------------------------------------------*/
    /*----------------------------------------------------------------------------------------------------*/
    /*----------------------------------------------------------------------------------------------------*/

    /*----- normal -----*/
    /*----- user -----*/
    Route::group(['prefix' => 'user', 'middleware' => ['auth:sanctum', 'verified']], function () {
        Route::get('profile', [IndexController::class, 'UserProfile'])->name('user.profile');
        Route::post('profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
        Route::get('change-password', [IndexController::class, 'UserChangePassword'])->name('change.password');
        Route::post('password-update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');
    });

    Route::fallback(function () {
        return view("errors.404"); // template should exists
    });

    /*----- auth -----*/
    // Add to Wishlist
    Route::post('wishlist/add/{product_id}', [WishlistController::class, 'AddToWishlist']);

    Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
        // Wishlist page
        Route::group(['prefix' => 'wishlist'], function () {
            Route::get('/', [WishlistController::class, 'ViewWishlist'])->name('wishlist');
            /*Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);*/
            Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct'])->name('wishlist.delete');
        });

        Route::group(['prefix' => 'mycart'], function () {
            // Cart page
            Route::get('/', [CartPageController::class, 'MyCart'])->name('mycart');
            /*Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);*/
            Route::get('/remove/{rowId}', [CartPageController::class, 'RemoveCartProduct'])->name('remove.mycart');
            /*Route::get('/increment/{rowId}', [CartPageController::class, 'CartIncrement']);
            Route::get('/decrement/{rowId}', [CartPageController::class, 'CartDecrement']);*/

            /*-- checkout --*/
            Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
            /*Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
            Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);*/
            Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');
        });

        /*Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');*/
        Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

        Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');
        Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails'])->name('OrderDetails');
        Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload'])->name('InvoiceDownload');
        Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');
        Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');
        Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');
        Route::get('/cancel/order/{id}', [AllUserController::class, 'CancelOrder'])->name('cancel.order');

        // Order Traking Route
        Route::post('/order/tracking', [AllUserController::class, 'OrderTraking'])->name('order.tracking');

        Route::group(['prefix' => 'theme'], function () {
            Route::get('/light', [AllUserController::class, 'light'])->name('light.theme');
            Route::get('/dark', [AllUserController::class, 'dark'])->name('dark.theme');
            Route::get('/mint', [AllUserController::class, 'mint'])->name('mint.theme');
        });
    });

    /*----- products -----*/
    Route::group(['prefix' => 'product'], function () {
        Route::get('/details/{id}', [IndexController::class, 'ProductDetails'])->name('product.details');
        Route::get('/subcategory/{subcat_id}', [IndexController::class, 'SubCatWiseProduct'])->name('products.by.subcategory');
        Route::get('/category/{cat_id}', [IndexController::class, 'CatWiseProduct'])->name('products.by.category');
        Route::get('/view/modal/{id}', [IndexController::class, 'ProductViewAjax'])->name('get.product.ajax');

        Route::get('/special-offer', [IndexController::class, 'special_offer'])->name('special.offer');
        Route::get('/best-seller', [IndexController::class, 'best_seller'])->name('best.seller');
    });

    /*----- cart -----*/
    Route::group(['prefix' => 'cart'], function () {
        Route::post('/data/store/{id}', [CartController::class, 'AddToCart']);
        // Get Data from mini cart
        Route::get('/mini', [CartController::class, 'AddMiniCart']);
        // Remove mini cart all
        Route::get('/mini/remove/all', [CartController::class, 'RemoveAll']);
        // Remove mini cart
        Route::get('/mini/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

        /*-- coupon --*/
        Route::post('/coupon-apply', [CartController::class, 'CouponApply'])->name('apply.coupon');
        Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation'])->name('coupon.calculation');
        Route::get('/coupon-remove', [CartController::class, 'CouponRemove'])->name('coupon.remove');

    });

    /// Product Search Route
    Route::post('/search', [IndexController::class, 'ProductSearch'])->name('product.search');
    // Advance Search Routes
    Route::post('search-product', [IndexController::class, 'SearchProduct'])->name('advanced.search');

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/contact-us', function () {
        return view('front.contact_us');
    })->name('contact-us');

    Route::post('/contact-us', [IndexController::class, 'contact_us'])->name('contact-us');

    Route::get('/about-us', function () {
        return view('front.about_us');
    })->name('about-us');

    Route::get('/privacy-policy', function () {
        return view('front.privacy');
    });
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});
