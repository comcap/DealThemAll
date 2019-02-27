<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $table = 'tbl_User';
    public $primaryKey = 'user_ID';

    protected $fillable = [
        'user_name',
        'user_password',
        'user_team_ID',
        'user_email',
        'user_salary',
        'user_birthday',
        'user_gender',
        'user_time_start',
        'user_time_end',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
