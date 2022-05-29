<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [
        'id',
    ];

    function fixture() {
        return $this->belongsTo('App\Fixture');
    }
    function user() {
        return $this->belongsTo('App\User');
    }

    function comments(){
        return $this->hasMany('App\Comment');
    }
}
