<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    //複数代入を可能にする記述
    protected $fillable = [
    'following_id','followed_id'
    ];
}
