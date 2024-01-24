<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

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
Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::prefix('password_reset')->name('password_reset.')->group(function () {
         Route::prefix('email')->name('email.')->group(function () {
             // パスワードリセットメール送信フォームページ
             Route::get('/', [PasswordController::class, 'emailFormResetPassword'])->name('form');
             // メール送信処理
             Route::post('/', [PasswordController::class, 'sendEmailResetPassword'])->name('send');
             // メール送信完了ページ
             Route::get('/send_complete', [PasswordController::class, 'sendComplete'])->name('send_comp');
         });
         // パスワード再設定ページ
         Route::get('/edit', [PasswordController::class, 'edit'])->name('pass_conf');
         // パスワード更新処理
         Route::post('/update', [PasswordController::class, 'update'])->name('update');
         // パスワード更新終了ページ
         Route::get('/edited', [PasswordController::class, 'edited'])->name('pass_comp');
     });

    Route::get('/', [ResourceController::class, 'index'])->name('main');
    Route::post('/',[ResourceController::class, 'index']);
    // 新規登録
    Route::get('/created_post', [ResourceController::class, 'create'])->name('new_post');
    Route::post('/created_post', [ResourceController::class, 'store']);

    // いいね機能
    Route::post('/like/{postId}',[LikeController::class,'store']);
    Route::post('/unlike/{postId}',[LikeController::class,'destroy']);

    // コメント機能
    Route::post('/post/comment/store',[CommentController::class,'commentStore'])->name('comment.store');

    // プロフィールページ
    Route::get('/profile', [ProfileController::class, 'profile'])->name('myprofile');

    // プロフィール編集
    Route::get('/profile/detail', [ProfileController::class, 'profileDetailForm'])->name('profile.detail');
    Route::post('/profile/detail', [ProfileController::class, 'profileDetail']);
    

    // 投稿編集
    Route::get('/edit_post/{id}', [ResourceController::class, 'edit'])->name('edit.post');
    Route::post('/edit_post/{id}', [ResourceController::class, 'update']);

    // 削除機能・論理削除
    Route::get('/delete_post/{id}', [ResourceController::class,'destroy'])->name('delete');
    Route::get('/del_flg_post/{id}', [ResourceController::class, 'delFlg'])->name('delflg');
});