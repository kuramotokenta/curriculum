<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','title','post_img','type_id','text','del_flg'];

    public function category() {
        return $this->hasMany('App\Category','type_id');
    }

    public function comment() {
        return $this->hasMany('App\Comment','post_id');
    }
}
