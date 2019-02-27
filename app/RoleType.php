<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2019-01-26
 * Time: 13:27
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleType extends model
{
    public $table = 'tbl_Role_type';
    public $primaryKey = 'typeID';

    protected $fillable = [
        'typeName',
        'type_Image'
    ];
}