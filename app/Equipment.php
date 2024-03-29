<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use SoftDeletes;
    protected $table = 'equipments';
    protected $fillable = [
        'install_at',
        'description'
    ];

}
