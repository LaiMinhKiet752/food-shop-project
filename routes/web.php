<?php

use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\WishlistController;

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

// Route::get('/', function () {
//     return view('frontend.index');
// });


//Index All Route
Route::get('/', [IndexController::class, 'Index']);

//Frontend Product Details All Route
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');
Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CategoryWiseProduct']);
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCategoryWiseProduct']);
// Product View Modal With Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);


//FrontendController
Route::get('/privacy-policy', [FrontendController::class, 'PrivacyPolicy'])->name('privacy_policy');


Route::middleware(['auth', 'verified'])->group(function () {
    //Vendor Dashborad
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
}); //End Group Middleware 'Auth' And 'Email Verified'



Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');


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
    });
}); //End Group Middlware Vendor



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

    //Shipping Division All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/division', 'AllDivision')->name('all.division');
        Route::get('/add/division', 'AddDivision')->name('add.division');
        Route::post('/store/division', 'StoreDivision')->name('store.division');
        Route::get('/edit/division/{id}', 'EditDivision')->name('edit.division');
        Route::post('/update/division', 'UpdateDivision')->name('update.division');
        Route::get('/delete/division/{id}', 'DeleteDivision')->name('delete.division');
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

    //Shipping State All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/state', 'AllState')->name('all.state');
        Route::get('/add/state', 'AddState')->name('add.state');
        Route::post('/store/state', 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}', 'EditState')->name('edit.state');
        Route::post('/update/state', 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state');
        Route::get('/district/ajax/{division_id}', 'GetDistrict');
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
}); //End Group Middleware Admin



//Add To Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

//Get Data From Mini Cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

//Remove Data From Mini Cart
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

//Product Details Page Add To Cart
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);

//Home New Product Page Add To Cart
Route::post('/home/new/product/cart/store/{id}', [CartController::class, 'AddToCartHomeNewProduct']);

//Home New Product Category Page Add To Cart
Route::post('/home/new/product/category/cart/store/{id}', [CartController::class, 'AddToCartHomeNewProductCategory']);

//Featured Product Page Add To Cart
Route::post('/featured/product/cart/store/{id}', [CartController::class, 'AddToCartFeaturedProduct']);

//Category Product Page Add To Cart
Route::post('/category/product/cart/store/{id}', [CartController::class, 'AddToCartCategoryProduct']);

//SubCategory Product Page Add To Cart
Route::post('/subcategory/product/cart/store/{id}', [CartController::class, 'AddToCartSubCategoryProduct']);

//Related Product Page Add To Cart
Route::post('/related/product/cart/store/{id}', [CartController::class, 'AddToCartRelatedProduct']);

//Vendor Details Page Add To Cart
Route::post('/vendor/details/product/cart/store/{id}', [CartController::class, 'AddToCartVendorDetailsProduct']);

//Category One Page Add To Cart
Route::post('/categoryone/product/cart/store/{id}', [CartController::class, 'AddToCartCategoryOneProduct']);

//Category Two Page Add To Cart
Route::post('/categorytwo/product/cart/store/{id}', [CartController::class, 'AddToCartCategoryTwoProduct']);

//Category Three Page Add To Cart
Route::post('/categorythree/product/cart/store/{id}', [CartController::class, 'AddToCartCategoryThreeProduct']);

//Category Four Page Add To Cart
Route::post('/categoryfour/product/cart/store/{id}', [CartController::class, 'AddToCartCategoryFourProduct']);

//Category Five Page Add To Cart
Route::post('/categoryfive/product/cart/store/{id}', [CartController::class, 'AddToCartCategoryFiveProduct']);

//Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

//Checkout Page Route
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

//Cart All Route
Route::controller(CartController::class)->group(function () {
    Route::get('/my-cart', 'MyCart')->name('mycart');
    Route::get('/get-cart-product', 'GetCartProduct');
    Route::get('/cart-remove/{rowId}', 'CartRemove');
    Route::get('/cart-decrement/{rowId}', 'CartDecrement');
    Route::get('/cart-increment/{rowId}', 'CartIncrement');
});

//Add To Wishlist
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'addToWishList']);

//Add To Compare
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'addToCompare']);

//User All Route
Route::middleware(['auth'])->group(function () {
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
        Route::get('/district-get/ajax/{division_id}', 'DistrictGetAjax');
        Route::get('/state-get/ajax/{district_id}', 'StateGetAjax');
    });
});


require __DIR__ . '/auth.php';
