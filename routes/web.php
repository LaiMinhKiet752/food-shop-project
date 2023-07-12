<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\AdminSubscriberController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CancelController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\MollieController;
use App\Http\Controllers\User\PaypalController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ContactMessageController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\SubscriberController;
use App\Http\Controllers\User\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Index All Route
Route::controller(IndexController::class)->group(function () {

    //Home Page
    Route::get('/', 'Index');
    //Frontend Product Details All Route
    Route::get('/product/details/{id}/{slug}', 'ProductDetails');
    Route::get('/product/category/{id}/{slug}', 'CategoryWiseProduct');
    Route::get('/product/subcategory/{id}/{slug}', 'SubCategoryWiseProduct');
    // Product View Modal With Ajax
    Route::get('/product/view/modal/{id}', 'ProductViewAjax');
    //Product Search
    Route::post('/product/search', 'ProductSearch')->name('product.search');
    Route::post('/search-product', 'SearchProduct');
});

//Frontend All Route
Route::controller(FrontendController::class)->group(function () {
    Route::get('/privacy-policy/page', 'PrivacyPolicy')->name('privacy_policy');
    Route::get('/about/page', 'About')->name('about');
    Route::get('/contact/page', 'Contact')->name('contact');
    Route::post('/contact/page/submit', 'ContactSubmit')->name('contact.submit');
});

//Subscriber All Route
Route::controller(SubscriberController::class)->group(function () {
    Route::post('/subscriber/send-mail', 'SendMail')->name('subscriber.send.mail');
    Route::get('/subscriber/verify/{token}/{email}', 'Verify')->name('subscribe.verify.email');
});

//Captcha
Route::get('/reload-captcha', [RegisteredUserController::class, 'ReloadCaptcha']);

//Cart All Route
Route::controller(CartController::class)->group(function () {
    //Add To Cart All Route
    Route::get('/product/mini/cart', 'AddMiniCart');
    Route::get('/minicart/product/remove/{rowId}', 'RemoveMiniCart');
    Route::post('/cart/data/store/{id}', 'AddToCartQuickView');
    Route::post('/dcart/data/store/{id}', 'AddToCartDetails');
    Route::post('/home/new/product/cart/store/{id}', 'AddToCartHomeNewProduct');
    Route::post('/home/new/product/category/cart/store/{id}', 'AddToCartHomeNewProductCategory');
    Route::post('/featured/product/cart/store/{id}', 'AddToCartFeaturedProduct');
    Route::post('/category/product/cart/store/{id}', 'AddToCartCategoryProduct');
    Route::post('/subcategory/product/cart/store/{id}', 'AddToCartSubCategoryProduct');
    Route::post('/related/product/cart/store/{id}', 'AddToCartRelatedProduct');
    Route::post('/categoryone/product/cart/store/{id}', 'AddToCartCategoryOneProduct');
    Route::post('/categorytwo/product/cart/store/{id}', 'AddToCartCategoryTwoProduct');
    Route::post('/categorythree/product/cart/store/{id}', 'AddToCartCategoryThreeProduct');
    Route::post('/categoryfour/product/cart/store/{id}', 'AddToCartCategoryFourProduct');
    Route::post('/categoryfive/product/cart/store/{id}', 'AddToCartCategoryFiveProduct');
    Route::post('/product/search/cart/store/{id}', 'AddToCartProductSearch');
    Route::post('/shop/page/product/cart/store/{id}', 'AddToCartShopPage');
    //My Cart All Route
    Route::get('/my-cart', 'MyCart')->name('mycart');
    Route::get('/get-cart-product', 'GetCartProduct');
    Route::get('/cart-remove/{rowId}', 'CartRemove');
    Route::get('/cart/remove/all/product', 'CartRemoveAllProduct')->name('cart.remove.all.product');
    Route::get('/cart-decrement/{rowId}', 'CartDecrement');
    Route::get('/cart-increment/{rowId}', 'CartIncrement');
    //Frontend Coupon Option All Route
    Route::post('/coupon-apply', 'CouponApply');
    Route::get('/coupon-calculation', 'CouponCalculation');
    Route::get('/coupon-remove', 'CouponRemove');
    //Checkout Page All Route
    Route::get('/checkout', 'CheckoutCreate')->name('checkout');
});

