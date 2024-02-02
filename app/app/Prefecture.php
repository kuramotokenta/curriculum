<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    protected $fillable = ['name'];

    public function post()
    {
        return $this->hasMany('App\Post');
    }
    public $timestamps = false;
}
