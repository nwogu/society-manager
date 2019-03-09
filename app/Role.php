<?php

namespace App;

use App\User;
use App\Society;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //hold fillable or guarded
    protected $guarded = [];

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    /**
     * Get user roles
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
}
