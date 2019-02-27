<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamManager extends Model
{
    public $table = 'tbl_team_manager';
    public $primaryKey = 'managerID';

    protected $fillable =[
        'managerID',
        'teamID',
        'game_ID',
        'user_ID',
        'user_verify'
    ];
}
