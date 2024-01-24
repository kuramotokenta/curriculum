<?php

namespace App\Http\Controllers;

use App\User;

use App\Post;

use App\Category;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

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

        $first = $request->input('first');
        $end = $request->input('end');
        $category = $request->input('type_id');

        $post = Post::where('del_flg', 0)->orderby('created_at', 'DESC');

        if (isset($first) && isset($end)) {
            $post->whereBetween('created_at',[$first,$end]);
        }

        if (isset($category)) {
            $post->where('type_id',[$category]);
        }

        $all = $post->paginate(10);

        return view('main/main',[
            'params' => $params,
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
        $params = Category::get();

        return view('main/new_post',[
            'params' => $params,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;

        $id = Auth::user()->id;
        $post->user_id = $id;
        
        $post->title = $request->title;
        $img_path = $request->file('post_img')->store('public\image');
        $post->post_img = basename($img_path);
        $post->type_id = $request->type_id;
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

        $post = new Post;

        $result = $post->find($id);

        return view('main/post_detail',[
            'id' => $post->id,
            'params' => $params,
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
    public function update(Request $request, $id)
    {
        $post = new Post;
        $record = $post->find($id);

        $record->title = $request->title;
        $img_path = $request->file('post_img')->store('public\image');
        $record->post_img = basename($img_path);
        $record->type_id = $request->type_id;
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

        $post->delete();

        return redirect()->route('myprofile');
    }

    public function delFlg($id)
    {
        $flg = 1;

        $post = new Post;
        $post = Post::find($id);

        $post->del_flg = $flg;

        $post->save();

        return redirect()->route('myprofile');
    }
}
