<?php

namespace App;

use App\Role;
use App\Task;
use App\User;
use App\Matter;
use App\Report;
use App\Meeting;
use App\Commitee;
use App\Attendance;
use App\Collection;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    //hold fillable/guarded
    protected $fillable = ['name', 'description', 'domain', 'logo'];

    //define roles
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    //define users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_society')
        ->withPivot('status', 'joined');
    }

    //define committees
    public function commitees()
    {
        return $this->hasMany(Commitee::class);
    }

    //define meetings
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
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
        return $this->hasMany(Attendance::class);
    }

    //define collection
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
