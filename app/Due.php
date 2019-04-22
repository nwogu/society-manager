<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Due extends Model
{
    //
    protected $fillable = ['name', 'amount', 'interval_type', 'interval_duration'];

}
