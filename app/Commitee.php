<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commitee extends Model
{
    //
    protected $guarded = [];

    /**
     * Get Commitee Members
     */
    public function members()
    {
        return $this->belongToMany(User::class, 'commitee_user');
    }
}
