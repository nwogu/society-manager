<?php

namespace App;

use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    //hold fillable/guarded
    protected $guarded = [];

    //define roles
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    //define users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_society');
    }
}
