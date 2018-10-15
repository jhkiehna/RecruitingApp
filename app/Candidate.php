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
}
