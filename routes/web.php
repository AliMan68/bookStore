<?php

use App\Http\Controllers\Auth\MyRegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
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
//Route::get('/',[App\Http\Controllers\HomeController::class,'index'])->name('index');
Route::get('/',\App\Livewire\Index::class)->name('index');
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
    Route::get('confirm-code',[App\Http\Controllers\Auth\LoginController::class,'showConfirmCode'])->name('auth.confirmCode');
    Route::post('login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('auth.login');
    Route::get('register',[App\Http\Controllers\Auth\RegisterController::class,'showRegisterForm'])->name('auth.registerForm');
    Route::post('register',[App\Http\Controllers\Auth\RegisterController::class,'register'])->name('auth.register');

    Route::get('/register/mobile', [MyRegisterController::class, 'registerMobile'])->name('register.mobile');
    Route::post('/register/send-code', [MyRegisterController::class, 'sendCode'])->name('register.send-code');
    Route::post('/register/verify-mobile', [MyRegisterController::class, 'verifyMobile'])->name('register.verify-mobile');
    Route::get('/reset-password/form', [ResetPasswordController::class, 'showResetForm'])->name('reset-password.form');
    Route::post('/reset-password/send-code', [ResetPasswordController::class, 'sendCode'])->name('reset-password.send-code');
    Route::post('/reset-password/reset', [ResetPasswordController::class, 'reset'])->name('reset-password.reset');
});

//Route::get('/books/index',[App\Http\Controllers\Site\BookController::class,'index'])->name('books.index');
Route::get('/books/index',\App\Livewire\Books::class)->name('books.index');
Route::get('/nav/search',[App\Http\Controllers\Site\BookController::class,'index'])->name('nav.search');
//Route::get('/books/{book}/details',[App\Http\Controllers\Site\BookController::class,'bookItem'])->name('book.details');
Route::get('/books/{book}/details',\App\Livewire\BookDetails::class)->name('book.details');
Route::post('/send/comment',[App\Http\Controllers\Book\CommentController::class,'sendComment'])->name('send.comment');

//cart
Route::post('/card/add/{book}',[App\Http\Controllers\CartController::class,'addToCart'])->name('card.add');

Route::post('/cart/quantity/change',[App\Http\Controllers\CartController::class,'quantityChange'])->name('cart.changeQuantity');
Route::delete('/cart/{cart}/delete',[App\Http\Controllers\CartController::class,'deleteFromCart'])->name('cart.delete');
Route::middleware('auth')->group(function (){
    Route::get('/checkoutList',[App\Http\Controllers\CartController::class,'checkoutList'])->name('cart.checkoutList');
    Route::post('/payment/create',[App\Http\Controllers\PaymentController::class,'payment'])->name('payment.create');
    Route::post('/payment/callback',[App\Http\Controllers\PaymentController::class,'callback'])->name('payment.callback');
    Route::post('/discount-code/submit',[App\Http\Controllers\Admin\DiscountCodeController::class,'checkCode'])->name('cart.checkDiscountCode');
});
//Route::get('/success',[App\Http\Controllers\PaymentController::class,'success'])->name('payment.success');
//Route::get('/payment/failed',[App\Http\Controllers\PaymentController::class,'failed'])->name('payment.failed');


Route::get('/auth/logout',function (){
    auth()->logout();
    return redirect(route('index'));
})->name('auth.logout');

//Route::get('/news/{news}/details',[App\Http\Controllers\Admin\NewsController::class,'show'])->name('news.details');
Route::get('/news/{news}/details',\App\Livewire\NewsDetails::class)->name('news.details');
//Route::get('/news',[App\Http\Controllers\Admin\NewsController::class,'allNews'])->name('news.index');
Route::get('/news',\App\Livewire\AllNews::class)->name('news.index');


//payments

Route::post('/payment/verify/sadad', [App\Http\Controllers\PaymentController::class, 'sadadPaymentVerify'])->name('payment.verify.sadad');
Route::post('/payment/verify/saman', [App\Http\Controllers\PaymentController::class, 'samanPaymentVerify'])->name('payment.verify.saman');
Route::post('/payment/verify/irankish', [App\Http\Controllers\PaymentController::class, 'irankishPaymentVerify'])->name('payment.verify.irankish');
Route::post('/payment/verify/parsian', [App\Http\Controllers\PaymentController::class, 'parsianPaymentVerify'])->name('payment.verify.parsian');
