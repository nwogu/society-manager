<?php

namespace App;

use App\Task;
use App\User;
use App\Matter;
use App\Report;
use App\Society;
use App\Attendance;
use App\Collection;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    protected $fillable = ['society_id', 'type', 'name', 'start_time', 'meeting_date', 'end_time', 'total_attendance', 'minute', 'presider'];

    protected $dates = ['start_time', 'meeting_date', 'end_time'];

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
        return $this->belongsToMany(Matter::class);
    }

    //define tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    //define attendance
    public function attendances()
    {
        return $this->belongsToMany(User::class, 'attendances')->using(Attendance::class)
        ->withPivot('society_id');
    }

    //define presider
    public function presider()
    {
        return $this->belongsTo(User::class, 'presider');
    }

    //define collection
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
