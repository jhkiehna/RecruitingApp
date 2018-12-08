<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employer extends Model
{
    use SoftDeletes;

    protected $table = 'employers';

    protected $fillable = [
        'walter_id',
        'first_name',
        'last_name',
        'company',
        'email',
        'phone',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function transform()
    {
        return [
            'id' => $this->id,
            'walter_id' => $this->walter_id,
            'name' => $this->full_name,
            'company' => $this->company,
            'phone' => $this->phone,
            'email' => $this->email
        ];
    }

    public function mailTransform()
    {
        return [
            'name' => $this->full_name,
            'company' => $this->company,
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
}
