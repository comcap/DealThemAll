<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2019-01-06
 * Time: 16:34
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $table = 'tbl_Game';
    public $primaryKey = 'game_ID';

    protected $fillable = [
        'game_type_ID',
        'game_name',
        'game_Img',
        'game_logo',
        'created_at',
        'updated_at'
    ];
}