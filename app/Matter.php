<?php

namespace App;

use App\User;
use App\Meeting;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $guarded = [];

    //define member
    public function raisedBy()
    {
        return $this->belongsTo(User::class, 'raised_by');
    }

    //define meeting
    public function reportedDuring()
    {
        return $this->belongsTo(Meeting::class);
    }

    //define society
    public function society()
    {
        return $this->belongsTo(Society::class);
    }
}
