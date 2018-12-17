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
        'job_title',
        'industry',
        'summary',
        'city',
        'state',
        'email',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function transform()
    {
        return [
            'id' => $this->id,
            'walter_id' => $this->walter_id,
            'name' => $this->full_name,
            'industry' => $this->industry,
            'summary' => $this->job_title . ' - ' . substr($this->summary, 0, 50) . '...',
            'city' => $this->city,
            'state' => $this->state,
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

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = strtoupper($value);
    }
}
