<?php

namespace App;

use App\Meeting;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    public function reportable()
    {
        return $this->morphTo();
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
