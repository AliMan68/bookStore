<?php

use Illuminate\Support\Facades\Route;

Route::resource('books','\App\Http\Controllers\Book\BookController')->except(['show']);


//categories

Route::get('categories/management',[App\Http\Controllers\Book\BookController::class,'categoriesIndex'])->name('categories.index');
Route::post('categories/store',[App\Http\Controllers\Book\BookController::class,'storeCategory'])->name('categories.store');
Route::post('categories/{category}/destroy',[App\Http\Controllers\Book\BookController::class,'destroyCategory'])->name('categories.destroy');

//writers

Route::get('writers/management',[App\Http\Controllers\Book\BookController::class,'writersIndex'])->name('writers.index');
Route::post('writers/store',[App\Http\Controllers\Book\BookController::class,'storeWriter'])->name('writers.store');
Route::post('writers/destroy',[App\Http\Controllers\Book\BookController::class,'destroyWriter'])->name('writers.destroy');
//translators

Route::get('translators/management',[App\Http\Controllers\Book\BookController::class,'translatorsIndex'])->name('translators.index');
Route::post('translators/store',[App\Http\Controllers\Book\BookController::class,'storeTranslator'])->name('translators.store');
Route::post('translators/{translator}/destroy',[App\Http\Controllers\Book\BookController::class,'destroyTranslator'])->name('translators.destroy');

//comments
Route::get('/comments/pending',[App\Http\Controllers\Book\CommentController::class,'pendingComments'])->name('comments.pending');
Route::post('/comments/{comment}/confirm',[App\Http\Controllers\Book\CommentController::class,'confirmComments'])->name('comments.confirm');
Route::post('/comments/{comment}/reject',[App\Http\Controllers\Book\CommentController::class,'rejectComments'])->name('comments.reject');
Route::get('/comments/manage',[App\Http\Controllers\Book\CommentController::class,'manageComments'])->name('comments.manage');

//user orders
Route::get('/my-orders',[App\Http\Controllers\OrderController::class,'userOrders'])->name('user.orders');
Route::get('/order/{order}/payment',[App\Http\Controllers\OrderController::class,'payment'])->name('order.payment');
Route::get('/orders',[App\Http\Controllers\OrderController::class,'index'])->name('orders');
Route::post('/order/{order}/deliver',[App\Http\Controllers\OrderController::class,'deliverOrder'])->name('order.deliver');


//

Route::resource('users','\App\Http\Controllers\Admin\UserController');
Route::get('/users/{user}/permissions/create',[App\Http\Controllers\Admin\UsersPermissionsController::class,'create'])->name('users.permissions.create');
Route::post('/users/{user}/permissions/store',[App\Http\Controllers\Admin\UsersPermissionsController::class,'store'])->name('users.permissions.store');

Route::resource('permissions','\App\Http\Controllers\Admin\PermissionController');
Route::resource('roles','\App\Http\Controllers\Admin\RoleController');

//publish request
Route::get('/publish-request/Pindex',[App\Http\Controllers\Admin\PublishmentController::class,'index'])->name('publish-request.index');
Route::get('/publish-request/create',[App\Http\Controllers\Admin\PublishmentController::class,'create'])->name('publish-request.create');
Route::post('/publish-request/store',[App\Http\Controllers\Admin\PublishmentController::class,'store'])->name('publish-request.store');
Route::delete('/publish-request/{publishmentRequest}/destroy',[App\Http\Controllers\Admin\PublishmentController::class,'destroy'])->name('publish-request.destroy');

//deliver-book
Route::get('/deliver-book/index',[App\Http\Controllers\Admin\DeliverController::class,'index'])->name('deliver-book.index');
Route::post('/deliver-book/store',[App\Http\Controllers\Admin\DeliverController::class,'store'])->name('deliver-book.store');
Route::delete('/deliver-request/{deliver}/destroy',[App\Http\Controllers\Admin\DeliverController::class,'destroy'])->name('deliver-book.destroy');

//book-other-sale
Route::get('/other-sale/index',[App\Http\Controllers\Admin\OtherSalesController::class,'index'])->name('other-sale.index');
Route::post('/other-sale/store',[App\Http\Controllers\Admin\OtherSalesController::class,'store'])->name('other-sale.store');
Route::delete('/other-sale/{sale}/destroy',[App\Http\Controllers\Admin\OtherSalesController::class,'destroy'])->name('other-sale.destroy');

//report

//Route::get('/report',function (){
//    return view('admin.report');
//})->name('report');
Route::get('report',[App\Http\Controllers\OrderController::class,'report']);
Route::post('report',[App\Http\Controllers\OrderController::class,'report'])->name('report');

//discount-code
Route::get('/discount-code/index',[App\Http\Controllers\Admin\DiscountCodeController::class,'index'])->name('discount-code.index');
Route::post('/discount-code/store',[App\Http\Controllers\Admin\DiscountCodeController::class,'store'])->name('discount-code.store');
Route::delete('/discount-code/{code}/destroy',[App\Http\Controllers\Admin\DiscountCodeController::class,'destroy'])->name('discount-code.destroy');


//manage news
Route::get('/news/index',[App\Http\Controllers\Admin\NewsController::class,'index'])->name('news.index');
Route::post('/news/store',[App\Http\Controllers\Admin\NewsController::class,'store'])->name('news.store');
Route::post('/news/{news}/update',[App\Http\Controllers\Admin\NewsController::class,'update'])->name('news.update');
Route::delete('/news/{news}/destroy',[App\Http\Controllers\Admin\NewsController::class,'destroy'])->name('news.destroy');

//Settings
Route::get('/setting/index',[App\Http\Controllers\Admin\SettingController::class,'index'])->name('setting.index');
Route::post('/setting/store',[App\Http\Controllers\Admin\SettingController::class,'store'])->name('setting.store');


//Profile
Route::get('/profile/index',[App\Http\Controllers\Auth\RegisterController::class,'editProfile'])->name('profile.index');
Route::post('/profile/{user}/update',[App\Http\Controllers\Auth\RegisterController::class,'update'])->name('profile.update');

