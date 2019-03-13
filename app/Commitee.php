<?php

namespace App;

use App\Report;
use App\Collection;
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

    //define reports
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    //define collection
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
