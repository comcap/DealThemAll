<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    public $table = "tbl_feed";
    public $primaryKey = "post_ID";

    protected $fillable = [
        'user_ID',
        'game_ID',
        'postType_ID',
        'post_detail'
    ];
}
