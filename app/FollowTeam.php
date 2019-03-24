<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowTeam extends Model
{
    public $table = "tbl_team_follow";
    public $primaryKey = "followteamID";

    protected $fillable = [
        "teamID",
        "userID"
    ];
}
