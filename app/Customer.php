<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'status_id',
        'balance',
        'address_1',
        'address_2',
        'address_3',
        'address_number',
        'zipcode',
        'city_id',
        'notes',
        'name',
        'birthdate',
        'nickname',
        'state_tax_id',
        'city_tax_id',
        'logo_url'
    ];


//    protected $dateFormat = 'Y-m-d H:i:s.u';
    protected $table = 'customers';

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'customer_id');
    }
}
