<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessAdditionalData extends Model
{
    //
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'longitude', 'latitude', 'description', 'business_name'];
}
