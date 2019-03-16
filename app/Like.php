<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $table = "tbl_like";
    public $primaryKey = "like_ID";

    protected $fillable = [
        'post_ID',
        'user_ID'
    ];
}
