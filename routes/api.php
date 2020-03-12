<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Brands
    Route::apiResource('brands', 'BrandsApiController');

    // Items
    Route::post('items/media', 'ItemsApiController@storeMedia')->name('items.storeMedia');
    Route::apiResource('items', 'ItemsApiController');

    // Accounts
    Route::apiResource('accounts', 'AccountsApiController');

    // Departments
    Route::apiResource('departments', 'DepartmentsApiController');

    // Approved Requests
    Route::apiResource('approved-requests', 'ApprovedRequestsApiController');

    // Item Release Records
    Route::apiResource('item-release-records', 'ItemReleaseRecordsApiController');

    // Suppliers
    Route::apiResource('suppliers', 'SuppliersApiController');

    // Item Restock
    Route::apiResource('item-restocks', 'ItemRestocksApiController');
});
