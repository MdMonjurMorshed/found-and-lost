<?php
use App\Http\Controllers\UserView\UserViewController;
use App\Http\Controllers\MessageSent\MessageSentController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth.guard:web')->prefix('user')->group(function(){
    Route::get('option-select/{route}',[UserViewController::class,'select_item'])->name('select.item');
    Route::get('profile',[UserViewController::class,'user_profile'])->name('user.profile');
    Route::get('found-items',[UserViewController::class,'found_items'])->name('user.found');
    Route::get('lost-items',[UserViewController::class,'lost_items'])->name('user.lost');
    Route::get('returned-items',[UserViewController::class,'returned_items'])->name('user.returned');
    Route::get('post-found-item',[UserViewController::class,'post_found_items'])->name('user.post.found');
    Route::get('post-lost-item',[UserViewController::class,'lost_item_form'])->name('user.post.lost');
    Route::post('add-found-item',[UserViewController::class,'post_found_item'])->name('user.post.found.add');
    Route::post('add-lost-item',[UserViewController::class,'lost_item_add'])->name('user.post.lost.add');
    Route::get('found-item-details/{id}/',[UserViewController::class,'found_item_details'])->name('user.found.details');
    Route::get('lost-item-details/{id}/',[UserViewController::class,'lost_item_details'])->name('user.lost.details');
    Route::get('return-item-details/{id}/',[UserViewController::class,'return_item_details'])->name('user.return.details');
    // update user
    Route::get('user/{id}',[UserViewController::class,'user_porofile_edit_form'])->name('user.edit.form');
    Route::put('user-profile-edit/{id}',[UserViewController::class,'user_profile_update'])->name('user.put.edit');

    // my listing
    Route::get('my-listing',[UserViewController::class,'my_listing'])->name('user.mylisting');

    // chat message
    Route::get('get-message/{message_id}',[MessageSentController::class,'get_user_message'])->name('user.chatbox');
    
    //chat box user
    Route::get('chat-box',[MessageSentController::class,'chat_box_user'])->name('user.chatboxuser');

    // claim item

    Route::get('claim-item/{founditem}',[UserViewController::class,'claim_item'])->name('user.claimitem');

    // update claim status
    Route::get('/update-claim/{claim_id}',[UserViewController::class,'update_claim_status'])->name('user.claim.update');

    //return claimed item
    Route::get('/return-claimed-item/{founditem}',[UserViewController::class,'return_claimed_item'])->name('user.item.return');


    //report item
    Route::get('report-item/{lostitem}',[UserViewController::class,'report_item'])->name('user.reportitem');

    //veryfy reporter

    Route::get('/update-reporter/{report_id}',[UserViewController::class,'verify_reporter'])->name('user.reporter.verify');

    // get back lost item

    Route::get('/lost-item-returned/{lostitem}',[UserViewController::class,'lost_item_returned'])->name('user.lost.return');

    // my listings delete

    Route::delete('mylisting-delete/{id}',[UserViewController::class,'delete_mylisting'])->name('user.delete.mylisting');

    // search category
    Route::get('category-search/{cat_name}',[UserViewController::class,'cat_search'])->name('user.get.catsearch');

    // search-box search
    Route::get('search-box',[UserViewController::class,'box_search'])->name('user.get.search'); 


   
    

});