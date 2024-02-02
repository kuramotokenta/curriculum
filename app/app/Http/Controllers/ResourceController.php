<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Category;
use App\Comment;
use App\Like;
use App\Prefecture;
use DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\CreateData;
use App\Http\Requests\CreateCategory;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = Category::get();
        $prefectures = Prefecture::orderBy('id','asc')->get();

        $first = $request->input('first');
        $end = $request->input('end');
        $prefecture = $request->input('prefecture_id');
        $category = $request->input('category_id');

        $post = Post::where('del_flg', 0)->orderby('created_at', 'DESC');

        if (isset($first) && isset($end)) {
            $post->whereBetween('created_at',[$first,$end]);
        }

        if (isset($prefecture)) {
            $post->where('prefecture_id',[$prefecture]);
        }        

        if (isset($category)) {
            $post->where('category_id',[$category]);
        }

        $all = $post->paginate(5);
        
        return view('main/main',[
            'params' => $params,
            'prefectures' => $prefectures,
            'all' => $all,
            'first' => $first,
            'end' => $end,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->get();

        $params = Category::get();
        $prefectures = Prefecture::orderby('id','asc')->get();

        return view('main/new_post',[
            'user' => $user,
            'params' => $params,
            'prefectures' => $prefectures,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateData $request)
    {
        $post = new Post;

        $id = Auth::user()->id;
        $post->user_id = $id;
        
        $post->title = $request->title;
        $img_path = $request->file('post_img')->store('public\image');
        $post->post_img = basename($img_path);
        $post->prefecture_id = $request->prefecture_id;
        $post->category_id = $request->category_id;
        $post->text = $request->text;

        $post->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $params = Category::get();
        $prefectures = Prefecture::orderby('id','asc')->get();

        $result = Post::find($id);

        return view('main/post_detail',[
            'params' => $params,
            'prefectures' => $prefectures,
            'result' => $result,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateData $request,$id)
    {
        $record = Post::find($id);

        $record->title = $request->title;
        $img_path = $request->file('post_img')->store('public\image');
        $record->post_img = basename($img_path);
        $record->prefecture_id = $request->prefecture_id;
        $record->category_id = $request->category_id;
        $record->text = $request->text;

        $record->save();

        return redirect()->route('myprofile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $postid = Comment::find($post->id);
        $postlike = Like::find($post->id);

        if(!empty($postid)){
            $postid->delete();
        };

        if(!empty($postlike)){
            $post->delete();
        };
        
        $post->delete();

        return back();
    }

    public function delFlg($id)
    {
        $flg = 1;

        $post = Post::find($id);

        $post->del_flg = $flg;

        $post->save();

        return back();
    }

    public function userindex ()
    {
        $user = User::get();

        return view('main/user_list',[
            'user' => $user,
        ]);
    }

    public function userdestroy($id)
    {
        $user = User::find($id);
        $post = Post::where('user_id',$id);

        $user->delete();
        $post->delete();

        return redirect()->route('user.list');
    }

    public function userdelFlg($id)
    {
        $flg = 1;

        $user = User::find($id);
        $user->del_flg = $flg;

        $user->save();

        return redirect()->route('user.list');
    }

    public function createCategory()
    {
        return view('main/create_category');
    }

    public function category(CreateCategory $request)
    {
        $category = new Category;
        $category->category = $request->category;

        $category->save();

        return redirect()->route('new_post');
    }

    public function postComment($id)
    {
        $comment = Post::find($id)->comment;

        return view('main/comment_list',[
            'comment' => $comment,
        ]);
    }
}
