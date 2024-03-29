<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2019-01-06
 * Time: 16:34
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsPlayer extends Model
{
    public $table = 'tbl_stats_player';
    public $primaryKey = 'stats_playerID';

    protected $fillable = [
        'user_ID',
        'game_ID',
        'userPath',
        'nameInGame',
        'iconPlayer',
        'rank_total',
        'won_total',
        'accuracy_total',
        'time_total',
        'kill_total',
        'headshot_total',
        'created_at',
        'updated_at'
    ];
}