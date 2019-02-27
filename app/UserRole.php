<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2019-01-24
 * Time: 01:21
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $table = 'tbl_User_Role';
    public $primaryKey = 'user_RoleID';

    protected $fillable = [
        'user_ID',
        'game_ID',
        'role_ID',
        'stateRole',
        'updated_at',
        'created_at'
    ];
}