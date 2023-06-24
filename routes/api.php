<?php

use App\Http\Controllers\Api\Admin\CategoriesController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\TableController;
use App\Http\Controllers\Api\Client\Auth\AccountController;
use App\Http\Controllers\Api\Client\Auth\GoogleController;
use App\Http\Controllers\Api\Client\MenuPageController;
use App\Http\Controllers\Api\Client\Page\BookingController;
use App\Http\Controllers\Api\Client\Page\CartController;
use App\Http\Controllers\Api\Client\Page\HomePageController;
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


Route::post('auth/login/account', [AccountController::class, 'loginAccount']);
Route::post('auth/singup/account', [AccountController::class, 'singupAccount']);

Route::get('auth/google/url', [GoogleController::class, 'loginUrl']);
Route::get('auth/google/callback', [GoogleController::class, 'loginCallback']);

Route::middleware(['auth:api', 'token.expiration'])->group(function () {
    Route::get('auth/user', [AccountController::class, 'authUser']);
    Route::post('auth/logout', [AccountController::class, 'logoutAccount']);

    // Api admin Restaurant Manager

    // categories
    Route::prefix('admin/')->group(function () {

        Route::prefix('categories')->controller(CategoriesController::class)->group(function () {
            Route::post("create", 'create');
            Route::post("/", 'index');

            Route::get('type', 'categoriesType');
        });

        // produts
        Route::prefix('products')->controller(ProductController::class)->group(function () {
            Route::post("create", 'create');
            Route::get("/", 'index');
            Route::get("{id}", 'show');
            Route::patch("{id}", 'update');
        });

        // Tables
        Route::prefix('tables')->controller(TableController::class)->group(function () {
            Route::get("/", 'index');
            Route::post("create", 'create');

            // get table status
            Route::get("empty", 'tableStatus');
        });

        // Order
        Route::prefix('orders')->controller(OrderController::class)->group(function () {
            Route::post('apply', "applyInvoice");
            Route::post('products', "productListOrder");

            Route::get('order/menu/products', 'getMenuOrderProducts');
            Route::get('order/menu/categories', 'getMenuOrderCategories');

            Route::post('apply/invoice/{tableId}', 'applyInvoice');
            Route::get('invoice/{tableId}', "getInovice");
            Route::post('move', 'moveTable');
            Route::post('pay/{tableId}', 'payOrder');
        });
    });
});

// Api Client
Route::prefix('client')->group(function () {

    Route::get('menu/products', [MenuPageController::class, 'productList']);
    Route::get('menu/filter', [MenuPageController::class, 'filterQuery']);

    Route::get('menu/categories', [HomePageController::class, 'menuCategories']);

    Route::get('table', [TableController::class, 'getTableClient']);

    Route::prefix('booking')->controller(BookingController::class)->group(function () {
        Route::post('create', 'create');
        Route::get('menu', 'menuBoking');
    });

    Route::post('order-online', [CartController::class, 'orderOnline']);
});
