<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicantRequirement extends Model
{
    //
    protected $primaryKey = 'id';
    protected $fillable = ['applicant_id', 'skill', 'years_exp'];
}
