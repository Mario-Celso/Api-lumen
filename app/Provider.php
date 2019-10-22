<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Provider extends Model
{
    use SoftDeletes;

    protected $table = 'providers';
    protected $fillable = [
        'status_id',
        'city_id',
        'trade_name',
        'company_name',
        'logo_url',
        'federal_tax_id',
        'state_tax_id',
        'city_tax_id',
        'creationing_date',
        'opening_date',
        'balance',
        'address_1',
        'address_2',
        'address_3',
        'address_number',
        'zipcode',
        'note',
    ];

//    protected $appends = [
//        'publicId',
//        'tradeName'
//    ];
//
//    protected $hidden = [
//        'public_id',
//        'multi_store_id',
//        'created_at',
//        'deleted_at',
//        'updated_at',
//        'pos_id',
//        'trade_name',
//        'company_name',
//        'logo_url',
//        'federal_tax_id',
//        'state_tax_id',
//        'city_tax_id',
//        'creationing_date',
//        'opening_date',
//        'address_1',
//        'address_2',
//        'address_3',
//        'address_number',
//        'city_id',
//        'status_id'
//    ];

    public function providers_contacts()
    {
        return $this->hasMany(ProviderContact::class);
    }

}
