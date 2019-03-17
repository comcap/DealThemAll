<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public $table = 'tbl_asset';
    public $primaryKey = 'asset_ID';

    protected $fillable = [
        'post_ID',
        'asset_name'
    ];
}