//Add To Wishlist
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'addToWishList']);

//Add To Compare
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'addToCompare']);

//Frontend Blog Post All Route
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'AllBlog')->name('home.blog');
    Route::get('/post/details/{id}/{slug}', 'BlogDetails');
    Route::get('/post/category/{id}/{slug}', 'BlogPostCategory');
    Route::post('/blog/comments', 'BlogComments')->name('comments.blog');
});

//Review All Route
Route::controller(ReviewController::class)->group(function () {
    Route::post('/store/review', 'StoreReview')->name('store.review');
});

//Shop Page All Route
Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'ShopPage')->name('shop.page');
    Route::post('/shop/filter', 'ShopFilter')->name('shop.filter');
});

//User All Route
Route::middleware(['auth', 'role:user'])->group(function () {

    //Wishlist All Route
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishList')->name('wishlist');
        Route::get('/get-wishlist-product', 'GetWishListProduct');
        Route::get('/wishlist-remove/{id}', 'WishListRemove');
    });

    //Compare All Route
    Route::controller(CompareController::class)->group(function () {
        Route::get('/compare', 'AllCompare')->name('compare');
        Route::get('/get-compare-product', 'GetCompareProduct');
        Route::get('/compare-remove/{id}', 'CompareRemove');
    });

    //Checkout All Route
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/district-get/ajax/{city_id}', 'DistrictGetAjax');
        Route::get('/commune-get/ajax/{district_id}', 'CommuneGetAjax');
        Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
    });

    //Stripe All Route
    Route::controller(StripeController::class)->group(function () {
        Route::post('/stripe/order', 'StripeOrder')->name('stripe.order');
        Route::get('/stripe/success', 'StripeSuccess')->name('stripe.success');
        Route::get('/stripe/cancel', 'StripeCancel')->name('stripe.cancel');
    });

    //Paypal All Route
    Route::controller(PaypalController::class)->group(function () {
        Route::post('/paypal/order', 'PaypalOrder')->name('paypal.order');
        Route::get('/paypal/success', 'PaypalSuccess')->name('paypal.success');
        Route::get('/paypal/cancel', 'PaypalCancel')->name('paypal.cancel');
    });

    //Mollie All Route
    Route::controller(MollieController::class)->group(function () {
        Route::post('/mollie/order', 'MollieOrder')->name('mollie.order');
        Route::get('/mollie/success', 'MollieSuccess')->name('mollie.success');
        Route::get('/mollie/cancel', 'MollieCancel')->name('mollie.cancel');
    });

    //Cash All Route
    Route::controller(CashController::class)->group(function () {
        Route::post('/cash/order', 'CashOrder')->name('cash.order');
    });

    //User Dashboard All Route
    Route::controller(AllUserController::class)->group(function () {
        Route::get('/user/account/page', 'UserAccount')->name('user.account.page');
        Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');
        Route::get('/user/order/page', 'UserOrderPage')->name('user.order.page');
        Route::get('/user/order/details/{order_id}', 'UserOrderDetails');
        Route::get('/user/invoice/download/{order_id}', 'UserInvoiceDownload');
        Route::get('/user/return/order/page', 'ReturnOrderPage')->name('user.return.order.page');
        Route::post('/user/return/order/{order_id}', 'ReturnOrderSubmit')->name('user.return.order');
        Route::get('/user/cancel/order/page', 'CancelOrderPage')->name('user.cancel.order.page');
        Route::post('/user/cancel/order/submit', 'CancelOrderSubmit')->name('user.cancel.order.submit');
    });
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    //User Dashborad
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
}); //End Group Middleware User

