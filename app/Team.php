<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $table = 'tbl_team';
    public $primaryKey = 'team_ID';

    protected $fillable = [
        'team_name',
        'team_owner',
        'team_time_start',
        'team_time_end',
        'team_language',
        'team_logo'
    ];
}
