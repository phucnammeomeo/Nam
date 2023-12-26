<?php

use App\Http\Controllers\address\backend\AddressController;
//article module
use App\Http\Controllers\article\backend\ArticleController;
use App\Http\Controllers\article\backend\CategoryController as BackendCategoryController;
//product module
use App\Http\Controllers\product\backend\CategoryController;
use App\Http\Controllers\product\backend\ProductController;
//attribute module
use App\Http\Controllers\attribute\backend\CategoryController as AttributeCategoryController;
use App\Http\Controllers\attribute\backend\AttributeController as AttributeController;
//brand module
use App\Http\Controllers\brand\backend\BrandController;
use App\Http\Controllers\cashbook\PaymentGroupsController;
use App\Http\Controllers\cashbook\PaymentVouchersController;
use App\Http\Controllers\cashbook\ReceiptVouchersController;
//mã giảm giá module
use App\Http\Controllers\coupon\CounponController;
//Order, đặt hàng module
use App\Http\Controllers\order\backend\OrderController;

//comment module
use App\Http\Controllers\comment\backend\CommentController;
//media module
use App\Http\Controllers\media\backend\CategoryController as MediaBackendCategoryController;
use App\Http\Controllers\media\backend\MediaController;
//menu module
use App\Http\Controllers\menu\backend\MenuController;
//slide module
use App\Http\Controllers\slide\backend\SlideController;
///tag module
use App\Http\Controllers\tag\backend\TagController;
//khách hàng module
use App\Http\Controllers\customer\backend\CustomerController;
//user ADMIN
use App\Http\Controllers\user\backend\AuthController;
use App\Http\Controllers\user\backend\PermissionController;
use App\Http\Controllers\user\backend\ResetPasswordController;
use App\Http\Controllers\user\backend\RolesController;
use App\Http\Controllers\user\backend\UsersController;

use App\Http\Controllers\keyword\backend\KeyWordController;

//contact module
use App\Http\Controllers\contact\backend\ContactController;
//page module
use App\Http\Controllers\page\backend\PageController;

//global admin => module
use App\Http\Controllers\components\ComponentsController;
use App\Http\Controllers\config\ConfigColumController;
use App\Http\Controllers\config\ConfigEmailController;
use App\Http\Controllers\config\ConfigImageController;
use App\Http\Controllers\config\ConfigIsController;
use App\Http\Controllers\customer\backend\CustomerCategoryController;
use App\Http\Controllers\customer\backend\CustomerLogsController;
use App\Http\Controllers\customer\backend\CustomerSocialController;
use App\Http\Controllers\customer\backend\OrderController as BackendOrderController;
use App\Http\Controllers\dashboard\AjaxController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\general\GeneralController;
use App\Http\Controllers\order\backend\OrderLogsController;
use App\Http\Controllers\product\backend\ProductPurchaseController;
use App\Http\Controllers\ship\backend\ShipController;
use App\Http\Controllers\suppliers\SuppliersCategoryController;
use App\Http\Controllers\suppliers\SuppliersController;
use App\Http\Controllers\tax\TaxController;
use App\Http\Controllers\website\WebsiteController;
use App\Models\SuppliersCategory;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => env('APP_ADMIN'), 'middleware' => ['guest:web']], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'store'])->name('admin.login-store');
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('admin.reset-password');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('admin.reset-password-store');
    Route::get('/reset-password-new', [ResetPasswordController::class, 'reset_password_new'])->name('admin.reset-password-new');
});

