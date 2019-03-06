<?php

namespace App;

use App\Task;
use App\User;
use App\Matter;
use App\Report;
use App\Society;
use App\Attendance;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    protected $guarded = [];

    /**
     * Society Relationship
     */
    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    //define reports
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    //define matters
    public function matters()
    {
        return $this->hasMany(Matter::class);
    }

    //define tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    //define attendance
    public function attendances()
    {
        return $this->belongsToMany(User::class)->using(Attendance::class);
    }

    //define presider
    public function presider()
    {
        return $this->belongsTo(User::class, 'presider');
    }
}
