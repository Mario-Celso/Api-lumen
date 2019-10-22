<?php
/**
 * Created by PhpStorm.
 * User: Trabalho
 * Date: 28/08/2018
 * Time: 12:59
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    public $timestamps = false;

    protected $visible = [
        'id',
        'name'
    ];
}
