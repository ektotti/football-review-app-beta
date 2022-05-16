<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $guarded = [
        'id',
    ];

    public function member() {
        $this->hasMany('App\Member');
    }
}