Route::group(['middleware' => 'locale'], function () {
    Route::group(['prefix' => env('APP_ADMIN'), 'middleware' => ['auth:web']], function () {

        Route::group(['prefix' => '/dashboard'], function () {
            Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
            Route::post('/search/order', [DashboardController::class, 'searchOrder'])->name('admin.searchOrder');
            Route::post('/search/order-status', [DashboardController::class, 'searchOrderStatus'])->name('admin.searchOrderStatus');
            Route::post('/search/order-payment-item', [DashboardController::class, 'searchOrderProduct'])->name('admin.searchOrderProduct');
        });

        // từ gợi ý
        Route::group(['prefix' => '/keywords'], function () {
            Route::get('/index', [KeyWordController::class, 'index'])->name('keywords.index')->middleware('can:keywords_index');
            Route::get('/create', [KeyWordController::class, 'create'])->name('keywords.create')->middleware('can:keywords_create');
            Route::post('/store', [KeyWordController::class, 'store'])->name('keywords.store');
            Route::get('/edit/{id}', [KeyWordController::class, 'edit'])->name('keywords.edit')->middleware('can:keywords_edit');
            Route::post('/update/{id}', [KeyWordController::class, 'update'])->name('keywords.update')->middleware('can:keywords_edit');
            Route::get('/destroy/{id}', [KeyWordController::class, 'destroy'])->name('keywords.destroy')->middleware('can:keywords_destroy');
        });

        //configure
        Route::group(['prefix' => '/config-is'], function () {
            Route::get('/index', [ConfigIsController::class, 'index'])->name('configIs.index');
            Route::get('/create', [ConfigIsController::class, 'create'])->name('configIs.create');
            Route::post('/store', [ConfigIsController::class, 'store'])->name('configIs.store');
            Route::get('/edit/{id}', [ConfigIsController::class, 'edit'])->name('configIs.edit');
            Route::post('/update/{id}', [ConfigIsController::class, 'update'])->name('configIs.update');
            Route::get('/destroy/{id}', [ConfigIsController::class, 'destroy'])->name('configIs.destroy');
        });
        Route::group(['prefix' => '/config-colums'], function () {
            Route::get('/index', [ConfigColumController::class, 'index'])->name('config_colums.index');
            Route::get('/create', [ConfigColumController::class, 'create'])->name('config_colums.create');
            Route::post('/store', [ConfigColumController::class, 'store'])->name('config_colums.store');
            Route::get('/edit/{id}', [ConfigColumController::class, 'edit'])->name('config_colums.edit');
            Route::post('/update/{id}', [ConfigColumController::class, 'update'])->name('config_colums.update');
            Route::post('/destroy', [ConfigColumController::class, 'destroy'])->name('config_colums.destroy');
            Route::post('/ajax/delete-all', [ConfigColumController::class, 'deleteAll'])->name('config_colums.delete_all');
        });
        Route::group(['prefix' => '/config-emails'], function () {
            Route::get('/index', [ConfigEmailController::class, 'index'])->name('config_emails.index')->middleware('can:generals_index');
            Route::get('/create', [ConfigEmailController::class, 'create'])->name('config_emails.create')->middleware('can:generals_index');
            Route::post('/store', [ConfigEmailController::class, 'store'])->name('config_emails.store')->middleware('can:generals_index');
            Route::get('/edit/{id}', [ConfigEmailController::class, 'edit'])->name('config_emails.edit')->middleware('can:generals_index');
            Route::post('/update/{id}', [ConfigEmailController::class, 'update'])->name('config_emails.update')->middleware('can:generals_index');
        });
        Route::group(['prefix' => '/config-images'], function () {
            Route::get('/index', [ConfigImageController::class, 'index'])->name('config_images.index')->middleware('can:generals_index');
            Route::get('/create', [ConfigImageController::class, 'create'])->name('config_images.create')->middleware('can:generals_index');
            Route::post('/store', [ConfigImageController::class, 'store'])->name('config_images.store')->middleware('can:generals_index');
            Route::get('/edit/{id}', [ConfigImageController::class, 'edit'])->name('config_images.edit')->middleware('can:generals_index');
            Route::post('/update/{id}', [ConfigImageController::class, 'update'])->name('config_images.update')->middleware('can:generals_index');
        });
        //ajax
        Route::group(['prefix' => '/ajax'], function () {
            Route::post('/select2', [AjaxController::class, 'select2']);
            Route::post('/ajax-create', [AjaxController::class, 'ajax_create'])->name('ajax-create');
            Route::post('/ajax-delete', [AjaxController::class, 'ajax_delete']);
            Route::post('/ajax-delete-all', [AjaxController::class, 'ajax_delete_all']);
            Route::post('/ajax-order', [AjaxController::class, 'ajax_order']);
            Route::post('/publish-ajax', [AjaxController::class, 'ajax_publish']);
            Route::post('/get-select2', [AjaxController::class, 'get_select2']);
            Route::post('/pre-select2', [AjaxController::class, 'pre_select2']);
        });

        //cấu hình hệ thống
        Route::group(['prefix' => '/generals'], function () {
            Route::get('/', [GeneralController::class, 'index'])->name('generals.index');
            Route::get('/index', [GeneralController::class, 'general'])->name('generals.general')->middleware('can:generals_index');
            Route::post('/store', [GeneralController::class, 'store'])->name('generals.store')->middleware('can:generals_index');
        });

        //permission
        Route::group(['prefix' => '/permissions'], function () {
            Route::get('/index', [PermissionController::class, 'index'])->name('permissions.index');
            Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
            Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
        });
        //nhóm thành viên
        Route::group(['prefix' => '/roles'], function () {
            Route::get('/index', [RolesController::class, 'index'])->name('roles.index')->middleware('can:roles_index');
            Route::get('/create', [RolesController::class, 'create'])->name('roles.create')->middleware('can:roles_create');
            Route::post('/store', [RolesController::class, 'store'])->name('roles.store')->middleware('can:roles_create');
            Route::get('/edit/{id}', [RolesController::class, 'edit'])->name('roles.edit')->middleware('can:roles_edit');
            Route::post('/update/{id}', [RolesController::class, 'update'])->name('roles.update')->middleware('can:roles_edit');
            Route::get('/destroy/{id}', [RolesController::class, 'destroy'])->name('roles.destroy')->middleware('can:roles_destroy');
        });
        //Thành viên quản trị
        Route::group(['prefix' => '/users'], function () {
            Route::get('/index', [UsersController::class, 'index'])->name('users.index')->middleware('can:users_index');
            Route::get('/create', [UsersController::class, 'create'])->name('users.create')->middleware('can:users_create');
            Route::post('/store', [UsersController::class, 'store'])->name('users.store')->middleware('can:users_create');
            Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('users.edit')->middleware('can:users_edit');
            Route::post('/update/{id}', [UsersController::class, 'update'])->name('users.update')->middleware('can:users_edit');
            Route::get('/destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy')->middleware('can:roles_destroy');
            Route::get('/reset-password', [UsersController::class, 'reset_password'])->name('users.reset-password')->middleware('can:users_edit');
            //auth
            Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
            Route::get('/my-profile', [AuthController::class, 'profile'])->name('admin.profile');
            Route::post('/my-profile/{id}', [AuthController::class, 'profile_store'])->name('admin.profile-store');
            Route::get('/my-password', [AuthController::class, 'profile_password'])->name('admin.profile-password');
            Route::post('/my-password/{id}', [AuthController::class, 'profile_password_store'])->name('admin.profile-password-store');
        });
        //slide
        Route::group(['prefix' => '/slides'], function () {
            Route::get('/index', [SlideController::class, 'index'])->name('slides.index')->middleware('can:slides_index');
            Route::post('/store', [SlideController::class, 'store'])->name('slides.store')->middleware('can:slides_index');
            Route::post('/category_store', [SlideController::class, 'category_store'])->name('slides.category_store')->middleware('can:slides_index');
            Route::post('/category_update', [SlideController::class, 'category_update'])->name('slides.category_update')->middleware('can:slides_index');
            Route::post('/update', [SlideController::class, 'update'])->name('slides.update')->middleware('can:slides_index');
        });
        //danh mục attribute
        Route::group(['prefix' => '/category-attributes'], function () {
            Route::get('/index', [AttributeCategoryController::class, 'index'])->name('category_attributes.index')->middleware('can:category_attributes_index');
            Route::get('/create', [AttributeCategoryController::class, 'create'])->name('category_attributes.create')->middleware('can:category_attributes_create');
            Route::post('/store', [AttributeCategoryController::class, 'store'])->name('category_attributes.store')->middleware('can:category_attributes_create');
            Route::get('/edit/{id}', [AttributeCategoryController::class, 'edit'])->name('category_attributes.edit')->middleware('can:category_attributes_edit');
            Route::post('/update/{id}', [AttributeCategoryController::class, 'update'])->name('category_attributes.update')->middleware('can:category_attributes_edit');
            Route::get('/destroy/{id}', [AttributeCategoryController::class, 'destroy'])->name('category_attributes.destroy')->middleware('can:category_attributes_destroy');
        });
        //danh sách attribute
        Route::group(['prefix' => '/attributes'], function () {
            Route::get('/index', [AttributeController::class, 'index'])->name('attributes.index')->middleware('can:attributes_index');
            Route::get('/create', [AttributeController::class, 'create'])->name('attributes.create')->middleware('can:attributes_create');
            Route::post('/store', [AttributeController::class, 'store'])->name('attributes.store')->middleware('can:attributes_create');
            Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('attributes.edit')->middleware('can:attributes_edit');
            Route::post('/update/{id}', [AttributeController::class, 'update'])->name('attributes.update')->middleware('can:attributes_edit');
            Route::get('/destroy/{id}', [AttributeController::class, 'destroy'])->name('attributes.destroy')->middleware('can:attributes_destroy');
            Route::post('/select2', [AttributeController::class, 'select2']);
        });
        //danh mục sản phẩm
        Route::group(['prefix' => '/category-products'], function () {
            Route::get('/index', [CategoryController::class, 'index'])->name('category_products.index')->middleware('can:category_products_index');
            Route::get('/create', [CategoryController::class, 'create'])->name('category_products.create')->middleware('can:category_products_create');
            Route::post('/store', [CategoryController::class, 'store'])->name('category_products.store')->middleware('can:category_products_create');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category_products.edit')->middleware('can:category_products_edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category_products.update')->middleware('can:category_products_edit');
            Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category_products.destroy')->middleware('can:category_products_destroy');
        });
        //sản phẩm
        Route::group(['prefix' => '/products'], function () {
            Route::get('/index', [ProductController::class, 'index'])->name('products.index')->middleware('can:products_index');

            Route::get('/create', [ProductController::class, 'create'])->name('products.create')->middleware('can:products_create');
            Route::post('/store', [ProductController::class, 'store'])->name('products.store')->middleware('can:products_create');
            Route::get('/copy/{id}', [ProductController::class, 'copy'])->name('products.copy')->middleware('can:products_create');

            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit')->middleware('can:products_edit');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('can:products_edit');
            Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('can:products_destroy');
            Route::post('/delete', [ProductController::class, 'delete'])->name('products.delete')->middleware('can:products_destroy');
            Route::post('/delete-all', [ProductController::class, 'delete_all'])->name('products.deleteAll')->middleware('can:products_destroy');

            Route::post('/ajax/get-attrid', [ProductController::class, 'get_attrid']);
            Route::get('/ajax/list-product', [ProductController::class, 'listproduct']);
            Route::get('/ajax/index/pagination', [ProductController::class, 'pagination'])->middleware('can:products_index');
            Route::get('/excel/export-products', [ProductController::class, 'exportProducts'])->name('products.export');
        });
        //tag
        Route::group(['prefix' => '/tags'], function () {
            Route::get('/index', [TagController::class, 'index'])->name('tags.index')->middleware('can:tags_index');
            Route::get('/create', [TagController::class, 'create'])->name('tags.create')->middleware('can:tags_create');
            Route::post('/store', [TagController::class, 'store'])->name('tags.store');
            Route::get('/edit/{id}', [TagController::class, 'edit'])->name('tags.edit')->middleware('can:tags_edit');
            Route::post('/update/{id}', [TagController::class, 'update'])->name('tags.update')->middleware('can:tags_edit');
            Route::get('/destroy/{id}', [TagController::class, 'destroy'])->name('tags.destroy')->middleware('can:tags_destroy');
        });
        Route::group(['prefix' => '/brands'], function () {
            Route::get('/index', [BrandController::class, 'index'])->name('brands.index')->middleware('can:brands_index');
            Route::get('/create', [BrandController::class, 'create'])->name('brands.create')->middleware('can:brands_create');
            Route::post('/store', [BrandController::class, 'store'])->name('brands.store')->middleware('can:brands_create');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brands.edit')->middleware('can:brands_edit');
            Route::post('/update/{id}', [BrandController::class, 'update'])->name('brands.update')->middleware('can:brands_edit');
            Route::get('/destroy/{id}', [BrandController::class, 'destroy'])->name('brands.destroy')->middleware('can:brands_destroy');
        });
        Route::group(['prefix' => '/coupons'], function () {
            Route::get('/index', [CounponController::class, 'index'])->name('coupons.index')->middleware('can:coupons_index');
            Route::get('/create', [CounponController::class, 'create'])->name('coupons.create')->middleware('can:coupons_create');
            Route::post('/store', [CounponController::class, 'store'])->name('coupons.store')->middleware('can:coupons_create');
            Route::get('/edit/{id}', [CounponController::class, 'edit'])->name('coupons.edit')->middleware('can:coupons_edit');
            Route::post('/update/{id}', [CounponController::class, 'update'])->name('coupons.update')->middleware('can:coupons_edit');
            Route::get('/destroy/{id}', [CounponController::class, 'destroy'])->name('coupons.destroy')->middleware('can:coupons_destroy');
        });
        Route::group(['prefix' => '/ships'], function () {
            Route::get('/index', [ShipController::class, 'index'])->name('ships.index')->middleware('can:ships_index');
            Route::get('/province', [ShipController::class, 'province'])->name('ships.index_province')->middleware('can:ships_index');
            Route::get('/province/edit/{id}', [ShipController::class, 'edit_province'])->name('ships.edit_province')->middleware('can:ships_index');
            Route::post('/province/update/{id}', [ShipController::class, 'update_province'])->name('ships.update_province')->middleware('can:ships_index');
            Route::post('/update-one-province', [ShipController::class, 'update_one_province'])->middleware('can:ships_edit');
            Route::post('/update-all-province', [ShipController::class, 'update_all_province'])->middleware('can:ships_edit');
            Route::get('/create', [ShipController::class, 'create'])->name('ships.create')->middleware('can:ships_create');
            Route::post('/store', [ShipController::class, 'store'])->name('ships.store')->middleware('can:ships_create');
            Route::get('/edit/{id}', [ShipController::class, 'edit'])->name('ships.edit')->middleware('can:ships_edit');
            Route::post('/update/{id}', [ShipController::class, 'update'])->name('ships.update')->middleware('can:ships_edit');
            Route::get('/destroy/{id}', [ShipController::class, 'destroy'])->name('ships.destroy')->middleware('can:ships_destroy');
        });

        //danh mục article
        Route::group(['prefix' => '/category-articles'], function () {
            Route::get('/index', [BackendCategoryController::class, 'index'])->name('category_articles.index')->middleware('can:category_articles_index');
            Route::get('/create', [BackendCategoryController::class, 'create'])->name('category_articles.create')->middleware('can:category_articles_create');
            Route::post('/store', [BackendCategoryController::class, 'store'])->name('category_articles.store')->middleware('can:category_articles_create');
            Route::get('/edit/{id}', [BackendCategoryController::class, 'edit'])->name('category_articles.edit')->middleware('can:category_articles_edit');
            Route::post('/update/{id}', [BackendCategoryController::class, 'update'])->name('category_articles.update')->middleware('can:category_articles_edit');
            Route::get('/destroy/{id}', [BackendCategoryController::class, 'destroy'])->name('category_articles.destroy')->middleware('can:category_articles_destroy');
        });
        //danh sách article
        Route::group(['prefix' => '/articles'], function () {
            Route::get('/index', [ArticleController::class, 'index'])->name('articles.index')->middleware('can:articles_index');
            Route::get('/create', [ArticleController::class, 'create'])->name('articles.create')->middleware('can:articles_create');
            Route::post('/store', [ArticleController::class, 'store'])->name('articles.store');
            Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit')->middleware('can:articles_edit');
            Route::post('/update/{id}', [ArticleController::class, 'update'])->name('articles.update')->middleware('can:articles_edit');
            Route::get('/destroy/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('can:articles_destroy');
            Route::post('/select2', [ArticleController::class, 'select2']);
        });
        //danh mục media
        Route::group(['prefix' => '/category-media'], function () {
            Route::get('/index', [MediaBackendCategoryController::class, 'index'])->name('category_media.index')->middleware('can:category_media_index');
            Route::get('/create', [MediaBackendCategoryController::class, 'create'])->name('category_media.create')->middleware('can:category_media_create');
            Route::post('/store', [MediaBackendCategoryController::class, 'store'])->name('category_media.store');
            Route::get('/edit/{id}', [MediaBackendCategoryController::class, 'edit'])->name('category_media.edit')->middleware('can:category_media_edit');
            Route::post('/update/{id}', [MediaBackendCategoryController::class, 'update'])->name('category_media.update')->middleware('can:category_media_edit');
            Route::get('/destroy/{id}', [MediaBackendCategoryController::class, 'destroy'])->name('category_media.destroy')->middleware('can:category_media_destroy');
        });

        //danh sách media
        Route::group(['prefix' => '/media'], function () {
            Route::get('/index', [MediaController::class, 'index'])->name('media.index')->middleware('can:media_index');
            Route::get('/create', [MediaController::class, 'create'])->name('media.create')->middleware('can:media_create');
            Route::post('/store', [MediaController::class, 'store'])->name('media.store');
            Route::get('/edit/{id}', [MediaController::class, 'edit'])->name('media.edit')->middleware('can:media_edit');
            Route::post('/update/{id}', [MediaController::class, 'update'])->name('media.update')->middleware('can:media_edit');
            Route::get('/destroy/{id}', [MediaController::class, 'destroy'])->name('media.destroy')->middleware('can:media_destroy');
            Route::post('/get-select-type', [MediaController::class, 'get_select_type']);
        });
        //liên hệ
        Route::group(['prefix' => '/contacts'], function () {
            Route::get('/index', [ContactController::class, 'index'])->name('contacts.index')->middleware('can:contacts_index');
            Route::post('/index', [ContactController::class, 'store'])->name('contacts.index_store')->middleware('can:contacts_index');
        });
        Route::group(['prefix' => '/subscribers'], function () {
            Route::get('/index', [ContactController::class, 'subscribers'])->name('subscribers.index');
        });
        Route::group(['prefix' => '/books'], function () {
            Route::get('/index', [ContactController::class, 'books'])->name('books.index');
        });
        Route::group(['prefix' => '/machining'], function () {
            Route::get('/index', [ContactController::class, 'machining'])->name('machining.index');
            Route::get('/edit/{id}', [ContactController::class, 'machiningEdit'])->name('machining.edit');
        });
        //menu
        Route::group(['prefix' => '/menus'], function () {
            Route::get('/index', [MenuController::class, 'index'])->name('menus.index')->middleware('can:menus_index');
            Route::get('/create', [MenuController::class, 'create'])->name('menus.create')->middleware('can:menus_create');
            Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
            Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menus.edit')->middleware('can:menus_edit');
            Route::post('/update/{id}', [MenuController::class, 'update'])->name('menus.update');
            //nút "thêm vào menu"
            Route::get('/add-menu-item', [MenuController::class, 'addMenuItem'])->name('addMenuItem')->middleware('can:menus_create');
            //nút Liên kết tự tạo => "thêm vào menu"
            Route::get('/add-custom-link', [MenuController::class, 'addCustomLink'])->name('addCustomLink')->middleware('can:menus_create');
            //nút Lưu menu item
            Route::post('/update-menu-item/{id}', [MenuController::class, 'updateMenuItem'])->name('update-menu-item')->middleware('can:menus_edit');
            //nút Xóa menu item
            Route::get('/delete-menu-item/{id}/{menus_id}', [MenuController::class, 'deleteMenuItem'])->name('delete-menu-item')->middleware('can:menus_edit');
            //nút LƯU MENU khi kéo thả
            Route::get('/update-menu', [MenuController::class, 'updateMenu'])->name('update-menu')->middleware('can:menus_edit');
            //nút XÓA MENU
            Route::get('/delete-menu/{id}', [MenuController::class, 'destroy'])->name('delete-menu')->middleware('can:menus_destroy');
        });
        //address
        Route::group(['prefix' => '/addresses'], function () {
            Route::get('/index', [AddressController::class, 'index'])->name('addresses.index')->middleware('can:addresses_index');
            Route::get('/create', [AddressController::class, 'create'])->name('addresses.create')->middleware('can:addresses_create');
            Route::post('/create', [AddressController::class, 'store'])->name('addresses.store')->middleware('can:addresses_create');
            Route::get('/edit/{id}', [AddressController::class, 'edit'])->name('addresses.edit')->middleware('can:addresses_edit');
            Route::post('/update/{id}', [AddressController::class, 'update'])->name('addresses.update')->middleware('can:addresses_edit');
            Route::get('/destroy', [AddressController::class, 'destroy'])->name('addresses.destroy')->middleware('can:addresses_destroy');
            Route::post('/getLocation', [AddressController::class, 'getLocation'])->name('addresses.getLocation');
            Route::post('/active', [AddressController::class, 'active'])->name('addresses.active');
        });
        Route::group(['prefix' => '/pages'], function () {
            Route::get('index', [PageController::class, 'index'])->name('pages.index')->middleware('can:pages_index');
            Route::get('create', [PageController::class, 'create'])->name('pages.create')->middleware('can:pages_create');
            Route::post('create', [PageController::class, 'store'])->name('pages.store')->middleware('can:pages_create');
            Route::get('edit/{id}', [PageController::class, 'edit'])->name('pages.edit')->middleware('can:pages_edit');
            Route::post('update/{id}', [PageController::class, 'update'])->name('pages.update')->middleware('can:pages_edit');
            Route::get('destroy', [PageController::class, 'destroy'])->name('pages.destroy')->middleware('can:pages_destroy');
        });
        //order
        Route::group(['prefix' => '/orders'], function () {
            Route::get('index', [OrderController::class, 'index'])->name('orders.index')->middleware('can:orders_index');
            Route::get('edit/{id}', [OrderController::class, 'edit'])->name('orders.edit')->middleware('can:orders_edit');
            Route::post('update/{id}', [OrderController::class, 'update'])->name('orders.update')->middleware('can:orders_edit');
            Route::get('destroy', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('can:orders_destroy');
            Route::post('ajax/ajax-upload-status', [OrderController::class, 'ajaxUploadStatus'])->name('orders.ajaxUploadStatus');
            Route::get('export', [OrderController::class, 'export'])->name('orders.export');
        });
        //order logs
        Route::group(['prefix' => '/order-logs'], function () {
            Route::get('index', [OrderLogsController::class, 'index'])->name('orderLogs.index')->middleware('can:order_logs_index');
        });
        //quản lý lịch sử thanh toán online VNPAY,MOMO...
        Route::get('orders-payment/index', [OrderController::class, 'payment'])->name('orders.payment')->middleware('can:orders_payment_index');
        //cấu hình đơn hàng
        Route::group(['prefix' => '/orders-config'], function () {
            Route::get('index', [OrderController::class, 'configOrder'])->name('orders.config')->middleware('can:order_configs_index');
            Route::get('edit/{id}', [OrderController::class, 'configOrderEdit'])->name('orders.configEdit')->middleware('can:order_configs_index');
            Route::post('update/{id}', [OrderController::class, 'configOrderUpdate'])->name('orders.configUpdate')->middleware('can:order_configs_index');
        });
        //hoàn hàng
        Route::group(['prefix' => '/orders-returns'], function () {
            Route::get('index', [OrderController::class, 'returns'])->name('orders.returns')->middleware('can:orders_index');
            Route::post('returns-edit', [OrderController::class, 'returnsEdit'])->name('orders.returnsEdit')->middleware('can:orders_index');
            Route::post('returns-update', [OrderController::class, 'returnsUpdate'])->name('orders.returnsUpdate')->middleware('can:orders_index');
        });

        //comments
        Route::group(['prefix' => '/comments'], function () {
            Route::get('index', [CommentController::class, 'index'])->name('comments.index')->middleware('can:comments_index');
            Route::get('edit/{id}', [CommentController::class, 'edit'])->name('comments.edit')->middleware('can:comments_edit');
            Route::post('update/{id}', [CommentController::class, 'update'])->name('comments.update')->middleware('can:comments_edit');
            Route::get('destroy', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('can:comments_destroy');
        });
        //customer category
        Route::group(['prefix' => '/customer-categories'], function () {
            Route::get('index', [CustomerCategoryController::class, 'index'])->name('customer_categories.index')->middleware('can:customers_index');
            Route::get('create', [CustomerCategoryController::class, 'create'])->name('customer_categories.create')->middleware('can:customers_create');
            Route::post('store', [CustomerCategoryController::class, 'store'])->name('customer_categories.store')->middleware('can:customers_create');
            Route::get('edit/{id}', [CustomerCategoryController::class, 'edit'])->name('customer_categories.edit')->middleware('can:customers_edit');
            Route::post('update/{id}', [CustomerCategoryController::class, 'update'])->name('customer_categories.update')->middleware('can:customers_edit');
            Route::get('destroy', [CustomerCategoryController::class, 'destroy'])->name('customer_categories.destroy')->middleware('can:customers_destroy');
        });
        //customer
        Route::group(['prefix' => '/customers'], function () {
            Route::get('index', [CustomerController::class, 'index'])->name('customers.index')->middleware('can:customers_index');
            Route::get('create', [CustomerController::class, 'create'])->name('customers.create')->middleware('can:customers_create');
            Route::post('store', [CustomerController::class, 'store'])->name('customers.store')->middleware('can:customers_create');
            Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit')->middleware('can:customers_edit');
            Route::post('update/{id}', [CustomerController::class, 'update'])->name('customers.update')->middleware('can:customers_edit');
            Route::get('destroy', [CustomerController::class, 'destroy'])->name('customers.destroy')->middleware('can:customers_destroy');
            Route::get('/excel/export-customer', [CustomerController::class, 'exportCustomer'])->name('customers.export');
            //order
            Route::get('orders/{id}', [BackendOrderController::class, 'orders'])->name('customers.orders')->middleware('can:orders_index');
            Route::get('orders-create/{id}/{orderID}', [BackendOrderController::class, 'create'])->name('customers.orderCreate')->middleware('can:orders_index');
            Route::get('orders-success/{id}/{orderID}', [BackendOrderController::class, 'successOrder'])->name('customers.orderSuccess')->middleware('can:orders_index');
            Route::post('ajax-list-product', [BackendOrderController::class, 'ajaxListProduct'])->name('customers.ajaxListProduct');
            Route::post('add-to-cart-copy-order', [BackendOrderController::class, 'addToCart'])->name('customers.addToCartCopyOrder');
            Route::post('update-cart-copy-order', [BackendOrderController::class, 'updateCart'])->name('customers.updateCartCopyOrder');
            Route::post('submit-copy-order', [BackendOrderController::class, 'submit'])->name('customers.submitCopyCart');
            //lấy danh sách tỉnh thành phố,... phí ship
            Route::post('/get-location', [BackendOrderController::class, 'getLocation'])->name('customers.getLocationAdmin');
            Route::post('/get-shipping', [BackendOrderController::class, 'getFeeShip'])->name('customers.getPriceShipAdmin');
        });
        //customer social
        Route::group(['prefix' => '/customer-socials'], function () {
            Route::get('/index', [CustomerSocialController::class, 'index'])->name('customer_socials.index')->middleware('can:customers_index');
            Route::post('/update/{id}', [CustomerSocialController::class, 'update'])->name('customer_socials.update')->middleware('can:customers_index');
        });
        Route::group(['prefix' => '/customer-logs'], function () {
            Route::get('index', [CustomerLogsController::class, 'index'])->name('customerLogs.index')->middleware('can:customer_logs_index');
        });
        //dropzone
        Route::group(['prefix' => '/dropzone'], function () {
            Route::post('/dropzone-upload', [ComponentsController::class, 'dropzone_upload'])->name('dropzone_upload');
            Route::post('/dropzone-delete', [ComponentsController::class, 'dropzone_delete'])->name('dropzone_delete');
        });
        //website
        Route::group(['prefix' => '/websites'], function () {
            Route::get('index', [WebsiteController::class, 'index'])->name('websites.index')->middleware('can:websites_index');
            Route::post('folder', [WebsiteController::class, 'folder'])->name('websites.folder')->middleware('can:websites_index');
            Route::get('create', [WebsiteController::class, 'create'])->name('websites.create')->middleware('can:websites_create');
            Route::post('store', [WebsiteController::class, 'store'])->name('websites.store')->middleware('can:websites_create');
            Route::get('edit/{id}', [WebsiteController::class, 'edit'])->name('websites.edit')->middleware('can:websites_edit');
            Route::post('update/{id}', [WebsiteController::class, 'update'])->name('websites.update')->middleware('can:websites_edit');
            Route::post('publish', [WebsiteController::class, 'publish'])->name('websites.publish')->middleware('can:websites_edit');
        });
        //taxes
        Route::group(['prefix' => '/taxes'], function () {
            Route::get('index', [TaxController::class, 'index'])->name('taxes.index')->middleware('can:taxes_index');
            Route::post('create', [TaxController::class, 'create'])->name('taxes.create')->middleware('can:taxes_create');
            Route::post('edit', [TaxController::class, 'edit'])->name('taxes.edit')->middleware('can:taxes_edit');
            Route::post('update', [TaxController::class, 'update'])->name('taxes.update')->middleware('can:taxes_edit');
            Route::post('config', [TaxController::class, 'config'])->name('taxes.config')->middleware('can:taxes_edit');
        });
        //nhà cung cấp
        Route::group(['prefix' => '/suppliers'], function () {
            Route::get('index', [SuppliersController::class, 'index'])->name('suppliers.index')->middleware('can:suppliers_index');
            Route::get('create', [SuppliersController::class, 'create'])->name('suppliers.create')->middleware('can:suppliers_create');
            Route::post('store', [SuppliersController::class, 'store'])->name('suppliers.store')->middleware('can:suppliers_create');
            Route::get('edit/{id}', [SuppliersController::class, 'edit'])->name('suppliers.edit')->middleware('can:suppliers_edit');
            Route::post('update/{id}', [SuppliersController::class, 'update'])->name('suppliers.update')->middleware('can:suppliers_edit');
            Route::get('export', [SuppliersController::class, 'export'])->name('suppliers.export')->middleware('can:suppliers_index');
            Route::post('import', [SuppliersController::class, 'import'])->name('suppliers.import')->middleware('can:suppliers_create');
        });
        Route::group(['prefix' => '/suppliers-categories'], function () {
            Route::get('index', [SuppliersCategoryController::class, 'index'])->name('suppliers_categories.index')->middleware('can:suppliers_categories_index');
            Route::post('store', [SuppliersCategoryController::class, 'store'])->name('suppliers_categories.store')->middleware('can:suppliers_categories_create');
            Route::post('edit', [SuppliersCategoryController::class, 'edit'])->name('suppliers_categories.edit')->middleware('can:suppliers_categories_edit');
            Route::post('update', [SuppliersCategoryController::class, 'update'])->name('suppliers_categories.update')->middleware('can:suppliers_categories_edit');
        });
        //Sản phẩm - Nhập hàng
        Route::group(['prefix' => '/product-purchases'], function () {
            Route::get('show/{id}', [ProductPurchaseController::class, 'show'])->name('product_purchases.show')->middleware('can:product_purchases_index');
            Route::get('index', [ProductPurchaseController::class, 'index'])->name('product_purchases.index')->middleware('can:product_purchases_index');
            Route::get('create', [ProductPurchaseController::class, 'create'])->name('product_purchases.create')->middleware('can:product_purchases_create');
            Route::post('store', [ProductPurchaseController::class, 'store'])->name('product_purchases.store')->middleware('can:product_purchases_create');
            Route::get('edit/{id}', [ProductPurchaseController::class, 'edit'])->name('product_purchases.edit')->middleware('can:product_purchases_edit');
            Route::post('update/{id}', [ProductPurchaseController::class, 'update'])->name('product_purchases.update')->middleware('can:product_purchases_edit');
            Route::get('export', [ProductPurchaseController::class, 'export'])->name('product_purchases.export')->middleware('can:product_purchases_index');
            Route::post('import', [ProductPurchaseController::class, 'import'])->name('product_purchases.import')->middleware('can:product_purchases_create');
            Route::post('ajaxListSuppliers', [ProductPurchaseController::class, 'ajaxListSuppliers'])->name('product_purchases.ajaxListSuppliers');
            Route::post('ajaxListProducts', [ProductPurchaseController::class, 'ajaxListProducts'])->name('product_purchases.ajaxListProducts');
            Route::post('addToCartPurchases', [ProductPurchaseController::class, 'addToCartPurchases'])->name('product_purchases.addToCartPurchases');
            Route::post('ajaxAddToCartModalPopup', [ProductPurchaseController::class, 'ajaxAddToCartModalPopup'])->name('product_purchases.ajaxAddToCartModalPopup');
            Route::post('ajaxUpdateCartPurchases', [ProductPurchaseController::class, 'ajaxUpdateCartPurchases'])->name('product_purchases.ajaxUpdateCartPurchases');
            Route::post('addDiscount', [ProductPurchaseController::class, 'addDiscount'])->name('product_purchases.addDiscount');
            Route::post('ajaxSaveSessionSurcharge', [ProductPurchaseController::class, 'ajaxSaveSessionSurcharge'])->name('product_purchases.ajaxSaveSessionSurcharge');
            Route::post('validateForm', [ProductPurchaseController::class, 'validateForm'])->name('product_purchases.validateForm');
        });
        //sổ quỹ - phiếu chi
        Route::group(['prefix' => '/payment-groups'], function () {
            Route::get('index', [PaymentGroupsController::class, 'index'])->name('payment_groups.index')->middleware('can:payment_vouchers_index');
            Route::post('store', [PaymentGroupsController::class, 'store'])->name('payment_groups.store')->middleware('can:payment_vouchers_create');
            Route::post('edit', [PaymentGroupsController::class, 'edit'])->name('payment_groups.edit')->middleware('can:payment_vouchers_edit');
            Route::post('update', [PaymentGroupsController::class, 'update'])->name('payment_groups.update')->middleware('can:payment_vouchers_edit');
        });
        Route::group(['prefix' => '/payment-vouchers'], function () {
            Route::get('index', [PaymentVouchersController::class, 'index'])->name('payment_vouchers.index')->middleware('can:payment_vouchers_index');
            Route::get('create', [PaymentVouchersController::class, 'create'])->name('payment_vouchers.create')->middleware('can:payment_vouchers_create');
            Route::post('store', [PaymentVouchersController::class, 'store'])->name('payment_vouchers.store')->middleware('can:payment_vouchers_create');
            Route::get('edit/{id}', [PaymentVouchersController::class, 'edit'])->name('payment_vouchers.edit')->middleware('can:payment_vouchers_edit');
            Route::post('update/{id}', [PaymentVouchersController::class, 'update'])->name('payment_vouchers.update')->middleware('can:payment_vouchers_edit');
            Route::post('get-module', [PaymentVouchersController::class, 'getModule'])->name('payment_vouchers.getModule')->middleware('can:payment_vouchers_index');
            Route::post('ajax-search', [PaymentVouchersController::class, 'ajaxSearch'])->name('payment_vouchers.ajaxSearch')->middleware('can:payment_vouchers_index');
            Route::post('ajax-delete', [PaymentVouchersController::class, 'ajaxDelete'])->name('payment_vouchers.ajaxDelete')->middleware('can:payment_vouchers_destroy');
        });
        //sổ quỹ - phiếu thu
        Route::group(['prefix' => '/receipt-vouchers'], function () {
            Route::get('index', [ReceiptVouchersController::class, 'index'])->name('receipt_vouchers.index')->middleware('can:receipt_vouchers_index');
            Route::get('create', [ReceiptVouchersController::class, 'create'])->name('receipt_vouchers.create')->middleware('can:receipt_vouchers_create');
            Route::post('store', [ReceiptVouchersController::class, 'store'])->name('receipt_vouchers.store')->middleware('can:receipt_vouchers_create');
            Route::get('edit/{id}', [ReceiptVouchersController::class, 'edit'])->name('receipt_vouchers.edit')->middleware('can:receipt_vouchers_edit');
            Route::post('update/{id}', [ReceiptVouchersController::class, 'update'])->name('receipt_vouchers.update')->middleware('can:receipt_vouchers_edit');
        });
    });
    Route::get('/language/{language}', [ComponentsController::class, 'language'])->name('components.language');
});
