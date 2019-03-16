<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = "tbl_comment";
    public $primaryKey = "comment_ID";

    protected $fillable = [
        'post_ID',
        'user_ID',
        'textMessage'
    ];
}
