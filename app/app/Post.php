<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','title','post_img','category_id','prefecture_id','text','del_flg'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function like() {
        return $this->belongsTo('App\Like','post_id');
    }

    public function comment() {
        return $this->hasMany('App\Comment','post_id');
    }



    public function prefecture()
    {
        return $this->belongsTo('App\prefecture', 'prefecture_id');
    }
}
