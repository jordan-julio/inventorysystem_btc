<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

###################################################
#superadmin access
####################################################
Route::group(['middleware' => 'auth'], function () {
    Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
    Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
    Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
    Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);});
Route::group(['middleware' => ['member']], function () {
    Route::resources([
        'inventory/categories' => 'ProductCategoryController',
        'inventory/productsadd' => 'ProductAddController',
    ]);
    Route::resource('inventory/products', 'ProductController');
    Route::resource('productsadd', 'ProductAddController')->except(['edit', 'update']);

    Route::delete('inventory/material/home/destroy/{material}', ['as' => 'inventory.material.destroy', 'uses' => 'MaterialController@destroy']);
    Route::put('inventory/material/home/update/{material}', ['as' => 'inventory.material.update', 'uses' => 'MaterialController@update']);
    Route::get('inventory/material/home/edit/{material}', ['as' => 'inventory.material.edit', 'uses' => 'MaterialController@edit']);
    Route::get('inventory/material/home', ['as' => 'inventory.material.home', 'uses' => 'MaterialController@index']);
    Route::get('inventory/material/home/add new', ['as' => 'inventory.material.createnew', 'uses' => 'MaterialController@create']);
    Route::post('inventory/material/home/store new', ['as' => 'inventory.material.storenew', 'uses' => 'MaterialController@store']);
    Route::get('inventory/material/index', ['as' => 'inventory.material.index', 'uses' => 'MaterialSearchController@index']);
    Route::get('inventory/material/index/add', ['as' => 'inventory.material.create', 'uses' => 'MaterialSearchController@create']);
    Route::post('inventory/material/index/store', ['as' => 'inventory.material.store', 'uses' => 'MaterialSearchController@store']);
    Route::get('inventory/material/index/action', ['as' => 'inventory.material.action', 'uses' => 'MaterialSearchController@action']);;


    Route::get('inventory/productsadd', ['as' => 'productsadd.index', 'uses' => 'ProductAddController@index']);
    Route::get('inventory/productsadd/{product}/finalize', ['as' => 'productsadd.finalize', 'uses' => 'ProductAddController@finalize']);
    Route::get('inventory/productsadd/{product}/product/add', ['as' => 'productsadd.product.add', 'uses' => 'ProductAddController@addproduct']);
    Route::post('inventory/productsadd/{product}/product', ['as' => 'productsadd.product.store', 'uses' => 'ProductAddController@storeproduct']);
    Route::match(['put', 'patch'], 'inventory/productsadd/{product}/product/{soldproduct}', ['as' => 'productsadd.update', 'uses' => 'ProductAddController@updateproduct']);
    Route::delete('inventory/productsadd/{product}/delete', ['as' => 'productsadd.product.destroy', 'uses' => 'ProductAddController@destroyproduct']);

    Route::get('inventory/member/stats/{year?}/{month?}/{day?}', ['as' => 'inventory.stats', 'uses' => 'InventoryController@stats']);
    Route::resource('inventory/member/receipts', 'ReceiptController')->except(['edit', 'update']);
    Route::get('inventory/member/receipts/{receipt}/finalize', ['as' => 'receipts.finalize', 'uses' => 'ReceiptController@finalize']);
    Route::get('inventory/member/receipts/{receipt}/product/add', ['as' => 'receipts.product.add', 'uses' => 'ReceiptController@addproduct']);
    Route::get('inventory/member/receipts/{receipt}/product/{receivedproduct}/edit', ['as' => 'receipts.product.edit', 'uses' => 'ReceiptController@editproduct']);
    Route::post('inventory/member/receipts/{receipt}/product', ['as' => 'receipts.product.store', 'uses' => 'ReceiptController@storeproduct']);
    Route::match(['put', 'patch'], 'inventory/member/receipts/{receipt}/product/{receivedproduct}', ['as' => 'receipts.product.update', 'uses' => 'ReceiptController@updateproduct']);
    Route::delete('inventory/member/receipts/{receipt}/product/{receivedproduct}', ['as' => 'receipts.product.destroy', 'uses' => 'ReceiptController@destroyproduct']);
    
    Route::resource('inventory/materialused', 'MaterialUseController');
    Route::get('inventory/materialuse/{materialused}/mat/add', ['as' => 'materialused.product.add', 'uses' => 'MaterialUseController@addproduct']);
    Route::get('inventory/materialuse/{materialused}/mat/{usedmaterial}/edit', ['as' => 'materialused.product.edit', 'uses' => 'MaterialUseController@editproduct']);
    Route::post('inventory/materialuse/{materialused}/mat', ['as' => 'materialused.material.store', 'uses' => 'MaterialUseController@storeproduct']);
    Route::match(['put', 'patch'], 'inventory/materialuse/{materialused}/product/{usedmaterial}', ['as' => 'materialused.material.update', 'uses' => 'MaterialUseController@updateproduct']);
    Route::delete('inventory/materialuse/{materialused}/product/{usedmaterial}', ['as' => 'materialused.material.destroy', 'uses' => 'MaterialUseController@destroyproduct']);
    
    Route::get('/inventory/materials', ['as' => 'materials.index', 'uses' => 'MatSearchController@index']);
    Route::get('/inventory/materials/cari','MatSearchController@cari');
    
    Route::group(['middleware' => ['admin']], function () {
        Route::resources([
            'clients' => 'ClientController',
            'transactions/transfer' => 'TransferController',
    ]);
    Route::resource('invoice', 'InvoiceController');
    Route::post('invoice/createInvoice', ['as' => 'invoice.getinvoice', 'uses' => 'InvoiceController@getInvoice']);
    Route::resource('salesnd', 'SaleNotdoneController')->except(['edit', 'update']);
    Route::get('salesnd/{sale}/finalize', ['as' => 'salesnd.finalize', 'uses' => 'SaleNotdoneController@finalize']);
    Route::get('salesnd/{sale}/product/add', ['as' => 'salesnd.product.add', 'uses' => 'SaleNotdoneController@addproduct']);
    Route::get('salesnd/{sale}/product/{soldproduct}/edit', ['as' => 'salesnd.product.edit', 'uses' => 'SaleNotdoneController@editproduct']);
    Route::get('salesnd/{sale}/invoice', ['as' => 'salesnd.invoice', 'uses' => 'SaleNotdoneController@invoice']);
    Route::get('salesnd/{sale}/suratpo', ['as' => 'salesnd.suratpo', 'uses' => 'SaleNotdoneController@suratpo']);
    Route::get('salesnd/{sale}/suratkirim', ['as' => 'salesnd.suratkirim', 'uses' => 'SaleNotdoneController@suratkirim']);
    Route::post('salesnd/{sale}/product', ['as' => 'salesnd.product.store', 'uses' => 'SaleNotdoneController@storeproduct']);
    Route::match(['put', 'patch'], 'salesnd/{sale}/product/{soldproduct}', ['as' => 'salesnd.product.update', 'uses' => 'SaleNotdoneController@updateproduct']);
    Route::delete('salesnd/{sale}/product/{soldproduct}', ['as' => 'salesnd.product.destroy', 'uses' => 'SaleNotdoneController@destroyproduct']);

    Route::resource('sales', 'SaleController')->except(['edit', 'update']);
    Route::get('sales/{sale}/finalize', ['as' => 'sales.finalize', 'uses' => 'SaleController@finalize']);
    Route::get('sales/{sale}/product/add', ['as' => 'sales.product.add', 'uses' => 'SaleController@addproduct']);
    Route::get('sales/{sale}/product/{soldproduct}/edit', ['as' => 'sales.product.edit', 'uses' => 'SaleController@editproduct']);
    Route::get('sales/{sale}/invoice', ['as' => 'sales.invoice', 'uses' => 'SaleController@invoice']);
    Route::get('sales/{sale}/suratpo', ['as' => 'sales.suratpo', 'uses' => 'SaleController@suratpo']);
    Route::get('sales/{sale}/suratkirim', ['as' => 'sales.suratkirim', 'uses' => 'SaleController@suratkirim']);
    Route::post('sales/{sale}/product', ['as' => 'sales.product.store', 'uses' => 'SaleController@storeproduct']);
    Route::match(['put', 'patch'], 'sales/{sale}/product/{soldproduct}', ['as' => 'sales.product.update', 'uses' => 'SaleController@updateproduct']);
    Route::delete('sales/{sale}/product/{soldproduct}', ['as' => 'sales.product.destroy', 'uses' => 'SaleController@destroyproduct']);

    Route::resource('transactions', 'TransactionController')->except(['create', 'show']);
    Route::get('transactions/stats/{year?}/{month?}/{day?}', ['as' => 'transactions.stats', 'uses' => 'TransactionController@stats']);
    Route::get('transactions/{type}', ['as' => 'transactions.type', 'uses' => 'TransactionController@type']);
    Route::get('transactions/{type}/create', ['as' => 'transactions.create', 'uses' => 'TransactionController@create']);
    Route::get('transactions/{transaction}/edit', ['as' => 'transactions.edit', 'uses' => 'TransactionController@edit']);

    Route::get('clients/{client}/transactions/add', ['as' => 'clients.transactions.add', 'uses' => 'ClientController@addtransaction']);
    
    Route::group(['middleware' => ['superadmin']], function () {
        
        Route::resources([
            'users' => 'UserController',
            'providers' => 'ProviderController',
            'methods' => 'MethodController',
        ]);
        Route::get('/dashboard', ['as' => 'dashboard.stats', 'uses' => 'DashboardController@index']);
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::match(['put', 'patch'], 'profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
        Route::match(['put', 'patch'], 'profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

        Route::get('transactions/stats/{year?}/{month?}/{day?}', ['as' => 'transactions.stats', 'uses' => 'TransactionController@stats']);
        Route::get('inventory/member/stats/{year?}/{month?}/{day?}', ['as' => 'inventory.stats', 'uses' => 'InventoryController@stats']);
        Route::resource('inventory/member/receipts', 'ReceiptController')->except(['edit', 'update']);
        Route::get('inventory/member/receipts/{receipt}/finalize', ['as' => 'receipts.finalize', 'uses' => 'ReceiptController@finalize']);
        Route::get('inventory/member/receipts/{receipt}/product/add', ['as' => 'receipts.product.add', 'uses' => 'ReceiptController@addproduct']);
        Route::get('inventory/member/receipts/{receipt}/product/{receivedproduct}/edit', ['as' => 'receipts.product.edit', 'uses' => 'ReceiptController@editproduct']);
        Route::post('inventory/member/receipts/{receipt}/product', ['as' => 'receipts.product.store', 'uses' => 'ReceiptController@storeproduct']);
        Route::match(['put', 'patch'], 'inventory/member/receipts/{receipt}/product/{receivedproduct}', ['as' => 'receipts.product.update', 'uses' => 'ReceiptController@updateproduct']);
        Route::delete('inventory/member/receipts/{receipt}/product/{receivedproduct}', ['as' => 'receipts.product.destroy', 'uses' => 'ReceiptController@destroyproduct']);
    });

});

});

?>
    

