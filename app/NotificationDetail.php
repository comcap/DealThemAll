<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationDetail extends Model
{
    public $table = 'tbl_notificaiton_detail';
    public $primaryKey = 'detailID';

    protected $fillable = [
        'notificaitonID',
        'teamID',
        'senderID',
        'notificationText',
        'gameID'
    ];
}