<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $table = 'tbl_notificaiton';
    public $primaryKey = 'notificationID';

    protected $fillable = [
        'notification_User',
		'notification_isRead',
	    'notification_type'
    ];
}
