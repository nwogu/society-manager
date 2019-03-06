<?php

namespace App;

use App\Meeting;
use App\Society;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Attendance extends Pivot
{
    //
    protected $guarded = [];
    
    public $incrementing = true;
    
    //define meeting
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    //define society
    public function society()
    {
        return $this->belongsTo(Society::class);
    }
}
