<?php

namespace App;

use App\User;
use App\Meeting;
use App\Society;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
