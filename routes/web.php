<?php

//Route::redirect('/', '/login');
Route::get('/', 'PagesController@index');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

//Auth::routes(['register' => true]);
Auth::routes();

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Brands
    Route::delete('brands/destroy', 'BrandsController@massDestroy')->name('brands.massDestroy');
    Route::resource('brands', 'BrandsController');

    // Items
    Route::delete('items/destroy', 'ItemsController@massDestroy')->name('items.massDestroy');
    Route::post('items/media', 'ItemsController@storeMedia')->name('items.storeMedia');
    Route::post('items/ckmedia', 'ItemsController@storeCKEditorImages')->name('items.storeCKEditorImages');
    Route::resource('items', 'ItemsController');
    
    // Accounts
    Route::delete('accounts/destroy', 'AccountsController@massDestroy')->name('accounts.massDestroy');
    Route::resource('accounts', 'AccountsController');

     // Departments
    Route::delete('departments/destroy', 'DepartmentsController@massDestroy')->name('departments.massDestroy');
    Route::resource('departments', 'DepartmentsController');

    // Approved Requests
    Route::delete('approved-requests/destroy', 'ApprovedRequestsController@massDestroy')->name('approved-requests.massDestroy');
    Route::resource('approved-requests', 'ApprovedRequestsController');

    // Item Release Records
    Route::delete('item-release-records/destroy', 'ItemReleaseRecordsController@massDestroy')->name('item-release-records.massDestroy');
    Route::resource('item-release-records', 'ItemReleaseRecordsController');

    // Suppliers
    Route::delete('suppliers/destroy', 'SuppliersController@massDestroy')->name('suppliers.massDestroy');
    Route::resource('suppliers', 'SuppliersController');

    // Item Restocks
    Route::delete('item-restocks/destroy', 'ItemRestocksController@massDestroy')->name('item-restocks.massDestroy');
    Route::resource('item-restocks', 'ItemRestocksController');
    Route::get('/item-restocks/details/{id}','ItemRestocksController@details');
    //deliver stock
    Route::get('deliver-stock/{item_re_id}','ItemRestocksController@deliver_stock');
    //store function on stock
    Route::post('confirm','ItemRestocksController@confirm');
});
