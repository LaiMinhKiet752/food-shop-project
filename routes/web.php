<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Backend\VendorProductController;
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
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Frontend\ShopController;
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
    Route::get('/vendor/details/{id}', 'VendorDetails')->name('vendor.details');
    Route::get('/vendor/all', 'VendorAll')->name('vendor.all');
    Route::get('/product/category/{id}/{slug}', 'CategoryWiseProduct');
    Route::get('/product/subcategory/{id}/{slug}', 'SubCategoryWiseProduct');
    // Product View Modal With Ajax
    Route::get('/product/view/modal/{id}', 'ProductViewAjax');
    //Product Search
    Route::post('/product/search', 'ProductSearch')->name('product.search');
    Route::post('/search-product', 'SearchProduct');
});

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
    Route::post('/vendor/details/product/cart/store/{id}', 'AddToCartVendorDetailsProduct');
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

//Frontend All Route
Route::get('/privacy-policy', [FrontendController::class, 'PrivacyPolicy'])->name('privacy_policy');

//Captcha
Route::get('/reload-captcha', [RegisteredUserController::class, 'ReloadCaptcha']);

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

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    //User Dashborad
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
}); //End Group Middleware User

Route::middleware(['auth', 'role:vendor'])->group(function () {

    //Vendor Dashborad
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');

    //Vendor Add Product All Route
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');
        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thumbnail', 'VendorUpdateProductThumbnail')->name('vendor.update.product.thumbnail');
        Route::post('/vendor/update/product/multipleimages', 'VendorUpdateProductMultipleImages')->name('vendor.update.product.multipleimages');
        Route::post('/vendor/add/new/product/multipleimages', 'VendorAddNewProductMultipleImages')->name('vendor.add.new.product.multipleimages');
        Route::get('/vendor/product/multipleimages/delete/{id}', 'VendorMultipleimagesDelete')->name('vendor.product.multipleimages.delete');
        Route::get('/vendor/product/inactive/{id}', 'VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}', 'VendorProductActive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}', 'VendorProductDelete')->name('vendor.delete.product');
        Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubCategory');
        Route::get('/vendor/restore/product', 'VendorRestoreProduct')->name('vendor.restore.product');
        Route::get('/vendor/restore/product/submit/{id}', 'VendorRestoreProductSubmit')->name('vendor.restore.product.submit');
        Route::get('/vendor/restore/all/product/submit', 'VendorRestoreAllProductSubmit')->name('vendor.restore.all.product.submit');
        Route::get('/vendor/product/stock', 'VendorProductStock')->name('vendor.product.stock');
    });

    //Vendor Order All Route
    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('/vendor/all/order', 'VendorOrder')->name('vendor.all.order');
        Route::get('/vendor/order/details/{order_id}', 'VendorOrderDetails')->name('vendor.order.details');
        Route::get('/vendor/return/order', 'VendorReturnOrder')->name('vendor.return.order');
        Route::get('/vendor/return/order/details/{order_id}', 'VendorReturnOrderDetails')->name('vendor.return.order.details');
        Route::get('/vendor/complete/return/order', 'VendorCompleteReturnOrder')->name('vendor.complete.return.order');
        Route::get('/vendor/cancel/order', 'VendorCancelOrder')->name('vendor.cancel.order');
        Route::get('/vendor/cancel/order/details/{order_id}', 'VendorCancelOrderDetails')->name('vendor.cancel.order.details');
        Route::get('/vendor/complete/cancel/order', 'VendorCompleteCancelOrder')->name('vendor.complete.cancel.order');
    });

    //Vendor Review All Route
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/vendor/all/review', 'VendorAllReview')->name('vendor.all.review');
        Route::get('/vendor/review/details/{id}', 'VendorReviewDetails')->name('vendor.review.details');
    });
}); //End Group Middleware Vendor

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
        Route::get('/restore/brand', 'RestoreBrand')->name('restore.brand');
        Route::get('/restore/brand/submit/{id}', 'RestoreBrandSubmit')->name('restore.brand.submit');
        Route::get('/restore/all/brand/submit', 'RestoreAllBrandSubmit')->name('restore.all.brand.submit');
    });

    //Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
        Route::get('/restore/category', 'RestoreCategory')->name('restore.category');
        Route::get('/restore/category/submit/{id}', 'RestoreCategorySubmit')->name('restore.category.submit');
        Route::get('/restore/all/category/submit', 'RestoreAllCategorySubmit')->name('restore.all.category.submit');
    });

    //SubCategory All Route
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubcategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'UpdateSubcategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubcategory')->name('delete.subcategory');
        Route::get('/restore/subcategory', 'RestoreSubcategory')->name('restore.subcategory');
        Route::get('/restore/subcategory/submit/{id}', 'RestoreSubcategorySubmit')->name('restore.subcategory.submit');
        Route::get('/restore/all/subcategory/submit', 'RestoreAllSubcategorySubmit')->name('restore.all.subcategory.submit');
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
        Route::get('/restore/all/product/submit', 'RestoreAllProductSubmit')->name('restore.all.product.submit');
        Route::get('/product/stock', 'ProductStock')->name('product.stock');
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
        Route::get('/restore/coupon', 'RestoreCoupon')->name('restore.coupon');
        Route::get('/restore/coupon/submit/{id}', 'RestoreCouponSubmit')->name('restore.coupon.submit');
        Route::get('/restore/all/coupon/submit', 'RestoreAllCouponSubmit')->name('restore.all.coupon.submit');
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

    //Vendor Active And Inactive All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/inactive/vendor', 'InActiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}', 'InActiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');
        Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve', 'InActiveVendorApprove')->name('inactive.vendor.approve');
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
    });

    //Return Order All Route
    Route::controller(ReturnController::class)->group(function () {
        Route::get('/admin/return/request', 'ReturnRequest')->name('admin.return.request');
        Route::get('/admin/return/order/details/{order_id}', 'ReturnOrderDetails')->name('admin.return.order.details');
        Route::get('/admin/return/request/approved/{order_id}', 'ReturnRequestApproved')->name('admin.return.request.approved');
        Route::get('/admin/complete/return/request', 'CompleteReturnRequest')->name('admin.complete.return.request');
    });

    //Cancel Order All Route
    Route::controller(CancelController::class)->group(function () {
        Route::get('/admin/cancel/request', 'CancelRequest')->name('admin.cancel.request');
        Route::get('/admin/cancel/order/details/{order_id}', 'CancelOrderDetails')->name('admin.cancel.order.details');
        Route::get('/admin/cancel/request/approved/{order_id}', 'CancelRequestApproved')->name('admin.cancel.request.approved');
        Route::get('/admin/complete/cancel/request', 'CompleteCancelRequest')->name('admin.complete.cancel.request');
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

    //Active Customer And Vendor All Route
    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('/all/user', 'AllUser')->name('all.user');
        Route::get('/all/vendor', 'AllVendor')->name('all.vendor');
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
    });

    //Review All Route
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/admin/pending/review', 'PendingReview')->name('admin.pending.review');
        Route::get('/admin/publish/review', 'PublishReview')->name('admin.publish.review');
        Route::get('/admin/review/details/{id}', 'ReviewDetails')->name('admin.review.details');
        Route::post('/admin/review/approve', 'ReviewApprove')->name('admin.review.approve');
        Route::get('/admin/review/delete/{id}', 'ReviewDelete')->name('admin.review.delete');
    });

    //Site Setting All Route
    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/admin/site/setting', 'SiteSetting')->name('admin.site.setting');
        Route::post('/admin/site/setting/update', 'SiteSettingUpdate')->name('admin.site.setting.update');
        Route::get('/admin/seo/setting', 'SeoSetting')->name('admin.seo.setting');
        Route::post('/admin/seo/setting/update', 'SeoSettingUpdate')->name('admin.seo.setting.update');
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

    //Database Backup
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/database/backup', 'DatabaseBackup')->name('database.backup');
        Route::get('/admin/backup/now', 'BackupNow');
        Route::get('{getFilename}', 'DownloadDatabase');
        Route::get('/admin/delete/database/{getFilename}', 'DeleteDatabase');
    });
}); //End Group Middleware Admin

//Admin Login Route
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

//Vendor Login Route
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');
Route::get('/vendor/register/reload-captcha', [VendorController::class, 'ReloadCaptcha']);

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
        Route::get('/user/return/order/details/{order_id}', 'ReturnOrderDetails')->name('user.return.order.details');
        Route::get('/user/cancel/order/page', 'CancelOrderPage')->name('user.cancel.order.page');
        Route::post('/user/cancel/order/submit', 'CancelOrderSubmit')->name('user.cancel.order.submit');
        Route::get('/user/cancel/order/details/{order_id}', 'CancelOrderDetails')->name('user.cancel.order.details');
        Route::get('/user/track/order/page', 'UserTrackOrderPage')->name('user.track.order.page');
        Route::post('/user/order/tracking', 'UserOrderTracking')->name('user.order.tracking');
    });
});
