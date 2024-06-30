<?php
use App\Http\Controllers\AdminAuth\LoginController;
use App\Http\Controllers\AdminView\AdminViewController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::get('profile',[AdminViewController::class,'admin_profile'])->name('admin.profile');
    Route::get('found-items',[AdminViewController::class,'found_items'])->name('admin.found');
    Route::get('lost-items',[AdminViewController::class,'lost_items'])->name('admin.lost');
    Route::get('returned-items',[AdminViewController::class,'returned_items'])->name('admin.returned');
    Route::post('create-category',[AdminViewController::class,'create_category'])->name('admin.create.category');
    Route::get('profile/edit/{id}',[AdminViewController::class,'get_profile_form'])->name('admin.edit.form');
    Route::put('admin/profile/update/{id}',[AdminViewController::class,'user_profile_update'])->name('admin.put.profile');
    Route::delete('category/{id}',[AdminViewController::class,'category_delete'])->name('admin.category.delete');
    Route::get('found-item-details/{id}/',[AdminViewController::class,'found_item_details'])->name('admin.found.details');
    Route::get('lost-item-details/{id}/',[AdminViewController::class,'lost_item_details'])->name('admin.lost.details');
    Route::get('manage-found-items',[AdminViewController::class,'manage_found'])->name('admin.found.manage');
    Route::get('edit-found-item/{id}',[AdminViewController::class,'edit_found_item'])->name('admin.found.edit');
    Route::put('edit-found/{id}',[AdminViewController::class,'found_item_update'])->name('admin.put.found');
    Route::delete('delete-found/{id}',[AdminViewController::class,'found_delete'])->name('admin.delete.found');
    Route::get('manage-lost-items',[AdminViewController::class,'manage_lost'])->name('admin.lost.manage');
    Route::get('lost-item/{id}',[AdminViewController::class,'edit_lost_item'])->name('admin.lost.edit');
    Route::put('lost-item-update/{id}',[AdminViewController::class,'lost_item_update'])->name('admin.put.lostitem');
    Route::delete('lost-item-delete/{id}',[AdminViewController::class,'delete_lostitem'])->name('admin.delete.lostitem');
    Route::get('returned-item-details/{id}',[AdminViewController::class,'return_item_details'])->name('admin.get.returned.details');
    Route::delete('returned-item-delete/{id}',[AdminViewController::class,'return_delete'])->name('admin.delete.returnitem');
    Route::get('search-box',[AdminViewController::class,'box_search'])->name('admin.get.search'); 
    Route::get('category-search/{cat_name}',[AdminViewController::class,'cat_search'])->name('admin.get.catsearch');
    

});
