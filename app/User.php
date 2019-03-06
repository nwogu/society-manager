<?php

namespace App;

use App\Role;
use App\Task;
use App\Matter;
use App\Report;
use App\Commitee;
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
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get user roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
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
}
