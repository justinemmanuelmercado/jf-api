<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicantRequirement extends Model
{
    //
    protected $primaryKey = 'applicant_id';
    protected $fillable = ['applicant_id'];
}
