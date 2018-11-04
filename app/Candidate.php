<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';

    protected $fillable = [
        'walter_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'street_address_1',
        'street_address_2',
        'city',
        'state',
    ];

    public function transformer()
    {
        return [
            'walter_id' => $this->walter_id,
            'name' => $this->full_name,
            'address' => $this->full_address,
            'city' => $this->city,
            'state' => $this->state,
            'phone' => $this->phone,
            'email' => $this->email
        ];
    }

    public function getWalterIdAttribute($walter_id)
    {
        return $walter_id ?? 'No ID';
    }

    public function getFullNameAttribute()
    {
        return $this->first_name .' '. $this->last_name;
    }

    public function getFullAddressAttribute()
    {
        return $this->street_address_1 .', '. $this->street_address_2;
    }
}
