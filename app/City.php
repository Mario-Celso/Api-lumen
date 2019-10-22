<?php
/**
 * Created by PhpStorm.
 * User: acs
 * Date: 31/10/18
 * Time: 13:32
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    public $timestamps = false;

    protected $appends = [
        'state_id'
    ];

    protected $hidden = [
        'state_id',
        'slug'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
