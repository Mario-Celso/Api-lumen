<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductProducer extends Model
{
    use SoftDeletes;

   protected $table = 'product_producers';

   public $timestamps = false;

   protected $fillable = [
        'name'
    ];

    public function model()
    {
        return $this->hasMany(ProductModel::class, 'product_producers_id');
    }

}
