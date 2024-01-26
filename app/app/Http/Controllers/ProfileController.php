<?php

namespace App\Http\Controllers;

use App\User;

use App\Post;

use App\Category;

use App\Comment;

use App\Like;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\CreateProfile;

class ProfileController extends Controller
{
    public function profile()
    {
        $profile = Auth::user();

        $all = Post::where('user_id', Auth::user()->id)->orderby('created_at', 'DESC')->paginate(10);

        return view('main/my_profile',[
            'profile' => $profile,
            'all' => $all,
        ]);
    }

    public function profileDetailForm()
    {
        $profile = Auth::user();

        return view('main/my_profile_detail',[
            'profile' => $profile,
        ]);
    }

    public function profileDetail(CreateProfile $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->profile = $request->profile;

        if(isset($request->images)){
            $img_path = $request->file('images')->store('public\image');
            $user->images = basename($img_path);
        }

        $user->save();

        return redirect()->route('myprofile');
    }
}
