<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2019-01-24
 * Time: 01:35
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameRole extends model
{
    public $table = 'tbl_Game_role';
    public $primaryKey = 'Game_roleID';

    protected $fillable = [
        'game_ID',
        'typeID'
    ];
}