<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use SoftDeletes;

    protected $table = 'candidates';

    protected $fillable = [
        'walter_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function transform()
    {
        return [
            'walter_id' => $this->walter_id,
            'name' => $this->full_name,
            'phone' => $this->phone,
            'email' => $this->email
        ];
    }

    public function mailTransform()
    {
        return [
            'testField' => 'test test'
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
}
