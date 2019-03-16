<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $table = "tbl_image";
    public $primaryKey = "image_ID";

    protected $fillable = [
        'post_ID',
        'image_name'
    ];
}
