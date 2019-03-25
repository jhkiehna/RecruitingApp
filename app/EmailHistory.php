<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailHistory extends Model
{
    protected $table = 'email_histories';

    protected $fillable = [
        'employer_id',
        'candidate_id',
    ]
}
