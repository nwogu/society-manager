<?php

namespace App;

use App\User;
use App\Meeting;
use App\Society;
use Illuminate\Database\Eloquent\Model;
use App\Http\Services\FinanceService;

class Collection extends Model
{
    //
    protected $fillable = [
        "type",
        "amount",
        "received",
        "description",
        "balance",
        "member",
        "collection_date",
        "recorder",
        "meeting_id",
        "commitee_id",
        "start_period",
        "end_period"
    ];

    protected $dates = [
        "collection_date",
        "start_period",
        "end_period"
    ];

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

    public function getStartPeriod()
    {
        if ($this->attributes['start_period'] !== null) {
            return (new \DateTime($this->attributes['start_period']))->format("d, M y");
        }
    }

    public function getEndPeriod()
    {
        if ($this->attributes['end_period'] !== null) {
            return (new \DateTime($this->attributes['end_period']))->format("d, M y");
        }
    }

    public function getCollectionDate()
    {
        if ($this->attributes['collection_date'] !== null) {
            return (new \DateTime($this->attributes['collection_date']))->format("d, M y");
        }
    }

    public function getBalance()
    {
        if (($balance = $this->attributes['balance']) !== null) {
            return FinanceService::formatAmount($balance);
        }
    }

    public function getAmount()
    {
        if (($amount = $this->attributes['amount']) !== null) {
            return FinanceService::formatAmount($amount);
        }
    }

    public function getReceived()
    {
        if (($received = $this->attributes['received']) !== null) {
            return FinanceService::formatAmount($received);
        }
    }
}
