<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
// use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SubCateoryController;
use App\Http\Controllers\PostsController;

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('user',UserController::class);
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);


    //company routes
    // Route::get('company', [PostsController::class, 'index'])->name('company.index');
    // Route::get('company/create', [PostsController::class, 'create'])->name('company.create');
    // Route::get('getCompanyData', [PostsController::class, 'getCompanyData'])->name('company.getCompanyData');
    // Route::post('company/store', [PostsController::class, 'store'])->name('company.store');
    // // Route::get('company/{company}/show',[PostsController::class, 'show'])->name('company.show');
    // Route::get('company/{company}/edit', [PostsController::class, 'edit'])->name('company.edit');
    // Route::put('company/{company}/update',[PostsController::class, 'update'])->name('company.update');
    // Route::delete('company/{company}/destroy',[PostsController::class, 'destroy'])->name('company.destroy');

//post routes
    Route::resource('post',PostsController::class);


    Route::get('getPostData', [PostsController::class, 'getPostData'])->name('post.getPostData');



});
