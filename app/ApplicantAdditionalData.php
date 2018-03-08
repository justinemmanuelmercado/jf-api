<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicantAdditionalData extends Model
{
    //
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'date_of_birth', 'first_name', 'last_name', 'number', 'education_attained', 'education', 'email', 'extra_skills'];
}
