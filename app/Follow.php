<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public $table = "tbl_Follow";
    public $primaryKey = "follow_id";

    protected $fillable = [
        "user_ID",
        "user_follower_ID"
    ];
}