Route::middleware(['auth', 'role:admin'])->group(function () {

    //Admin Dashborad
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    //Brand All Route
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::post('/update/brand', 'UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
    });

    //Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    //SubCategory All Route
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubcategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'UpdateSubcategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubcategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
    });

    //Product All Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::post('/update/product/thumbnail', 'UpdateProductThumbnail')->name('update.product.thumbnail');
        Route::post('/update/product/multipleimages', 'UpdateProductMultipleImages')->name('update.product.multipleimages');
        Route::post('/add/new/product/multipleimages', 'AddNewProductMultipleImages')->name('add.new.product.multipleimages');
        Route::get('/product/multipleimages/delete/{id}', 'MultipleImagesDelete')->name('product.multipleimages.delete');
        Route::get('/product/inactive/{id}', 'ProductInActive')->name('product.inactive');
        Route::get('/product/active/{id}', 'ProductActive')->name('product.active');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
        Route::get('/restore/product', 'RestoreProduct')->name('restore.product');
        Route::get('/restore/product/submit/{id}', 'RestoreProductSubmit')->name('restore.product.submit');
        Route::get('/product/force/delete/{id}', 'ForceDeleteProduct')->name('force.delete.product');
        Route::get('/product/stock', 'ProductStock')->name('product.stock');
        Route::get('/add/product/from/returned/order', 'AddProductFromReturnedOrder')->name('add.product.from.returned.order');
        Route::get('/view/product/from/returned/order/{order_id}', 'ViewProductFromReturnedOrder')->name('view.product.from.returned.order');
        Route::get('/view/add/product/from/returned/order/{product_id}', 'ViewAddProductFromReturnedOrder')->name('view.add.product.from.returned_orders');
        Route::post('/store/product/from/returned/order', 'StoreProductFromReturnedOrder')->name('store.product.from.returned_orders');
        Route::get('/delete/product/from/returned/order/{order_id}/{product_id}', 'DeleteProductFromReturnedOrder')->name('delete.product.from.returned_orders');
    });

    //Slider All Route
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
    });

    //Banner All Route
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::post('/update/banner', 'UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    //Coupon All Route
    Route::controller(CouponController::class)->group(function () {
        Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon', 'StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon', 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
    });

    //Shipping City All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/city', 'AllCity')->name('all.city');
        Route::get('/add/city', 'AddCity')->name('add.city');
        Route::post('/store/city', 'StoreCity')->name('store.city');
        Route::get('/edit/city/{id}', 'EditCity')->name('edit.city');
        Route::post('/update/city', 'UpdateCity')->name('update.city');
        Route::get('/delete/city/{id}', 'DeleteCity')->name('delete.city');
    });

    //Shipping District All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/district', 'AllDistrict')->name('all.district');
        Route::get('/add/district', 'AddDistrict')->name('add.district');
        Route::post('/store/district', 'StoreDistrict')->name('store.district');
        Route::get('/edit/district/{id}', 'EditDistrict')->name('edit.district');
        Route::post('/update/district', 'UpdateDistrict')->name('update.district');
        Route::get('/delete/district/{id}', 'DeleteDistrict')->name('delete.district');
    });

    //Shipping Commune All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/commune', 'AllCommune')->name('all.commune');
        Route::get('/add/commune', 'AddCommune')->name('add.commune');
        Route::post('/store/commune', 'StoreCommune')->name('store.commune');
        Route::get('/edit/commune/{id}', 'EditCommune')->name('edit.commune');
        Route::post('/update/commune', 'UpdateCommune')->name('update.commune');
        Route::get('/delete/commune/{id}', 'DeleteCommune')->name('delete.commune');
        Route::get('/district/ajax/{city_id}', 'GetDistrict');
    });


    //Order All Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('/pending/order', 'PendingOrder')->name('pending.order');
        Route::get('/admin/order/details/{order_id}', 'AdminOrderDetails')->name('admin.order.details');
        Route::get('/admin/confirmed/order', 'AdminConfirmedOrder')->name('admin.confirmed.order');
        Route::get('/admin/processing/order', 'AdminProcessingOrder')->name('admin.processing.order');
        Route::get('/admin/delivered/order', 'AdminDeliveredOrder')->name('admin.delivered.order');
        Route::get('/pending/confirm/{order_id}', 'PendingToConfirm')->name('pending-confirm');
        Route::get('/confirm/processing/{order_id}', 'ConfirmToProcessing')->name('confirm-processing');
        Route::get('/processing/delivered/{order_id}', 'ProcessingToDelivered')->name('processing-delivered');
        Route::get('/amin/invoice/download/{order_id}', 'AdminInvoiceDownload')->name('admin.invoice.download');

        //Update Status Notification
        Route::get('/update-status/new-order/{id}', 'UpdateStatusNewOrder');
    });

    //Return Order All Route
    Route::controller(ReturnController::class)->group(function () {
        Route::get('/admin/return/request', 'ReturnRequest')->name('admin.return.request');
        Route::get('/admin/return/order/details/{order_id}', 'ReturnOrderDetails')->name('admin.return.order.details');
        Route::get('/admin/return/request/approved/{order_id}', 'ReturnRequestApproved')->name('admin.return.request.approved');
        Route::get('/admin/complete/return/request', 'CompleteReturnRequest')->name('admin.complete.return.request');

        //Update Status Notification
        Route::get('/update-status/return-order/{id}', 'UpdateStatusReturnOrder');
    });

    //Cancel Order All Route
    Route::controller(CancelController::class)->group(function () {
        Route::get('/admin/cancel/order/details/{order_id}', 'CancelOrderDetails')->name('admin.cancel.order.details');
        Route::get('/admin/complete/cancel/request', 'CompleteCancelRequest')->name('admin.complete.cancel.request');

        //Update Status Notification
        Route::get('/update-status/cancel-order/{id}', 'UpdateStatusCancelOrder');
    });

    //Report All Route
    Route::controller(ReportController::class)->group(function () {
        Route::get('/report/view', 'ReportView')->name('report.view');
        Route::post('/search/by/date', 'SearchByDate')->name('search-by-date');
        Route::post('/search/by/month', 'SearchByMonth')->name('search-by-month');
        Route::post('/search/by/year', 'SearchByYear')->name('search-by-year');
        Route::get('/report/by/customer', 'ReportByCustomer')->name('report.by.customer');
        Route::post('/search/by/customer', 'SearchByCustomer')->name('search-by-customer');
    });

    //Active Customer All Route
    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('/all/user', 'AllUser')->name('all.user');

        //Update Status Notification
        Route::get('/update-status/new-customer/{id}', 'UpdateStatusNewCustomer');
    });

    //Blog All Category Route
    Route::controller(BlogController::class)->group(function () {
        Route::get('/admin/blog/category', 'AllBlogCateogry')->name('admin.blog.category');
        Route::get('/admin/add/blog/category', 'AddBlogCateogry')->name('add.blog.categroy');
        Route::post('/admin/store/blog/category', 'StoreBlogCateogry')->name('store.blog.category');
        Route::get('/admin/edit/blog/category/{id}', 'EditBlogCateogry')->name('edit.blog.category');
        Route::post('/admin/update/blog/category', 'UpdateBlogCateogry')->name('update.blog.category');
        Route::get('/admin/delete/blog/category/{id}', 'DeleteBlogCateogry')->name('delete.blog.category');
    });

    //Blog Post All Route
    Route::controller(BlogController::class)->group(function () {
        Route::get('/admin/blog/post', 'AllBlogPost')->name('admin.blog.post');
        Route::get('/admin/add/blog/post', 'AddBlogPost')->name('add.blog.post');
        Route::post('/admin/store/blog/post', 'StoreBlogPost')->name('store.blog.post');
        Route::get('/admin/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
        Route::post('/admin/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
        Route::get('/admin/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');
        Route::get('/admin/blog/comment', 'AdminBlogComment')->name('admin.blog.comment');
        Route::get('/admin/blog/comment/reply/{id}', 'AdminCommentReply')->name('admin.comment.reply');
        Route::post('/admin/blog/comment/reply/submit', 'AdminReplyCommentSubmit')->name('admin.reply.comment.submit');
        Route::get('/admin/blog/comment/reply/edit/{id}', 'AdminCommentReplyEdit')->name('admin.comment.reply.edit');
        Route::post('/admin/blog/comment/reply/update', 'AdminReplyCommentUpdate')->name('admin.reply.comment.update');

        //Update Status Notification
        Route::get('/update-status/blog-comment/{id}', 'UpdateStatusBlogComment');
    });

    //Review All Route
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/admin/pending/review', 'PendingReview')->name('admin.pending.review');
        Route::get('/admin/publish/review', 'PublishReview')->name('admin.publish.review');
        Route::get('/admin/review/details/{id}', 'ReviewDetails')->name('admin.review.details');
        Route::post('/admin/review/approve', 'ReviewApprove')->name('admin.review.approve');
        Route::get('/admin/review/delete/{id}', 'ReviewDelete')->name('admin.review.delete');

        //Update Status Notification
        Route::get('/update-status/new-review-product/{id}', 'UpdateStatusNewReviewProduct');
    });

    //Site Setting All Route
    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/admin/site/setting', 'SiteSetting')->name('admin.site.setting');
        Route::post('/admin/site/setting/update', 'SiteSettingUpdate')->name('admin.site.setting.update');
        Route::get('/admin/seo/setting', 'SeoSetting')->name('admin.seo.setting');
        Route::post('/admin/seo/setting/update', 'SeoSettingUpdate')->name('admin.seo.setting.update');
        Route::get('/admin/smtp/setting', 'SmtpSetting')->name('admin.smtp.setting');
        Route::post('admin/update/smpt/setting', 'UpdateSmtpSetting')->name('admin.update.smpt.setting');
    });

    //Role And Permission All Route
    Route::controller(RoleController::class)->group(function () {
        //Permission
        Route::get('/admin/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/admin/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/admin/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/admin/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/admin/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/admin/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
        //Role
        Route::get('/admin/all/role', 'AllRole')->name('all.role');
        Route::get('/admin/add/role', 'AddRole')->name('add.role');
        Route::post('/admin/store/role', 'StoreRole')->name('store.role');
        Route::get('/admin/edit/role/{id}', 'EditRole')->name('edit.role');
        Route::post('/admin/update/role', 'UpdateRole')->name('update.role');
        Route::get('/admin/delete/role/{id}', 'DeleteRole')->name('delete.role');
        //Role Has Permissions
        Route::get('/admin/add/role/permissions', 'AddRolePermissions')->name('add.role.permissions');
        Route::post('/admin/role/permissions/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/admin/all/role/permissions', 'AllRolePermissions')->name('all.role.permissions');
        Route::get('/admin/edit/role/permissions/{id}', 'AdminEditRolePermissions')->name('admin.edit.role');
        Route::post('/admin/update/role/permissions/{id}', 'AdminUpdateRolePermissions')->name('admin.update.role');
        Route::get('/admin/delete/role/permissions/{id}', 'AdminDeleteRolePermissions')->name('admin.delete.role');
        //Import And Export All Route
        Route::get('/admin/import/permission', 'ImportPermission')->name('admin.import.permission');
        Route::get('/admin/export/permission', 'ExportPermission')->name('admin.export.permission');
        Route::post('/admin/import/permission/submit', 'ImportPermissionSubmit')->name('admin.import.permission.submit');
    });

    //Admin User Account All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/admin/account', 'AllAdminAccount')->name('all.admin.account');
        Route::get('/add/admin/account', 'AddAdminAccount')->name('add.admin.account');
        Route::post('/add/admin/account/store', 'AdminAccountStore')->name('admin.account.store');
        Route::get('/edit/admin/role/{id}', 'EditAdminRole')->name('edit.admin.role');
        Route::post('/admin/account/update/{id}', 'AdminAccountUpdate')->name('admin.account.update');
        Route::get('/delete/admin/role/{id}', 'DeleteAdminRole')->name('delete.admin.role');
    });

    //Employee All Route
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/admin/all/employee', 'AllEmployee')->name('all.employee');
        Route::get('/admin/add/employee', 'AddEmployee')->name('add.employee');
        Route::post('/admin/store/employee', 'StoreEmployee')->name('store.employee');
        Route::get('/admin/edit/employee/{id}', 'EditEmployee')->name('edit.employee');
        Route::post('/admin/update/employee', 'UpdateEmployee')->name('update.employee');
        Route::get('/admin/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee');
    });

    //Advance Salary All Route
    Route::controller(SalaryController::class)->group(function () {
        Route::get('/admin/all/advance/salary', 'AllAdvanceSalary')->name('all.advance.salary');
        Route::get('/admin/add/advance/salary', 'AddAdvanceSalary')->name('add.advance.salary');
        Route::post('/admin/advance/salary/store', 'StoreAdvanceSalary')->name('store.advance.salary');
        Route::get('/admin/advance/salary/edit/{id}', 'EditAdvanceSalary')->name('edit.advance.salary');
        Route::post('/admin/advance/salary/update', 'UpdateAdvanceSalary')->name('update.advance.salary');
        Route::get('/admin/advance/salary/delete/{id}', 'DeleteAdvanceSalary')->name('delete.advance.salary');
    });

    //Pay Salary All Route
    Route::controller(SalaryController::class)->group(function () {
        Route::get('/admin/pay/salary', 'PaySalary')->name('pay.salary');
        Route::get('/admin/pay/now/salary/{id}', 'PayNowSalary')->name('pay.now.salary');
        Route::post('/admin/employe/salary/store', 'EmployeSalaryStore')->name('employe.salary.store');
        Route::get('/admin/salary/by/month', 'MonthSalary')->name('month.salary');
        Route::post('/admin/salary/search/by/month', 'MonthSalarySearch')->name('month.salary.search');
    });

    //Employee Attendance All Route
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/admin/employee/attendance/list', 'EmployeeAttendanceList')->name('employee.attendance.list');
        Route::get('/admin/add/employee/attendance', 'AddEmployeeAttendance')->name('add.employee.attendance');
        Route::post('/admin/employee/attendance/store', 'EmployeeAttendanceStore')->name('employee.attendance.store');
        Route::get('/admin/edit/employee/attendance/{date}', 'EditEmployeeAttendance')->name('employee.attendance.edit');
        Route::get('/admin/view/employee/attendance/{date}', 'ViewEmployeeAttendance')->name('employee.attendance.view');
        Route::get('/admin/timekeeping/by/month', 'TimekeepingByMonth')->name('timekeeping.by.month');
        Route::post('/admin/timekeeping/search/by/month', 'TimekeepingSearchByMonth')->name('timekeeping.search.by.month');
    });

    //Contact All Route
    Route::controller(ContactMessageController::class)->group(function () {
        Route::get('/admin/contact/message', 'Index')->name('admin.contact.message');
        Route::get('/admin/contact/message/details/{id}', 'ContactMessageDetails')->name('admin.contact.message.details');
        Route::post('/admin/contact/message/send/reply', 'ContactMessageReply')->name('admin.contact.message.send.reply');
        Route::get('/admin/contact/message/delete/{id}', 'ContactMessageDelete')->name('admin.contact.message.delete');

        //Update Status Notification
        Route::get('/update-status/new-contact-message/{id}', 'UpdateStatusNewContactMessage');
    });

    //Subscriber All Route
    Route::controller(AdminSubscriberController::class)->group(function () {
        Route::get('/admin/subscriber/all', 'ShowAll')->name('admin_subscribers');
        Route::get('/admin/subscriber/delete/{id}', 'DeleteSubscriber')->name('admin.delete.subscriber');
        Route::get('/admin/subscriber/send-email', 'SendEmail')->name('admin_subscribers_send_email');
        Route::post('/admin/subscriber/send-email-submit', 'SendEmailSubmit')->name('admin_subscribers_send_email_submit');

        //Update Status Notification
        Route::get('/update-status/new-subscriber/{id}', 'UpdateStatusNewSubscriber');
    });

    //Admin Delete All Notification
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/delete/all/notification', 'DeleteAllNotification')->name('admin.delete.all.notification');
    });

    //Database Backup
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/database/backup', 'DatabaseBackup')->name('database.backup');
        Route::get('/admin/backup/now', 'BackupNow');
        Route::get('{getFilename}', 'DownloadDatabase');
        Route::get('/admin/delete/database/{getFilename}', 'DeleteDatabase');
    });
}); //End Group Middleware Admin

//Admin Route
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/admin/forgot/password', [AdminController::class, 'AdminForgotPassword'])->name('admin.forgot.password');
Route::post('/admin/forgot/password/submit', [AdminController::class, 'AdminForgotPasswordSubmit'])->name('admin.forgot.password.submit');
Route::get('/admin/reset/password/{token}/{email}', [AdminController::class, 'AdminResetPassword'])->name('admin.reset.password');
Route::post('/admin/reset/password/submit', [AdminController::class, 'AdminResetPasswordSubmit'])->name('admin.reset.password.submit');
