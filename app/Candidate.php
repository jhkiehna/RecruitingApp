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
        'location_preference',
        'email',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function transform()
    {
        if (strlen($this->summary) >= 50) {
            $summary = substr($this->summary, 0, 50) . '...';
        }
        else {
            $summary = $this->summary;
        }

        return [
            'id' => $this->id,
            'walter_id' => $this->walter_id,
            'name' => $this->full_name,
            'industry' => $this->industry,
            'job_title' => $this->job_title,
            'location_preference' => $this->location_preference,
        ];
    }

    public function getWalterIdAttribute($walter_id)
    {
        return $walter_id;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name .' '. $this->last_name;
    }
}
