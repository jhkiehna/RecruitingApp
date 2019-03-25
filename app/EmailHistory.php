<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailHistory extends Model
{
    protected $table = 'email_histories';

    protected $fillable = [
        'employer_id',
        'candidate_id',
    ];

    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'candidate_id');
    }

    public function employer()
    {
        return $this->hasOne(Employer::class, 'employer_id');
    }
}
