<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class ProviderContact extends Model
{
    protected $table = 'providers_contacts';

    public $timestamps = false;

    protected $fillable = [
        'description',
        'phone',
        'email',
        'name'
    ];

    protected $hidden = [
        'id',
        'provider_id'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

}
