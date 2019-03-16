<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $table = "tbl_vdo";
    public $primaryKey = "vdo_ID";

    protected $fillable = [
        'post_ID',
        'vdo_name'
    ];
}
