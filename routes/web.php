<?php

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
Route::get('/',[App\Http\Controllers\HomeController::class,'index'])->name('index');
//Route::get('/', function () {
//

////
////    $student = [];
////    $groups = [];
////
////    for ($x=1;$x<=10;$x++){
////        $student[$x] = $x;
////    }
////
////    for ($y=0;$y<count($student)/2;$y++){
////        $groups[$y] = [$student[$y+1],$student[count($student) - ($y)]];
////    }
//    return view('welcome');
////    $book = \App\Models\Book::find(1);
//////    $user = auth()->user();
////
////    $book->comments()->create([
////        'comment'=>'Third comment',
////        'user_id'=>auth()->user()->id
////    ]);
////    $comment = \App\Models\Comment::find(10);
////    dd($comment);
////    return $comment->commentable;
//});


Route::prefix('auth')->middleware('guest')->group(function (){
    Route::get('login',[App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('auth.loginForm');
    Route::post('login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('auth.login');
    Route::get('register',[App\Http\Controllers\Auth\RegisterController::class,'showRegisterForm'])->name('auth.registerForm');
    Route::post('register',[App\Http\Controllers\Auth\RegisterController::class,'register'])->name('auth.register');
});
Route::get('/books/index',[App\Http\Controllers\Site\BookController::class,'index'])->name('books.index');
Route::get('/nav/search',[App\Http\Controllers\Site\BookController::class,'index'])->name('nav.search');
Route::get('/books/{book}/details',[App\Http\Controllers\Site\BookController::class,'bookItem'])->name('book.details');
Route::post('/send/comment',[App\Http\Controllers\Book\CommentController::class,'sendComment'])->name('send.comment');

//cart
Route::post('/card/add/{book}',[App\Http\Controllers\CartController::class,'addToCart'])->name('card.add');

Route::post('/cart/quantity/change',[App\Http\Controllers\CartController::class,'quantityChange'])->name('cart.changeQuantity');
Route::delete('/cart/{cart}/delete',[App\Http\Controllers\CartController::class,'deleteFromCart'])->name('cart.delete');
Route::middleware('auth')->group(function (){
    Route::get('/checkoutList',[App\Http\Controllers\CartController::class,'checkoutList'])->name('cart.checkoutList');
    Route::post('/payment/create',[App\Http\Controllers\PaymentController::class,'payment'])->name('payment.create');
    Route::post('/payment/callback',[App\Http\Controllers\PaymentController::class,'callback'])->name('payment.callback');
    Route::get('/successfullPayment',[App\Http\Controllers\CartController::class,'checkoutList']);
    Route::post('/discount-code/submit',[App\Http\Controllers\Admin\DiscountCodeController::class,'checkCode'])->name('cart.checkDiscountCode');

});
Route::get('/auth/logout',function (){
    auth()->logout();
    return redirect(route('index'));
})->name('auth.logout');

