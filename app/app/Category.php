<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category'];

    public function post() {
        return $this->belongsTo('App\Post', 'category_id');
    }

    public $timestamps = false;
}
