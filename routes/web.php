<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', "TestController@index");
Route::get('/tests', "TestController@test");
Route::resource('product', 'ProductController');



Route::namespace('Admin')->group(function () {
    Route::group(['prefix' => '/admin'], function () {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name("admin.login.index");
        Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name("admin.register.index");
        Route::post('/login', 'Auth\LoginController@adminLogin')->name("admin.login");
        Route::post('/register', 'Auth\RegisterController@adminRegistration')->name("admin.register");
    
//            reset password
        Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/reset','Auth\ResetPasswordController@reset')->name("admin.password.update");
        Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');

        Route::middleware(['auth:admin'])->group(function () {
            Route::post('/logout', 'Auth\LoginController@logout')->name("admin.logout");
            Route::resource('dashboard', 'AdminController', ['as' => 'admin']);
            Route::resource('category', 'CategoryController', ['as' => 'admin']);
            Route::resource('sub-category', 'SubCategoryController', ['as' => 'admin']);
            Route::resource('brand', 'BrandController', ['as' => 'admin']);
            Route::resource('supplier', 'SupplierController', ['as' => 'admin']);
            Route::resource('product', 'ProductController', ['as' => 'admin']);
            Route::resource('seller', 'SellerController', ['as' => 'admin']);
            Route::resource('purchaser', 'PurchaserController', ['as' => 'admin']);
            Route::resource('accountant', 'AccountantController', ['as' => 'admin']);
            Route::resource('hr', 'HrController', ['as' => 'admin']);
            Route::resource('coordinator', 'CoordinatorController', ['as' => 'admin']);
            Route::resource('maintainer', 'MaintainerController', ['as' => 'admin']);
            Route::resource('uom', 'UomController', ['as' => 'admin']);
            Route::resource('store_keeper', 'StoreKeeperController', ['as' => 'admin']);
            Route::resource('settings', 'SettingsController', ['as' => 'admin']);
            Route::resource('customer', 'CustomerController', ['as' => 'admin']);
            Route::resource('quotation', 'QuotationController', ['as' => 'admin']);
            Route::post('add-category', 'AjaxController@addCategory');
            Route::post('add-brand', 'AjaxController@addBrand');
            Route::post('add-uom', 'AjaxController@addUom');
            Route::post('add-subcategory', 'AjaxController@addSubCategory');

        });
    });
});

Route::namespace('Seller')->group(function () {
    Route::group(['prefix' => '/seller'], function () {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name("seller.login.index");
        Route::post('/login', 'Auth\LoginController@sellerLogin')->name("seller.login");

//            reset password
        Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('seller.password.email');
        Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('seller.password.request');
        Route::post('/password/reset','Auth\ResetPasswordController@reset')->name("seller.password.update");
        Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('seller.password.reset');

        Route::middleware(['auth:seller'])->group(function () {
            Route::post('/logout', 'Auth\LoginController@logout')->name("seller.logout");
            Route::resource('dashboard', 'SellerController', ['as' => 'seller']);
            Route::resource('quotation', 'QuotationController', ['as' => 'seller']);
            Route::resource('inquiry', 'InquiryController', ['as' => 'seller']);
        });
    });
});

Route::namespace('Purchaser')->group(function () {
    Route::group(['prefix' => '/purchaser'], function () {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name("purchaser.login.index");
        Route::post('/login', 'Auth\LoginController@purchaserLogin')->name("purchaser.login");

//            reset password
        Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('purchaser.password.email');
        Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('purchaser.password.request');
        Route::post('/password/reset','Auth\ResetPasswordController@reset')->name("purchaser.password.update");
        Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('purchaser.password.reset');

        Route::middleware(['auth:purchaser'])->group(function () {
            Route::post('/logout', 'Auth\LoginController@logout')->name("purchaser.logout");
            Route::resource('dashboard', 'PurchaserController', ['as' => 'purchaser']);
        });
    });
});

Route::namespace('Accountant')->group(function () {
    Route::group(['prefix' => '/accountant'], function () {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name("accountant.login.index");
        Route::post('/login', 'Auth\LoginController@accountantLogin')->name("accountant.login");

//            reset password
        Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('accountant.password.email');
        Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('accountant.password.request');
        Route::post('/password/reset','Auth\ResetPasswordController@reset')->name("accountant.password.update");
        Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('accountant.password.reset');

        Route::middleware(['auth:accountant'])->group(function () {
            Route::post('/logout', 'Auth\LoginController@logout')->name("accountant.logout");
            Route::resource('dashboard', 'AccountantController', ['as' => 'accountant']);
        });
    });
});

Route::namespace('Hr')->group(function () {
    Route::group(['prefix' => '/hr'], function () {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name("hr.login.index");
        Route::post('/login', 'Auth\LoginController@hrLogin')->name("hr.login");

//            reset password
        Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('hr.password.email');
        Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('hr.password.request');
        Route::post('/password/reset','Auth\ResetPasswordController@reset')->name("hr.password.update");
        Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('hr.password.reset');

        Route::middleware(['auth:hr'])->group(function () {
            Route::post('/logout', 'Auth\LoginController@logout')->name("hr.logout");
            Route::resource('dashboard', 'HrController', ['as' => 'hr']);
        });
    });
});

Route::namespace('Coordinator')->group(function () {
    Route::group(['prefix' => '/coordinator'], function () {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name("coordinator.login.index");
        Route::post('/login', 'Auth\LoginController@coordinatorLogin')->name("coordinator.login");

//            reset password
        Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('coordinator.password.email');
        Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('coordinator.password.request');
        Route::post('/password/reset','Auth\ResetPasswordController@reset')->name("coordinator.password.update");
        Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('coordinator.password.reset');

        Route::middleware(['auth:coordinator'])->group(function () {
            Route::post('/logout', 'Auth\LoginController@logout')->name("coordinator.logout");
            Route::resource('dashboard', 'CoordinatorController', ['as' => 'coordinator']);
            Route::resource('quotation', 'QuotationController');
        });
    });
});

Route::namespace('Maintainer')->group(function () {
    Route::group(['prefix' => '/maintainer'], function () {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name("maintainer.login.index");
        Route::post('/login', 'Auth\LoginController@maintainerLogin')->name("maintainer.login");

//            reset password
        Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('maintainer.password.email');
        Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('maintainer.password.request');
        Route::post('/password/reset','Auth\ResetPasswordController@reset')->name("maintainer.password.update");
        Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('maintainer.password.reset');

        Route::middleware(['auth:maintainer'])->group(function () {
            Route::post('/logout', 'Auth\LoginController@logout')->name("maintainer.logout");
            Route::resource('dashboard', 'MaintainerController', ['as' => 'maintainer']);
        });
    });
});

Route::namespace('StoreKeeper')->group(function () {
    Route::group(['prefix' => '/store-keeper'], function () {
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name("store_keeper.login.index");
        Route::post('/login', 'Auth\LoginController@store_keeperLogin')->name("store_keeper.login");

//            reset password
        Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('store_keeper.password.email');
        Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('store_keeper.password.request');
        Route::post('/password/reset','Auth\ResetPasswordController@reset')->name("store_keeper.password.update");
        Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('store_keeper.password.reset');

        Route::middleware(['auth:store_keeper'])->group(function () {
            Route::post('/logout', 'Auth\LoginController@logout')->name("store_keeper.logout");
            Route::resource('dashboard', 'StoreKeeperController', ['as' => 'store_keeper']);
        });
    });
});