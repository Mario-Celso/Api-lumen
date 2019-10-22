<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $fillable = [
        'pos_id',
        'name',
        'color',
        'description'
    ];

//    protected $dateFormat = 'Y-m-d H:i:s.u';
    protected $table = 'customers_groups';

}
