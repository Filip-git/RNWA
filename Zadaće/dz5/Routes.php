<?php

    Route::get('index.php', function () {
        IndexController::CreateView('IndexView');
    });
  
    Route::get('categories',[CategoryController::class, 'index']);
    Route::get('categories_create',[CategoryController::class, 'create']);
    Route::get('categories_edit',[CategoryController::class, 'edit']);
    Route::post('categories',[CategoryController::class, 'store']);

    Route::put('categories_update',[CategoryController::class, 'update']);

    Route::delete('categories_delete',[CategoryController::class, 'delete']);

    Route::get('suppliers',[SupplierController::class, 'index']);
    Route::get('suppliers_create',[SupplierController::class, 'create']);
    Route::get('suppliers_edit',[SupplierController::class, 'edit']);
    Route::post('suppliers',[SupplierController::class, 'store']);

    Route::put('suppliers_update',[SupplierController::class, 'update']);

    Route::delete('suppliers_delete',[SupplierController::class, 'delete']);

    Route::get('products',[ProductController::class, 'index']);
    Route::get('products_create',[ProductController::class, 'create']);
    Route::get('products_edit',[ProductController::class, 'edit']);
    Route::post('products',[ProductController::class, 'store']);

    Route::put('products_update',[ProductController::class, 'update']);

    Route::delete('products_delete',[ProductController::class, 'delete']);

