<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\IndexController::class)->name('index');
Route::get('/works', \App\Http\Controllers\ImageController::class)->name('images');
Route::get('/request', [\App\Http\Controllers\RequestController::class, 'add'])->name('request.add');
Route::get('/rests', function () {
    $rests = \App\Models\Rest::all()->toJson();

    return response($rests);
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/', \App\Http\Controllers\Admin\IndexController::class)->name('admin.index');

    Route::group(['prefix' => 'requests'], function () {

        Route::get('/', [\App\Http\Controllers\Admin\RequestController::class, 'index'])->name('admin.request.index');
        Route::delete('/{request}', [\App\Http\Controllers\Admin\RequestController::class, 'delete'])->name('admin.request.delete');
        Route::get('/data', [\App\Http\Controllers\Admin\RequestController::class, 'data'])->name('admin.request.data');

    });

    Route::group(['prefix' => 'categories'], function () {

        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/edit/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.category.delete');
        Route::get('/data', [\App\Http\Controllers\Admin\CategoryController::class, 'data'])->name('admin.category.data');

    });

    Route::group(['prefix' => 'services'], function () {

        Route::get('/', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('admin.service.index');
        Route::get('/create', [\App\Http\Controllers\Admin\ServiceController::class, 'create'])->name('admin.service.create');
        Route::post('/', [\App\Http\Controllers\Admin\ServiceController::class, 'store'])->name('admin.service.store');
        Route::get('/edit/{service}', [\App\Http\Controllers\Admin\ServiceController::class, 'edit'])->name('admin.service.edit');
        Route::put('/{service}', [\App\Http\Controllers\Admin\ServiceController::class, 'update'])->name('admin.service.update');
        Route::delete('/{service}', [\App\Http\Controllers\Admin\ServiceController::class, 'delete'])->name('admin.service.delete');
        Route::get('/data', [\App\Http\Controllers\Admin\ServiceController::class, 'data'])->name('admin.service.data');

    });

    Route::group(['prefix' => 'images'], function () {

        Route::get('/', [\App\Http\Controllers\Admin\ImageController::class, 'index'])->name('admin.image.index');
        Route::get('/create', [\App\Http\Controllers\Admin\ImageController::class, 'create'])->name('admin.image.create');
        Route::post('/', [\App\Http\Controllers\Admin\ImageController::class, 'store'])->name('admin.image.store');
        Route::get('/edit/{image}', [\App\Http\Controllers\Admin\ImageController::class, 'edit'])->name('admin.image.edit');
        Route::put('/{image}', [\App\Http\Controllers\Admin\ImageController::class, 'update'])->name('admin.image.update');
        Route::delete('/{image}', [\App\Http\Controllers\Admin\ImageController::class, 'delete'])->name('admin.image.delete');
        Route::get('/data', [\App\Http\Controllers\Admin\ImageController::class, 'data'])->name('admin.image.data');

    });

    Route::group(['prefix' => 'rests'], function () {

        Route::get('/', [\App\Http\Controllers\Admin\RestController::class, 'index'])->name('admin.rest.index');
        Route::get('/create', [\App\Http\Controllers\Admin\RestController::class, 'create'])->name('admin.rest.create');
        Route::post('/', [\App\Http\Controllers\Admin\RestController::class, 'store'])->name('admin.rest.store');
        Route::get('/edit/{rest}', [\App\Http\Controllers\Admin\RestController::class, 'edit'])->name('admin.rest.edit');
        Route::put('/{rest}', [\App\Http\Controllers\Admin\RestController::class, 'update'])->name('admin.rest.update');
        Route::delete('/{rest}', [\App\Http\Controllers\Admin\RestController::class, 'delete'])->name('admin.rest.delete');
        Route::get('/data', [\App\Http\Controllers\Admin\RestController::class, 'data'])->name('admin.rest.data');

    });
});

Auth::routes();
