<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

use Illuminate\Http\Request;


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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // home route
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // categories routes
    Route::name('categories.')->group(function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::prefix("categories")->group(function () {
                // get all categories
                Route::get('/list', 'index')->name('list');
                // return add category view
                Route::get('/add', 'add')->name('add');
                // insert new category in database
                Route::post('/insert', 'insert')->name('insert');
                // return edit category view
                Route::get('/edit/{id}', 'edit')->name('edit');
                // save changes of category
                Route::put('/update', 'update')->name('update');
                // delete category
                Route::delete('/delete', 'delete')->name('delete');
                // truncate categories
                Route::delete('/truncate', 'truncate')->name('truncate');
            });
        });
    });

    // products routes
    Route::name('products.')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::prefix("products")->group(function () {
                // get all products
                Route::get('/list', 'index')->name('list');
                // return add product view
                Route::get('/add', 'add')->name('add');
                // insert new product in database
                Route::post('/add', 'insert')->name('insert');
                // return edit product view
                Route::get('/edit/{id}', 'edit')->name('edit');
                // save changes of product
                Route::put('/update', 'update')->name('update');
                // delete product
                Route::delete('/delete', 'delete')->name('delete');
            });
        });
    });
    
    // user routes
    Route::name('user.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::prefix("user")->group(function () {
                // get all user info
                Route::get('/profile', 'index')->name('profile');
                // update user info
                Route::put('/update', 'update')->name('update');
                // reset user password
                Route::put('/reset-password', 'reset_password')->name('reset_password');
            });
        });
    });
    
    // sales routes
    Route::name('sales.')->group(function () {
        Route::controller(OrderDetailController::class)->group(function () {
            Route::prefix("sales_invoices")->group(function () {
                // get all user info
                Route::get('/new', 'index')->name('new');
            });
        });
    });

    
});
