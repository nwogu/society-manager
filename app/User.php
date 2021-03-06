<?php

namespace App;

use App\Role;
use App\Task;
use App\Matter;
use App\Report;
use App\Meeting;
use App\Society;
use App\Commitee;
use App\Attendance;
use App\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'email', 'phone', 'password', 'dob', 'sex', 'fullname', 'address'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['dob'];

    /**
     * Get user roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    /**
     * Get User Society Role
     */
    public function role(int $societyId)
    {
        return $this->roles()->where('society_id', $societyId)->first();
    }

    public function isExecutive(int $societyId)
    {
        $role = $this->role($societyId);
        if($role !== null) return $role->executive;
        return false;
    }

    /**
     * Get User Commitees
     */
    public function commitees()
    {
        return $this->belongsToMany(Commitee::class, 'commitee_user');
    }

    //define reports
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    //define matters
    public function matters()
    {
        return $this->hasMany(Matter::class, 'raised_by');
    }

    //define tasks
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    //define society
    public function societies()
    {
        return $this->belongsToMany(Society::class, 'user_society')
        ->withPivot('status', 'joined');
    }

    //define collection
    public function reportedCollections()
    {
        return $this->hasMany(Collection::class, 'recorder');
    }

    //define collection
    public function paidCollections()
    {
        return $this->hasMany(Collection::class, 'member');
    }

    //define attendance
    public function attendances()
    {
        return $this->belongsToMany(Meeting::class, 'attendances')->using(Attendance::class);
    }

    public function lastMeeting(int $societyId)
    {
        $att = $this->attendances()->where('meetings.society_id', $societyId)->orderBy('meeting_date', 'desc')->get();
        if ($att->isEmpty()) return null;
        return $att[0]->meeting_date;
    }
}
