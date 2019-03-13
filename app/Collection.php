<?php

namespace App;

use App\User;
use App\Meeting;
use App\Society;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    protected $guarded = [];

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'member');
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorder');
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
