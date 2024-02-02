<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

use App\Http\Requests\SendEmailRequest;

use App\Http\Requests\CreateData;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\CreateProfile;

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

   //  コメント確認
    Route::get('/profile/{id}', [ResourceController::class, 'postComment'])->name('post.comment');
    
    // 投稿編集
    Route::get('/edit_post/{id}', [ResourceController::class, 'edit'])->name('edit.post');
    Route::post('/edit_post/{id}', [ResourceController::class, 'update']);

    // 削除機能・論理削除
    Route::get('/delete_post/{id}', [ResourceController::class,'destroy'])->name('delete');
    Route::get('/del_flg_post/{id}', [ResourceController::class, 'delFlg'])->name('delflg');

    // ユーザー削除機能・論理削除
    Route::get('/user_list', [ResourceController::class,'userindex'])->name('user.list');
    Route::get('/delete_user/{id}', [ResourceController::class,'userdestroy'])->name('user.delete');
    Route::get('/del_flg_user/{id}', [ResourceController::class, 'userdelFlg'])->name('user.delflg');

    // 管理者によるカテゴリー追加
    Route::get('/create_category', [ResourceController::class, 'createCategory'])->name('category');
    Route::post('/create_category', [ResourceController::class, 'category']);
});
