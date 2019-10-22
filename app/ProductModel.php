<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use SoftDeletes;

    protected $table = 'product_models';

    public $timestamps = false;

    protected $fillable = [
        'model',
        'product_producers_id'
    ];

}
